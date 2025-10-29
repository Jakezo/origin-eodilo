#!/bin/bash
# 어디로 시스템 서버 배포 스크립트
# 서버에서 실행: bash <(curl -s https://raw.githubusercontent.com/Jakezo/origin-eodilo/main/deploy-server.sh)

set -e

echo "=========================================="
echo "🚀 어디로 시스템 서버 배포 시작"
echo "=========================================="

# 배포 디렉토리
DEPLOY_DIR="/usr/local/deploy/eodilo-system"
BACKUP_DIR="/usr/local/deploy/backups"

# 백업
if [ -d "$DEPLOY_DIR" ]; then
    echo "📦 기존 파일 백업 중..."
    BACKUP_NAME="eodilo_backup_$(date +%Y%m%d_%H%M%S)"
    mkdir -p $BACKUP_DIR
    cp -r $DEPLOY_DIR $BACKUP_DIR/$BACKUP_NAME
    echo "✅ 백업 완료: $BACKUP_DIR/$BACKUP_NAME"
fi

# Git clone 또는 pull
if [ ! -d "$DEPLOY_DIR" ]; then
    echo "📥 프로젝트 Clone 중..."
    mkdir -p $DEPLOY_DIR
    git clone https://github.com/Jakezo/origin-eodilo.git $DEPLOY_DIR
else
    echo "🔄 프로젝트 업데이트 중..."
    cd $DEPLOY_DIR
    git pull origin main
fi

cd $DEPLOY_DIR

# Composer 설치
echo "📦 Composer 의존성 설치 중..."
composer install --optimize-autoloader --no-dev

# .env 파일 체크
if [ ! -f ".env" ]; then
    echo "⚠️  .env 파일이 없습니다. 수동으로 생성하세요!"
    exit 1
fi

# Laravel 최적화
echo "⚡ Laravel 최적화 중..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 권한 설정
echo "🔐 권한 설정 중..."
chown -R nginx:nginx $DEPLOY_DIR
chmod -R 755 $DEPLOY_DIR
chmod -R 775 $DEPLOY_DIR/storage
chmod -R 775 $DEPLOY_DIR/bootstrap/cache

# PHP-FPM & Nginx 재시작
echo "🔄 서비스 재시작 중..."
systemctl reload php-fpm
systemctl reload nginx

echo ""
echo "=========================================="
echo "✅ 배포 완료!"
echo "=========================================="
echo ""
echo "🌐 접속 URL:"
echo "   관리자: https://admin.eodilo.com/adminlogin"
echo "   파트너: https://test.partner.eodilo.com"
echo ""
echo "=========================================="
