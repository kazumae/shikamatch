<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <!-- ロゴ -->
      <div class="flex justify-center">
        <div class="flex items-center space-x-2">
          <img src="/img/icon.png" alt="ShikaMatch" class="h-10 w-auto" />
          <h1 class="text-3xl font-bold text-gray-900">ShikaMatch</h1>
        </div>
      </div>
      <h2 class="mt-6 text-center text-2xl font-semibold text-gray-900">
        メール認証
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <div class="text-center">
          <!-- アイコン -->
          <div class="flex justify-center mb-4">
            <svg class="h-16 w-16 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>

          <!-- メッセージ -->
          <h3 class="text-lg font-medium text-gray-900 mb-2">
            メールを送信しました
          </h3>
          <p class="text-sm text-gray-600 mb-6">
            ご登録いただいたメールアドレスに認証メールを送信しました。<br />
            メールに記載されているリンクをクリックして、アカウントの認証を完了してください。
          </p>

          <!-- 注意事項 -->
          <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-700">
              ※ メールが届かない場合は、迷惑メールフォルダをご確認ください。<br />
              ※ これはモック画面です。実際にメールは送信されません。
            </p>
          </div>

          <!-- ログインリンク -->
          <div class="text-sm">
            <Link href="/login" class="font-medium text-orange-500 hover:text-orange-600">
              ログイン画面に戻る
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
