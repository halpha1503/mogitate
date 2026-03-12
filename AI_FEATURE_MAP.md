# AI Feature Map

このドキュメントは、このリポジトリ内の主要機能と、その対応ファイルを AI に説明するためのものです。

---

## Contact Feature

### Purpose
（ここに機能を書く）

### Files

#### Controller
- src/app/Http/Controllers/HomeController.php

#### Request
- src/app/Http/Requests/HomeRequest.php

#### Service
- src/app/Services/HomeService.php

#### Model
- src/app/Models/Home.php

#### Views
- src/resources/views/layouts/base.blade.php
- src/resources/views/layouts/header.blade.php
- src/resources/views/home/

#### Routes
- src/routes/web.php

### Flow
Ex) index → confirm → store → thanks

### Notes
この機能は公開機能の標準パターンとする。

---

## Admin Feature

### Purpose
Ex) 管理者認証後に、お問い合わせ一覧の確認と削除を行う機能。

### Files

#### Controller
- src/app/Http/Controllers/AdminController.php
- 認証関連 Controller

#### Views
- src/resources/views/admin/admin.blade.php
- src/resources/views/admin/login.blade.php

#### Routes
- src/routes/web.php

### Flow
ex) login → admin dashboard → delete

### Notes
この機能は管理機能の標準パターンとする。