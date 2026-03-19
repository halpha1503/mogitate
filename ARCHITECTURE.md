# ARCHITECTURE.md / アーキテクチャ設計

このドキュメントは、このリポジトリの設計方針と構造を説明するものです。  
開発者および AI ツールが、プロジェクト構造と実装方針を理解するためのガイドとして使用します。

---

## 1. プロジェクト概要

このプロジェクトは Laravel を使用した Web アプリケーションです。

主な機能は以下の通りです。

- ユーザーが商品一覧ページを閲覧する機能
- ユーザーが商品一覧ページ上でキーワード検索、並べ替えを行う。

このプロジェクトでは管理者認証機能を作成しません。

アプリケーションは以下のレイヤー構造を前提とします。

Controller → Request → Service → Model → View

---

## 2. 技術スタック

### バックエンド
- Laravel
- PHP

### データベース
- MySQL

### フロントエンド
- Blade
- CSS

### インフラ
- Docker
- Nginx

---

## 3. ディレクトリ構造

app/
 ├ Http/
 │   ├ Controllers/
 │   └ Requests/
 ├ Models/
 └ Services/

resources/
 ├ views/
 └ css/

database/
 ├ migrations/
 ├ factories/
 └ seeders/

## 4. 各レイヤーの責務

Controller
- HTTP リクエストの受け取り
- Request による検証済みデータの受け取り
- Service の呼び出し
- View / Redirect の返却

Controller に複雑なビジネスロジックを書かない。

Request
- 入力値の検証
- 入力データの正当性保証

Request に業務ロジックを書かない。

Service
- 業務処理
- データ保存
- 複数モデルにまたがる処理
- 副作用を伴う処理

Model
- データ構造の表現
- リレーション定義

Model に過剰な業務ロジックを持たせない。

Blade (View)
- HTML 表示
- データのレンダリング
- 最小限の表示分岐

Blade に複雑な業務ロジックを書かない。

⸻

## 5. 公開機能の実装パターン

公開機能は、ユーザーが直接操作する機能を指す。
このプロジェクトでは Product 機能が公開機能の模範実装である。

### 基本フロー
1.	ユーザーが入力画面を開く
2.	フォームに入力して送信する
3.	FormRequest により入力値を検証する
4.	確認画面を表示する
5.	ユーザーが内容を確認する
6.	Service がデータを保存する
7.	完了画面に遷移する

### 設計方針
- 入力検証は FormRequest を使用する
- confirm 画面では保存しない
- store 処理で最終保存を行う
- 保存処理は Service に集約する
- Blade は表示専用とする
- 命名規則は Public 機能に合わせる

### 模範構成
- ProductController（単数形）
- ProductRequest（単数形）
- ProductService（単数形）
- Product（単数形）

### View
- index.blade.php

⸻

## 6. 管理機能の実装パターン

管理機能は、認証済み管理者が問い合わせデータを閲覧・操作する機能を指す。
このプロジェクトでは Admin 機能が管理機能の模範実装である。

### 基本フロー
1.	管理者がログイン画面へアクセスする
2.	管理者認証を行う
3.	管理画面で問い合わせ一覧を表示する
4.	必要に応じて詳細確認や絞り込みを行う
5.	必要に応じて問い合わせデータを削除する

### 設計方針
- 一覧表示と削除処理の責務を明確にする
- 削除などの副作用を伴う処理は必要に応じて Service へ分離する
- 管理用 Blade は公開用 Blade と区別する
- 命名規則は Admin 機能に合わせる

⸻

## 7. データベース設計

### products テーブル
- id
- name
- price
- image
- description
- created_at
- updated_at

### seasons テーブル
- id
- name
- created_at
- updated_at

### product_seasonテーブル(中間テーブル)
- id
- product_id
- season_id
- created_at
- updated_at

⸻

## 8. コーディングルール
- バリデーションは FormRequest を使用する
- ビジネスロジックは Service クラスに配置する
- Controller は可能な限り薄く保つ
- Blade には表示ロジックのみを書く
- 既存機能の命名規則と責務分割を維持する
- 新しいライブラリやフレームワークを勝手に追加しない

⸻

## 9. 新機能追加時の原則
1.	その機能が公開機能か管理機能かを判断する
2.	どの既存機能を模範として踏襲するかを決める
3.	Request / Service / Model / View のどこに責務を置くかを判断する

原則
- 公開機能は Contact 機能を参考にする
- 管理機能は Admin 機能を参考にする
- 既存の命名規則を維持する
- 既存の責務分離を崩さない