![CI](https://github.com/halpha1503/laravel_template/actions/workflows/ci.yml/badge.svg?branch=main)

## 使用技術
### アプリケーション
![PHP](https://img.shields.io/badge/PHP-8.5.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12.53.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![nginx](https://img.shields.io/badge/nginx-1.29.5-009639?style=for-the-badge&logo=nginx&logoColor=white)

### 開発基盤
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![GitHub Actions](https://img.shields.io/badge/GitHub%20Actions-CI-2088FF?style=for-the-badge&logo=github-actions&logoColor=white)


## 環境構築手順
### 1. Dockerビルド
```shell
git clone https://github.com/halpha1503/
cd test_contact-form
docker-compose up -d --build
```

### 2. Laravel環境構築
```shell
docker-compose exec php bash
composer install
cp .env.example .env
```

.env内の環境変数を変更。
```
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## 開発環境
- お問い合わせ画面：http://localhost/
- ユーザー登録：http://localhost/register
- phpMyAdmin：http://localhost:8080/



