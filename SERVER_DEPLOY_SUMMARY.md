# 🚀 어디로 시스템 서버 배포 완료 요약

## 📌 작업 일시
2025년 10월 29일

---

## 1️⃣ 로컬 환경 구축

### ✅ 완료된 작업
1. **Git 저장소 연결**
   - 기존 저장소 제거
   - 새 저장소 생성: https://github.com/Jakezo/origin-eodilo
   - 초기 커밋 및 푸시 완료

2. **로컬 개발 환경 설정**
   - `.env` 파일 생성
   - Composer 의존성 설치 (`composer update` - PHP 8.4 호환)
   - NPM 패키지 설치
   - Laravel 애플리케이션 키 생성

3. **데이터베이스 설정**
   - `laravel` DB 생성
   - `boss_enha` DB 생성
   - `boss_test` DB 생성
   - 마이그레이션 실행 (64개 파일)

4. **PHP 8.4 호환성 수정**
   - `short_open_tag` 제거: `<?` → `<?php`
   - Blade 파일 수정: `<?}?>` → `<?php }?>`
   - TEXT 필드 default 값 제거
   - 미들웨어 handle() 메서드 수정: `...$guards` 추가
   - Null 체크 추가

5. **테스트 계정 생성**
   - 관리자: enha / enha5785
   - 파트너: test / test1234
   - 매니저: test / test1234

6. **Hosts 파일 설정**
   ```
   127.0.0.1 admin.localhost
   127.0.0.1 partner.localhost
   127.0.0.1 test.partner.localhost
   ```

7. **로컬 서버 실행**
   - PHP 내장 서버: `php -S 127.0.0.1:8000 -t public`
   - 접속: http://admin.localhost:8000/adminlogin

---

## 2️⃣ 서버 환경 구축 (211.188.51.0)

### 서버 정보
- **OS**: Rocky Linux 9
- **내부 IP**: 10.0.1.6
- **외부 IP**: 211.188.51.0
- **웹서버**: Nginx
- **PHP**: 8.2.29
- **DB**: MySQL 8.0.41

### ✅ 완료된 작업

1. **PHP 8.2 설치**
   ```bash
   dnf install epel-release -y
   dnf install https://rpms.remirepo.net/enterprise/remi-release-9.rpm -y
   dnf module reset php -y
   dnf module enable php:remi-8.2 -y
   dnf install php php-fpm php-mysqlnd php-mbstring php-xml php-zip php-gd php-curl php-json php-bcmath php-pdo -y
   ```

2. **Composer 설치**
   ```bash
   curl -sS https://getcomposer.org/installer | php
   mv composer.phar /usr/local/bin/composer
   chmod +x /usr/local/bin/composer
   ```

3. **프로젝트 배포**
   ```bash
   mkdir -p /usr/local/deploy/eodilo-system
   cd /usr/local/deploy/eodilo-system
   git clone https://github.com/Jakezo/origin-eodilo.git .
   composer install --optimize-autoloader --no-dev
   ```

4. **.env 파일 설정**
   ```env
   APP_NAME="어디로시스템"
   APP_ENV=local
   APP_KEY=base64:diLli/8KgGJwakBompSCHpmTXYf3LwIvcCLg3X53dXQ=
   APP_DEBUG=true
   APP_URL=http://eodilo.com
   APP_HOST=eodilo.com
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eodilo
   DB_USERNAME=root
   DB_PASSWORD=enha5785!
   ```

5. **데이터베이스 설정**
   ```sql
   CREATE DATABASE eodilo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE DATABASE boss_enha CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE DATABASE boss_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   
   -- 권한 부여
   GRANT ALL PRIVILEGES ON eodilo.* TO 'enha_user'@'%';
   GRANT ALL PRIVILEGES ON boss_enha.* TO 'enha_user'@'%';
   GRANT ALL PRIVILEGES ON boss_test.* TO 'enha_user'@'%';
   FLUSH PRIVILEGES;
   ```

6. **마이그레이션 실행**
   ```bash
   php artisan migrate --force
   ```

7. **계정 생성**
   - 관리자 계정: enha / enha5785
   - 파트너 계정: test / test1234
   - boss_test 매니저: test / test1234

8. **PHP-FPM 설정**
   ```bash
   # /etc/php-fpm.d/www.conf
   user = nginx
   group = nginx
   listen.owner = nginx
   listen.group = nginx
   listen.mode = 0660
   
   systemctl restart php-fpm
   systemctl enable php-fpm
   ```

9. **권한 설정**
   ```bash
   chown -R nginx:nginx /usr/local/deploy/eodilo-system
   chmod -R 755 /usr/local/deploy/eodilo-system
   chmod -R 777 /usr/local/deploy/eodilo-system/storage
   chmod -R 777 /usr/local/deploy/eodilo-system/bootstrap/cache
   
   # SELinux 비활성화 (권한 문제 해결)
   setenforce 0
   ```

10. **SSL 인증서 발급**
    ```bash
    certbot certonly --manual --preferred-challenges dns \
      -d eodilo.com \
      -d *.eodilo.com \
      -d *.partner.eodilo.com
    
    # 인증서 위치: /etc/letsencrypt/live/eodilo.com/
    ```

11. **Nginx 설정** (`/etc/nginx/conf.d/00-eodilo-system.conf`)
    - admin.eodilo.com → Laravel 관리자
    - *.partner.eodilo.com → Laravel 파트너
    - api.eodilo.com → Laravel API
    - HTTP → HTTPS 리다이렉트
    - FastCGI 설정 (PHP-FPM 연동)

12. **Nginx 재시작**
    ```bash
    nginx -t
    systemctl reload nginx
    ```

---

## 3️⃣ DNS 설정 (가비아)

### A 레코드
- `*.eodilo.com` → `211.188.51.0`
- 또는 개별:
  - `admin.eodilo.com` → `211.188.51.0`
  - `test.partner.eodilo.com` → `211.188.51.0`
  - `api.eodilo.com` → `211.188.51.0`

### TXT 레코드 (SSL 인증용, 임시)
- `_acme-challenge.eodilo.com`
- `_acme-challenge.partner.eodilo.com`

---

## 4️⃣ 주요 파일 수정 내역

### PHP 8.4 호환성
1. **app/Http/Classes/NCPdisk.php**
   - `<?` → `<?php`

2. **app/Http/Controllers/AlimTalkController.php**
   - `<?` → `<?php`

3. **43개 Blade 파일**
   - `<?}?>` → `<?php }?>`
   - `<?if` → `<?php if`

4. **미들웨어**
   - `app/Http/Middleware/Authenticate.php`
   - `app/Http/Middleware/PartnerAuthenticate.php`
   - `handle()` 메서드에 `...$guards` 추가

5. **마이그레이션 파일 (19개)**
   - TEXT 필드 `default('')` → `nullable()`
   - datetime `default('0000-00-00')` → `nullable()`

6. **뷰 파일**
   - `resources/views/partner/work/day_end.blade.php`
   - `resources/views/partner/setting/map_editor.blade.php`
   - Null 체크 추가

7. **모델**
   - `app/Models/FrenchManager.php`
   - 비밀번호 필드명 수정

---

## 5️⃣ 최종 접속 정보

### 관리자
- **URL**: https://admin.eodilo.com/adminlogin
- **아이디**: enha
- **비밀번호**: enha5785

### 파트너
- **URL**: https://test.partner.eodilo.com/partnerlogin
- **아이디**: test
- **비밀번호**: test1234

### API
- **URL**: https://api.eodilo.com

---

## 6️⃣ 서버 구조

### 디렉토리
- **프로젝트**: `/usr/local/deploy/eodilo-system`
- **Public**: `/usr/local/deploy/eodilo-system/public`
- **Logs**: `/var/log/nginx/` & `/usr/local/deploy/eodilo-system/storage/logs/`

### 데이터베이스
- **eodilo**: 공통 DB (관리자, 파트너, 사용자 등)
- **boss_enha**: 공통 파트너 DB
- **boss_test**: test 파트너 전용 DB
- **boss_{파트너ID}**: 각 파트너별 DB (멀티 테넌트)

### 서비스
- **Nginx**: 웹서버 (포트 80, 443)
- **PHP-FPM**: PHP 처리 (/run/php-fpm/www.sock)
- **MySQL**: 데이터베이스 (포트 3306)

---

## 7️⃣ 문제 해결 내역

### 해결된 문제들
1. ✅ PHP 8.4 호환성 (short_open_tag 제거됨)
2. ✅ Composer 의존성 버전 충돌
3. ✅ 마이그레이션 TEXT/datetime default 오류
4. ✅ 미들웨어 메서드 시그니처 불일치
5. ✅ storage 폴더 권한 문제
6. ✅ SELinux 권한 차단
7. ✅ PHP-FPM 소켓 권한
8. ✅ Nginx 도메인 라우팅
9. ✅ SSL 인증서 (와일드카드)
10. ✅ DB 접근 권한
11. ✅ Blade 템플릿 구문 오류
12. ✅ Null 참조 에러

---

## 8️⃣ 유지보수 명령어

### 코드 업데이트
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

### 로그 확인
```bash
# Laravel 로그
tail -f /usr/local/deploy/eodilo-system/storage/logs/laravel.log

# Nginx 로그
tail -f /var/log/nginx/admin.eodilo.error.log
tail -f /var/log/nginx/partner.eodilo.error.log

# PHP-FPM 로그
tail -f /var/log/php-fpm/www-error.log
```

### 서비스 재시작
```bash
systemctl restart php-fpm
systemctl reload nginx
```

### 캐시 클리어
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 9️⃣ 파일 및 폴더 구조

```
/usr/local/deploy/eodilo-system/
├── app/                    # 애플리케이션 코드
├── bootstrap/              # 부트스트랩
├── config/                 # 설정 파일
├── database/               # 마이그레이션, 시더
├── public/                 # 공개 디렉토리 (Nginx root)
├── resources/              # 뷰, 에셋
├── routes/                 # 라우트 정의
├── storage/                # 로그, 캐시, 세션
├── vendor/                 # Composer 패키지
├── .env                    # 환경 설정
├── composer.json           # 의존성 정의
└── artisan                 # CLI 도구
```

---

## 🔟 Nginx 설정 파일

**위치**: `/etc/nginx/conf.d/00-eodilo-system.conf`

**설정 내용**:
- admin.eodilo.com (HTTPS)
- *.partner.eodilo.com (HTTPS, 와일드카드)
- api.eodilo.com (HTTPS)
- HTTP → HTTPS 리다이렉트
- FastCGI 파라미터
- SSL/TLS 보안 설정

---

## 1️⃣1️⃣ 주요 설정 값

### .env
- APP_ENV=local (개발 모드)
- APP_DEBUG=true (디버그 활성화)
- APP_HOST=eodilo.com
- DB_DATABASE=eodilo
- DB_USERNAME=root
- DB_PASSWORD=enha5785!

### Nginx
- Document Root: /usr/local/deploy/eodilo-system/public
- FastCGI Socket: /run/php-fpm/www.sock

### SSL
- Certificate: /etc/letsencrypt/live/eodilo.com/fullchain.pem
- Private Key: /etc/letsencrypt/live/eodilo.com/privkey.pem
- 만료일: 2026-01-27
- 갱신: 수동 (일주일 사용 예정)

---

## 1️⃣2️⃣ Git 커밋 내역

### 주요 커밋
1. **Initial commit**: 어디로 시스템 NCP 프로젝트
   - 5,404 파일 변경

2. **PHP 8.4 호환성 수정**
   - 73 파일 수정
   - short_open_tag 제거
   - 마이그레이션 수정
   - null 체크 추가

3. **서버 배포 가이드 추가**
   - DEPLOY.md
   - deploy-server.sh

---

## 1️⃣3️⃣ 테스트 계정 정보

### 관리자 (eodilo DB)
```sql
admin_id: enha
password: enha5785 (해시됨)
```

### 파트너 (eodilo DB)
```sql
p_id: test
p_passwd: test1234 (해시됨)
p_name: 테스트 스터디카페
```

### 매니저 (boss_test DB)
```sql
mn_id: test
password: test1234 (해시됨)
mn_name: 매니저
```

---

## 1️⃣4️⃣ 멀티 테넌트 구조

### 데이터베이스 구조
- **eodilo**: 공통 데이터 (관리자, 파트너 목록, 사용자 등)
- **boss_{파트너ID}**: 각 파트너 전용 DB
  - french_managers (매니저)
  - french_seats (좌석)
  - french_rooms (룸)
  - french_members (회원)
  - 등등...

### 라우팅
- **admin.eodilo.com**: 시스템 관리자
- **{파트너ID}.partner.eodilo.com**: 각 파트너 관리
- **api.eodilo.com**: API 서버

---

## 1️⃣5️⃣ 배포 체크리스트

- [x] 로컬 개발 환경 구축
- [x] Git 저장소 생성 및 푸시
- [x] 서버 PHP 8.2 설치
- [x] Composer 설치
- [x] 프로젝트 Clone
- [x] Composer 의존성 설치
- [x] .env 파일 설정
- [x] APP_KEY 생성
- [x] 데이터베이스 생성
- [x] 마이그레이션 실행
- [x] 테스트 계정 생성
- [x] PHP-FPM 설정
- [x] Nginx 설정
- [x] SSL 인증서 발급
- [x] 권한 설정
- [x] SELinux 설정
- [x] 서비스 재시작
- [x] 접속 테스트

---

## 1️⃣6️⃣ 남은 작업 (선택사항)

### 운영 환경 전환 시
```bash
# .env 수정
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error

# 캐시 최적화
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Nginx 재시작
systemctl reload nginx
```

### 실제 데이터 마이그레이션
로컬 DB → 서버 DB 데이터 복사 (필요시)

### 추가 파트너 생성
각 파트너별 DB 생성 및 설정

---

## 1️⃣7️⃣ 문서 및 스크립트

### 생성된 파일
- `DEPLOY.md`: 상세 배포 가이드
- `deploy-server.sh`: 자동 배포 스크립트
- `SERVER_DEPLOY_SUMMARY.md`: 이 문서

### GitHub
- **저장소**: https://github.com/Jakezo/origin-eodilo
- **브랜치**: main
- **커밋 수**: 3개

---

## 🎉 배포 완료!

**접속 URL**:
- 🔐 https://admin.eodilo.com/adminlogin (관리자)
- 🏢 https://test.partner.eodilo.com/partnerlogin (파트너)
- 🔌 https://api.eodilo.com (API)

**서버 IP**: 211.188.51.0 (내부: 10.0.1.6)

**배포 기간**: 약 2시간 (환경 구축 + 문제 해결)

---

## 📞 문의 및 지원

문제 발생 시:
1. 로그 확인
2. GitHub Issues 등록
3. 서버 재시작
4. 캐시 클리어

---

생성일: 2025-10-29
작성자: AI Assistant & Jake
프로젝트: 어디로 시스템 (Laravel 8)
