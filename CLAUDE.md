# Claude Instructions

このプロジェクトでコード生成・修正を行う際は、以下を必ず守ること。

## 最重要ルール
1. Controller は薄く保つ。
2. 入力バリデーションは FormRequest を使用する
3. ビジネスロジックは Service に書く
4. Blade には表示処理のみを書く
5. 既存の命名規則と構造を維持する

## 命名規則
Laravelの慣例に従い、クラス名は単数形を使用する。

| 種別 | 正しい例 | 誤り |
|------|----------|------|
| Controller | `ProductController` | ~~ProductsController~~ |
| Request | `ProductRequest` | ~~ProductsRequest~~ |
| Service | `ProductService` | ~~ProductsService~~ |
| Model | `Product`, `Season` | ~~Products~~, ~~Seasons~~ |

- URLパス（`/products`）は複数形のままでOK
- テーブル名（`products`, `seasons`）も複数形のままでOK
- クラス名・ファイル名のみ単数形

## 実装方針
- 公開機能は Product 機能を模範にする
- 既存コードの構造を優先する
- 新しい設計パターンを勝手に導入しない
- 新しいライブラリやフロントエンドフレームワークを勝手に追加しない

## 禁止事項
- Controller に長い業務ロジックを書くこと
- Blade に業務ロジックを書くこと
- Request に保存処理や業務ルールを書くこと
- 命名規則を崩すこと

## 参照順序
0. ~/.claude/CLAUDE.md

(以下は全て本リポジトリ内)
1. CLAUDE.md
2. ARCHITECTURE.md
3. AI_FEATURE_MAP.md
4. 既存コード