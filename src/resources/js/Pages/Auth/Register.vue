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
        新規登録
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        音楽仲間を見つけよう
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form @submit.prevent="handleRegister" class="space-y-6">
          <!-- 名前 -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
              名前
            </label>
            <div class="mt-1">
              <input
                id="name"
                v-model="form.name"
                type="text"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
              />
            </div>
          </div>

          <!-- メールアドレス -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              メールアドレス
            </label>
            <div class="mt-1">
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
              />
            </div>
          </div>

          <!-- パスワード -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              パスワード
            </label>
            <div class="mt-1">
              <input
                id="password"
                v-model="form.password"
                type="password"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
              />
            </div>
          </div>

          <!-- パスワード（確認） -->
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
              パスワード（確認）
            </label>
            <div class="mt-1">
              <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-orange-500 focus:border-orange-500"
              />
            </div>
          </div>

          <!-- 登録ボタン -->
          <div>
            <button
              type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
            >
              登録
            </button>
          </div>
        </form>

        <!-- ログインリンク -->
        <div class="mt-6">
          <div class="relative">
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">
                すでにアカウントをお持ちの方は
                <Link href="/login" class="font-medium text-orange-500 hover:text-orange-600">
                  ログイン
                </Link>
              </span>
            </div>
          </div>
        </div>

        <!-- 説明テキスト -->
        <div class="mt-6">
          <p class="text-center text-xs text-gray-500">
            ※ これはモック画面です。任意の情報で登録できます。
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router, Link } from '@inertiajs/vue3'

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const handleRegister = () => {
  // 登録処理をサーバーに送信
  router.post('/register', form)
}
</script>
