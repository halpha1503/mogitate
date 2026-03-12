![CI](https://github.com/halpha1503/laravel_template/actions/workflows/ci.yml/badge.svg?branch=main)

# [Project Entry]

## 更新情報

### v2_ANE
- ANE="AI-Native Edition"
- ARCHITECTURE.md、CLAUDE.md、AI_FEATURE_MAP.mdを整備。
- 認証パッケージとしてFortifyの標準装備化。

### v1
- Origin is released.

## このアプリについて
- ここに設計目的を書くんだ。
- このテンプレートは、可能な限り最新なLaravel+MySQL Projectの開発を最短の手間で始めるために作成する。
- 各ソフトウェアの最新リリースや製作者(halpha1503)の学習進捗、就労環境更新に合わせ適宜更新する。

## 技術スタック
### アプリケーション
![PHP](https://img.shields.io/badge/PHP-8.5.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12.53.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![nginx](https://img.shields.io/badge/nginx-1.29.5-009639?style=for-the-badge&logo=nginx&logoColor=white)

### 開発基盤
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![GitHub Actions](https://img.shields.io/badge/GitHub%20Actions-CI-2088FF?style=for-the-badge&logo=github-actions&logoColor=white)


## 環境構築手順
### 0. 前提
- 要セットアップ：Git、Docker、Docker-Compose
- Docker Desktop Appを起動しておく。

### 1. リポジトリをコピーし、Dockerをビルド。
```shell
git clone https://github.com/halpha1503/
cd test_contact-form
docker-compose up -d --build
```

### 2. PHPコンテナ内のComposerにてLaravel環境を構築。
```shell
docker-compose exec php bash
composer install
cp .env.example .env
```

### 3. .envを開き、以下の環境変数を設定。
```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 4. 認証キー作成、マイグレーション実行、シーディング実行。
```shell
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## 開発環境
- お問い合わせ画面：http://localhost/
- ユーザー登録：http://localhost/register
- phpMyAdmin：http://localhost:8080/

## ER図
ここにはる

## 画面遷移図
ここにはる

## ディレクトリ構成
ここにはる

