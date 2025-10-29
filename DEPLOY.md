# 🚀 어디로 시스템 서버 배포 가이드

## 📌 1. 로컬에서 준비

### ① Git 푸시 확인
```bash
cd "/Users/jake/Downloads/preEodilo/어디로시스템_NCP"
git push origin main
```

### ② 배포할 파일 목록
- 소스코드 전체 (Git에서 clone)
- `.env` 파일은 서버에서 별도 생성

---

## 📌 2. 서버 접속 및 초기 설정

### ① 서버 접속
```bash
ssh root@211.188.51.0
```

### ② 필요한 패키지 설치
```bash
# PHP 8.2 설치 (CentOS/RHEL)
yum install epel-release -y
yum install https://rpms.remirepo.net/enterprise/remi-release-7.rpm -y
yum-config-manager --enable remi-php82
yum install php php-fpm php-mysql php-mbstring php-xml php-zip php-gd php-curl php-json -y

# Composer 설치
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# MySQL 설치 (이미 있으면 skip)
yum install mariadb-server mariadb -y
systemctl start mariadb
systemctl enable mariadb

# Nginx (이미 설치되어 있음)
```

---

## 📌 3. 프로젝트 배포

### ① 배포 디렉토리 생성
```bash
mkdir -p /usr/local/deploy/eodilo-system
cd /usr/local/deploy/eodilo-system
```

### ② Git Clone
```bash
git clone https://github.com/Jakezo/origin-eodilo.git .
```

### ③ Composer 의존성 설치
```bash
composer install --optimize-autoloader --no-dev
```

### ④ .env 파일 생성
```bash
cp .env.example .env 2>/dev/null || cat > .env << 'ENVFILE'
APP_NAME="어디로시스템"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://eodilo.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eodilo
DB_USERNAME=root
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# 기타 설정...
ENVFILE
```

### ⑤ 애플리케이션 키 생성
```bash
php artisan key:generate
```

### ⑥ 권한 설정
```bash
chown -R nginx:nginx /usr/local/deploy/eodilo-system
chmod -R 755 /usr/local/deploy/eodilo-system
chmod -R 775 /usr/local/deploy/eodilo-system/storage
chmod -R 775 /usr/local/deploy/eodilo-system/bootstrap/cache
```

---

## 📌 4. 데이터베이스 설정

### ① 데이터베이스 생성
```bash
mysql -uroot -p << 'SQL'
CREATE DATABASE IF NOT EXISTS eodilo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE IF NOT EXISTS boss_enha CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'eodilo'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON eodilo.* TO 'eodilo'@'localhost';
GRANT ALL PRIVILEGES ON boss_*.* TO 'eodilo'@'localhost';
FLUSH PRIVILEGES;
SQL
```

### ② 마이그레이션 실행
```bash
cd /usr/local/deploy/eodilo-system
php artisan migrate --force
```

### ③ 관리자 계정 생성
```bash
php artisan tinker --execute="
DB::table('admins')->insert([
    'admin_id' => 'enha',
    'password' => Hash::make('enha5785'),
    'admin_name' => '관리자',
    'admin_email' => 'admin@eodilo.com',
    'admin_phone' => '010-0000-0000',
    'admin_login_last' => '',
    'admin_login_ip' => '',
    'admin_state' => 'Y',
    'created_at' => now(),
    'updated_at' => now(),
]);
"
```

---

## 📌 5. Nginx 설정

### ① Nginx 설정 파일 생성
```bash
cat > /etc/nginx/conf.d/eodilo.conf << 'NGINXCONF'
# Admin 도메인
server {
    listen 80;
    server_name admin.eodilo.com;
    root /usr/local/deploy/eodilo-system/public;
    index index.php;

    access_log /var/log/nginx/admin.eodilo.access.log;
    error_log /var/log/nginx/admin.eodilo.error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

# Partner 도메인 (와일드카드)
server {
    listen 80;
    server_name ~^(?<account>.+)\.partner\.eodilo\.com$;
    root /usr/local/deploy/eodilo-system/public;
    index index.php;

    access_log /var/log/nginx/partner.eodilo.access.log;
    error_log /var/log/nginx/partner.eodilo.error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

# API 도메인
server {
    listen 80;
    server_name api.eodilo.com;
    root /usr/local/deploy/eodilo-system/public;
    index index.php;

    access_log /var/log/nginx/api.eodilo.access.log;
    error_log /var/log/nginx/api.eodilo.error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
NGINXCONF
```

### ② PHP-FPM 설정 확인
```bash
# PHP-FPM 소켓 위치 확인
ls -la /var/run/php-fpm/

# 필요시 /etc/php-fpm.d/www.conf 수정
vi /etc/php-fpm.d/www.conf
# listen = /var/run/php-fpm/php-fpm.sock
# user = nginx
# group = nginx
```

### ③ Nginx 설정 테스트 및 재시작
```bash
nginx -t
systemctl reload nginx
```

---

## 📌 6. PHP-FPM 시작
```bash
systemctl start php-fpm
systemctl enable php-fpm
systemctl status php-fpm
```

---

## 📌 7. .env 파일 수정 (프로덕션 설정)

```bash
vi /usr/local/deploy/eodilo-system/.env
```

다음 항목들을 실제 값으로 수정:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://eodilo.com
APP_HOST=eodilo.com

DB_DATABASE=eodilo
DB_USERNAME=eodilo
DB_PASSWORD=실제_비밀번호

# NCloud Object Storage (있는 경우)
AWS_ACCESS_KEY_ID=your_access_key
AWS_SECRET_ACCESS_KEY=your_secret_key
AWS_DEFAULT_REGION=kr-standard
AWS_BUCKET=your_bucket
```

저장 후 캐시 클리어:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📌 8. 방화벽 설정 (필요시)

```bash
firewall-cmd --permanent --add-service=http
firewall-cmd --permanent --add-service=https
firewall-cmd --reload
```

---

## 📌 9. SSL 인증서 설정 (Let's Encrypt)

```bash
# Certbot 설치
yum install certbot python3-certbot-nginx -y

# SSL 인증서 발급
certbot --nginx -d admin.eodilo.com -d eodilo.com -d *.partner.eodilo.com -d api.eodilo.com

# 자동 갱신 설정
echo "0 3 * * * /usr/bin/certbot renew --quiet" | crontab -
```

---

## 📌 10. 배포 완료 후 확인

### ① 서비스 상태 확인
```bash
systemctl status nginx
systemctl status php-fpm
systemctl status mariadb
```

### ② 로그 확인
```bash
# Nginx 로그
tail -f /var/log/nginx/admin.eodilo.error.log

# Laravel 로그
tail -f /usr/local/deploy/eodilo-system/storage/logs/laravel.log
```

### ③ 브라우저 접속 테스트
- 관리자: https://admin.eodilo.com/adminlogin
- 파트너: https://test.partner.eodilo.com/partnerlogin
- API: https://api.eodilo.com

---

## 📌 11. 업데이트 배포 (재배포)

이후 업데이트 시:

```bash
cd /usr/local/deploy/eodilo-system
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
systemctl reload nginx
systemctl reload php-fpm
```

---

## 📌 12. 트러블슈팅

### 500 에러 발생 시
```bash
# 권한 재설정
chown -R nginx:nginx /usr/local/deploy/eodilo-system
chmod -R 775 /usr/local/deploy/eodilo-system/storage
chmod -R 775 /usr/local/deploy/eodilo-system/bootstrap/cache

# 로그 확인
tail -f /usr/local/deploy/eodilo-system/storage/logs/laravel.log
```

### 데이터베이스 연결 오류 시
```bash
# DB 접속 테스트
mysql -u eodilo -p eodilo

# .env 파일 확인
cat /usr/local/deploy/eodilo-system/.env | grep DB_
```

---

## 📌 주요 경로 요약

- **배포 디렉토리**: `/usr/local/deploy/eodilo-system`
- **Public 디렉토리**: `/usr/local/deploy/eodilo-system/public`
- **Nginx 설정**: `/etc/nginx/conf.d/eodilo.conf`
- **로그**: `/var/log/nginx/` & `/usr/local/deploy/eodilo-system/storage/logs/`

---

## ✅ 배포 체크리스트

- [ ] Git 푸시 완료
- [ ] 서버 접속
- [ ] PHP 8.2 설치
- [ ] Composer 설치
- [ ] 프로젝트 clone
- [ ] Composer install
- [ ] .env 설정
- [ ] 데이터베이스 생성
- [ ] 마이그레이션 실행
- [ ] 권한 설정
- [ ] Nginx 설정
- [ ] PHP-FPM 시작
- [ ] SSL 인증서
- [ ] 서비스 확인
- [ ] 브라우저 테스트

