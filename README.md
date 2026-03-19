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

- メイン画面：http://localhost/products/
- phpMyAdmin：http://localhost:8080/

## ER図

<img src=.drawio.png>

## 画面遷移図

```mermaid
graph LR
    A["商品一覧<br/>/products"]
    B["商品詳細<br/>/products/detail/{id}"]
    C["商品更新<br/>/products/{id}/update"]
    D["商品登録<br/>/products/register"]
    E["検索結果<br/>/products/search"]
    F["削除<br/>/products/{id}/delete"]

    A -->|商品カードクリック| B
    A -->|+商品を追加リンク| D
    A -->|検索ボタン| E

    B -->|更新ページへ遷移| C

    C -->|変更を保存| A
    C -->|戻るボタン| A
    C -->|ゴミ箱ボタン| F

    D -->|登録| A
    D -->|戻るボタン| A

    E -->|商品カードクリック| B
```

## ディレクトリ構成

```text
  src/
  ├── app/
  │   ├── Http/
  │   │   ├── Controllers/
  │   │   │   ├── Controller.php
  │   │   │   └── ProductController.php
  │   │   ├── Middleware/
  │   │   ├── Requests/
  │   │   │   └── ProductRequest.php
  │   │   └── Kernel.php
  │   ├── Models/
  │   │   ├── Product.php
  │   │   ├── Season.php
  │   │   └── User.php
  │   ├── Providers/
  │   │   └── AppServiceProvider.php
  │   └── Services/
  │       └── ProductService.php
  ├── bootstrap/
  ├── config/
  ├── database/
  │   ├── factories/
  │   │   └── UserFactory.php
  │   ├── migrations/
  │   │   ├── 2026_03_19_075635_create_products_table.php
  │   │   ├── 2026_03_19_075636_create_seasons_table.php
  │   │   └── 2026_03_19_075637_create_product_season_table.php
  │   └── seeders/
  │       ├── DatabaseSeeder.php
  │       ├── ProductSeeder.php
  │       └── SeasonSeeder.php
  ├── public/
  │   ├── css/
  │   │   ├── common.css
  │   │   ├── detail.css
  │   │   ├── index.css
  │   │   ├── register.css
  │   │   └── sanitize.css
  │   ├── storage -> /var/www/storage/app/public
  │   ├── favicon.ico
  │   └── index.php
  ├── resources/
  │   └── views/
  │       ├── layouts/
  │       │   └── base.blade.php
  │       ├── detail.blade.php
  │       ├── index.blade.php
  │       ├── register.blade.php
  │       └── search.blade.php
  ├── routes/
  │   └── web.php
  ├── storage/
  │   └── app/
  │       └── public/
  │           └── (商品画像ファイル群)
  ├── tests/
  ├── artisan
  ├── composer.json
  └── composer.lock
```
