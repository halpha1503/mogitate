[![CI](https://github.com/halpha1503/laravel_template/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/halpha1503/laravel_template/actions/workflows/ci.yml)# Laravel_template

## 使用技術（実行環境）
- PHP 8.5.3
- Laravel 8.83.8
- MySQL 8.4
- nginx 1.29.5


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
php artisan key generate
php artisan migrate
php artisan db:seed
```

## 開発環境
- お問い合わせ画面：http://localhost/
- ユーザー登録：http://localhost/register
- phpMyAdmin：http://localhost:8080/

## 使用技術（実行環境）
- PHP 8.1
- Laravel 8.83.8
- MySQL 8.4
- nginx 1.29.5


