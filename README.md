![CI](https://github.com/halpha1503/mogitate/actions/workflows/ci.yml/badge.svg?branch=main)

# mogitate 🍑🍌

## このアプリについて

- 仮想の商品検索サイト「もぎたて」について、商品一覧の閲覧・検索機能、およびCRUD機能を作成したものである。
- この作成物はCOACHTECH 基礎学習タームの確認テスト受験によるものである。与えられた仕様書に従ってコーディングを行った。
- 作成期間：2026年3月13日〜同19日

## 技術スタック

![PHP](https://img.shields.io/badge/PHP-8.5.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12.53.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![nginx](https://img.shields.io/badge/nginx-1.29.5-009639?style=for-the-badge&logo=nginx&logoColor=white)

## 環境構築手順

### 0. 前提

- 要セットアップ：Git、Docker、Docker-Compose
- Docker Desktop Appを起動しておく。
- リポジトリ名「mogitate」の競合を避ける、もしくは以下のclone手順時に適切なリポジトリ名に変更すること。

### 1. リポジトリをコピーし、Dockerをビルド。

```shell
git clone git@github.com:halpha1503/mogitate.git
cd mogitate
docker-compose up -d --build
```

### 2. PHPコンテナ内のComposerにてLaravel環境を構築。

```shell
docker-compose exec php bash
```

```shell
composer install
cp .env.example .env
```

### 3. .envをテキストエディタ等で編集し、以下の環境変数を設定。

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

- メイン画面：http://localhost/
- phpMyAdmin：http://localhost:8080/

## ER図

ここにはる

## 画面遷移図

ここにはる

## ディレクトリ構成

ここにはる
