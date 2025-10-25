# MATCH - バンドメンバーマッチングサイト

音楽活動を行いたい個人がバンドメンバーを探すためのマッチングプラットフォーム

## 🎸 概要

バンドメンバーを探している音楽愛好家のためのシンプルなマッチングサービス。
楽器、音楽ジャンル、活動地域などの条件でメンバーを検索できます。

### 主な機能
- メール認証による新規登録
- プロフィール管理（楽器、ジャンル、活動エリア）
- メンバー検索・一覧表示
- メンバー詳細閲覧

## 🛠 技術スタック

- **Backend**: Laravel 11 (PHP 8.3)
- **Frontend**: Vue 3 + Inertia.js
- **Styling**: Tailwind CSS
- **Database**: MySQL 8.0
- **Container**: Docker (Laravel Sail)
- **Build**: Vite

## 📋 必要環境

- Docker Desktop
- Git

## 🚀 セットアップ

### 1. クローンと初期設定
```bash
git clone [repository-url]
cd music-matching/laravel
cp .env.example .env
```

### 2. Laravel Sailで環境構築
```bash
# Sailの起動
./vendor/bin/sail up -d

# 初期設定
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan storage:link

# フロントエンドセットアップ
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### 3. アクセスURL
- **アプリケーション**: http://localhost
- **メールテスト (Mailpit)**: http://localhost:8025

## 💻 開発

### よく使うコマンド
```bash
# Sailコンテナ操作
./vendor/bin/sail up -d      # 起動
./vendor/bin/sail down       # 停止

# 開発サーバー（ホットリロード有効）
./vendor/bin/sail npm run dev

# Artisanコマンド
./vendor/bin/sail artisan [command]

# マイグレーション
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan migrate:fresh  # リセット
```

## 🏗 プロジェクト構成

```
laravel/
├── app/
│   ├── Http/Controllers/      # コントローラー
│   └── Models/                # Eloquentモデル
├── resources/
│   └── js/
│       ├── Pages/             # Inertiaページ (Vue)
│       └── Components/        # Vueコンポーネント
├── database/migrations/       # DBマイグレーション
└── routes/web.php            # ルーティング
```

## 📊 データベース構造

- `users` - ユーザー基本情報
- `profiles` - プロフィール詳細
- `user_parts` - 担当楽器
- `user_genres` - 音楽ジャンル

## 🔧 開発フロー

### 画面実装の流れ（モック → 実装）

1. **コントローラー作成**（モックデータ返却）
```php
// app/Http/Controllers/MemberController.php
public function index()
{
    return Inertia::render('Members/Index', [
        'members' => $this->getMockData()  // Phase 1: モック
        // 'members' => Member::paginate(20)  // Phase 2: 実データ
    ]);
}
```

2. **Vueページ作成**（Figmaデザインを実装）
```vue
<!-- resources/js/Pages/Members/Index.vue -->
<template>
  <div class="container mx-auto">
    <!-- UIの実装 -->
  </div>
</template>

<script setup>
defineProps({
  members: Array
})
</script>
```

3. **ルーティング設定**
```php
// routes/web.php
Route::get('/members', [MemberController::class, 'index']);
```

## 🧪 テスト

```bash
# テスト実行
./vendor/bin/sail test

# 特定テストのみ
./vendor/bin/sail test --filter=MemberTest
```

## 📦 デプロイ準備

```bash
# 本番ビルド
npm run build

# Laravel最適化
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📝 設計書

詳細な設計書は `/docs` ディレクトリを参照
- [要求定義書](../docs/01_要求定義書.md)
- [要件定義書](../docs/02_要件定義書.md)
- [基本設計書](../docs/03_基本設計書.md)

## ⚠️ トラブルシューティング

### Sailが起動しない
```bash
# Dockerが起動しているか確認後
./vendor/bin/sail down
./vendor/bin/sail up -d
```

### ポート競合
`.env`でポート変更
```
APP_PORT=8080
FORWARD_DB_PORT=3307
```

---

## 📧 お問い合わせ
プロジェクトに関する質問は Issue でお願いします。