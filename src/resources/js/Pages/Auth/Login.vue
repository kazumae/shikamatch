<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <!-- ロゴ -->
      <div class="flex justify-center">
        <div class="flex items-center space-x-2">
          <svg class="w-10 h-10 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
          </svg>
          <h1 class="text-3xl font-bold text-gray-900">ShikaMatch</h1>
        </div>
      </div>
      <h2 class="mt-6 text-center text-2xl font-semibold text-gray-900">
        ログイン
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        音楽仲間を見つけよう
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form @submit.prevent="handleLogin" class="space-y-6">
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

          <!-- ログインボタン -->
          <div>
            <button
              type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
            >
              ログイン
            </button>
          </div>
        </form>

        <!-- 説明テキスト -->
        <div class="mt-6">
          <p class="text-center text-xs text-gray-500">
            ※ これはモック画面です。任意のメールアドレスとパスワードでログインできます。
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
  email: '',
  password: '',
})

const handleLogin = () => {
  // モック実装: 任意の入力でログイン成功としてメンバー一覧へ遷移
  router.visit('/members')
}
</script>
