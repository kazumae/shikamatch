<template>
  <div class="min-h-screen bg-gray-50">
    <!-- デスクトップ用レイアウト (lg以上) -->
    <div class="lg:flex lg:h-screen">
      <!-- サイドバー (デスクトップのみ) -->
      <aside class="hidden lg:block lg:w-64 lg:flex-shrink-0 bg-white border-r border-gray-200">
        <div class="h-full flex flex-col">
          <!-- ロゴ/タイトル -->
          <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
              <img src="/img/icon.png" alt="ShikaMatch" class="w-10 h-10 object-contain" />
              <div>
                <h1 class="text-xl font-bold text-gray-900">ShikaMatch</h1>
                <p class="text-xs text-gray-500">音楽仲間を見つけよう</p>
              </div>
            </div>
          </div>

          <!-- ナビゲーション -->
          <nav class="flex-1 px-4 py-4">
            <div class="space-y-2">
              <a href="/members" class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-lg font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                ホーム
              </a>
              <button @click="goToProfile" class="w-full flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                マイページ
              </button>
            </div>
          </nav>
        </div>
      </aside>

      <!-- メインコンテンツ -->
      <div class="flex-1 flex flex-col lg:overflow-hidden">
        <!-- モバイルヘッダー / デスクトップヘッダー -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
          <div class="px-4 py-3 lg:px-6 lg:py-4">
            <!-- モバイルヘッダー -->
            <div class="lg:hidden">
              <h1 class="text-lg font-semibold text-gray-900 text-center">メンバー検索</h1>
            </div>

            <!-- デスクトップヘッダー -->
            <div class="hidden lg:flex lg:items-center lg:justify-between">
              <div>
                <h1 class="text-2xl font-semibold text-gray-900">メンバー一覧</h1>
                <p class="text-sm text-gray-500 mt-1">{{ members.total || 0 }}人のメンバーが見つかりました</p>
              </div>
            </div>
          </div>
        </header>

        <!-- 検索バー -->
        <div class="bg-white px-4 py-3 border-b border-gray-200 lg:px-6 lg:py-4">
          <div class="relative max-w-2xl mx-auto lg:mx-0">
            <input
              v-model="searchKeyword"
              @keyup.enter="performQuickSearch"
              type="text"
              placeholder="名前、楽器、ジャンルで検索"
              class="w-full pl-10 pr-12 py-2 lg:py-3 bg-gray-100 rounded-full text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <svg class="absolute left-3 top-2.5 lg:top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <button
              @click="showSearchModal = true"
              class="absolute right-2 top-1.5 lg:top-2.5 p-1.5 text-gray-500 hover:text-gray-700"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
              </svg>
            </button>
          </div>
        </div>

        <!-- メンバーリスト -->
        <main class="flex-1 overflow-y-auto pb-20 lg:pb-0">
          <div class="px-4 py-4 lg:px-6 lg:py-6">
            <!-- デスクトップ用グリッドレイアウト -->
            <div class="grid gap-3 lg:gap-4 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
              <div
                v-for="member in members.data"
                :key="member.id"
                @click="viewMemberDetail(member.id)"
                class="bg-white rounded-lg p-4 shadow-sm flex gap-3 cursor-pointer hover:shadow-md transition lg:flex-col lg:gap-4"
              >
                <!-- プロフィール画像 -->
                <div class="w-16 h-16 lg:w-32 lg:h-32 lg:mx-auto bg-gray-200 rounded-full flex-shrink-0 flex items-center justify-center">
                  <svg v-if="!member.profile_image" class="w-10 h-10 lg:w-20 lg:h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                  </svg>
                  <img v-else :src="member.profile_image" :alt="member.name" class="w-full h-full rounded-full object-cover" />
                </div>

                <!-- メンバー情報 -->
                <div class="flex-1 min-w-0 lg:text-center">
                  <!-- 名前とレベルバッジ -->
                  <div class="flex items-start justify-between mb-1 lg:flex-col lg:items-center lg:gap-2">
                    <h3 class="font-semibold text-gray-900 lg:text-lg">{{ member.name }}</h3>
                    <span
                      :class="[
                        'px-2 py-0.5 text-xs rounded-full font-medium lg:text-sm lg:px-3 lg:py-1',
                        member.level === 'kojika+' ? 'bg-blue-100 text-blue-800' :
                        member.level === 'otoshika' ? 'bg-green-100 text-green-800' :
                        member.level === 'shikamini' ? 'bg-yellow-100 text-yellow-800' :
                        member.level === 'shikasession' ? 'bg-orange-100 text-orange-800' :
                        'bg-purple-100 text-purple-800'
                      ]"
                    >
                      {{ member.level }}
                    </span>
                  </div>

                  <!-- パート -->
                  <div class="flex flex-wrap gap-1 mb-2 lg:justify-center lg:gap-2">
                    <span
                      v-for="part in member.parts"
                      :key="part"
                      class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded lg:text-sm lg:px-3 lg:py-1"
                    >
                      {{ part }}
                    </span>
                    <span
                      v-for="genre in member.genres"
                      :key="genre"
                      class="px-2 py-0.5 bg-gray-100 text-gray-700 text-xs rounded lg:text-sm lg:px-3 lg:py-1"
                    >
                      {{ genre }}
                    </span>
                  </div>

                  <!-- 自己紹介（2行まで表示） -->
                  <p class="text-sm text-gray-600 line-clamp-2 lg:text-base">
                    {{ member.self_introduction }}
                  </p>
                </div>
              </div>
            </div>

            <!-- メンバーがいない場合 -->
            <div v-if="members.data.length === 0" class="text-center py-12">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
              <p class="mt-4 text-gray-600">メンバーが見つかりませんでした</p>
            </div>
          </div>

          <!-- ページネーション（後で実装） -->
          <div v-if="members.data.length > 0" class="px-4 py-4 lg:px-6 lg:py-6 border-t border-gray-200">
            <!-- ページネーションコンポーネントをここに追加 -->
          </div>
        </main>
      </div>
    </div>

    <!-- 下部ナビゲーション（モバイルのみ） -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 lg:hidden">
      <div class="flex justify-around py-2">
        <button class="flex flex-col items-center p-2 text-blue-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span class="text-xs mt-1">ホーム</span>
        </button>
        <button @click="goToProfile" class="flex flex-col items-center p-2 text-gray-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="text-xs mt-1">マイページ</span>
        </button>
      </div>
    </nav>

    <!-- 検索モーダル -->
    <div v-if="showSearchModal" class="fixed inset-0 z-50 flex items-center justify-center p-4">
      <div class="fixed inset-0" style="background-color: rgba(0, 0, 0, 0.5);" @click="showSearchModal = false"></div>
      <div class="relative bg-white rounded-2xl w-full max-w-lg mx-auto">
        <!-- モーダルヘッダー -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
          <button @click="showSearchModal = false" class="p-1">
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <h3 class="text-lg font-semibold">検索条件</h3>
          <div class="w-8"></div>
        </div>

        <!-- モーダル内容 -->
        <div class="px-4 py-4 max-h-[60vh] overflow-y-auto">
          <!-- フリーワード -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">フリーワード</label>
            <input
              v-model="modalSearchKeyword"
              type="text"
              placeholder="名前、自己紹介文で検索"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <!-- グループ（レベル） -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">グループ（レベル）</label>
            <div class="flex gap-2">
              <button
                @click="selectedLevel = ''"
                :class="[
                  'px-4 py-2 rounded-full text-sm font-medium transition',
                  selectedLevel === '' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'
                ]"
              >
                全て
              </button>
              <button
                v-for="level in filterOptions.levels"
                :key="level.value"
                @click="selectedLevel = level.value"
                :class="[
                  'px-4 py-2 rounded-full text-sm font-medium transition',
                  selectedLevel === level.value ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'
                ]"
              >
                {{ level.label }}
              </button>
            </div>
          </div>

          <!-- 担当パート -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">担当パート</label>
            <div class="flex flex-wrap gap-2">
              <button
                v-for="part in filterOptions.parts"
                :key="part.value"
                @click="togglePart(part.value)"
                :class="[
                  'px-4 py-2 rounded-full text-sm font-medium transition',
                  selectedParts.includes(part.value) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'
                ]"
              >
                {{ part.label }}
              </button>
            </div>
          </div>

          <!-- ジャンル -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">ジャンル</label>
            <div class="flex flex-wrap gap-2">
              <button
                v-for="genre in filterOptions.genres"
                :key="genre.value"
                @click="toggleGenre(genre.value)"
                :class="[
                  'px-4 py-2 rounded-full text-sm font-medium transition',
                  selectedGenres.includes(genre.value) ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700'
                ]"
              >
                {{ genre.label }}
              </button>
            </div>
          </div>
        </div>

        <!-- モーダルフッター -->
        <div class="px-4 py-3 border-t border-gray-200 flex gap-3">
          <button
            @click="clearModalFilters"
            class="flex-1 py-2 text-gray-600 text-sm font-medium"
          >
            クリア
          </button>
          <button
            @click="applyModalFilters"
            class="flex-1 py-2 bg-blue-600 text-white rounded-full text-sm font-medium"
          >
            検索する
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

// Props from the controller
const props = defineProps({
  members: Object,
  filters: Object,
  filterOptions: Object,
})

// State
const searchKeyword = ref(props.filters?.keyword || '')
const showSearchModal = ref(false)

// Modal state
const modalSearchKeyword = ref(props.filters?.keyword || '')
const selectedLevel = ref(props.filters?.level || '')
const selectedParts = ref(props.filters?.parts || [])
const selectedGenres = ref(props.filters?.genres || [])

// Methods
const performQuickSearch = () => {
  const filters = {}
  if (searchKeyword.value) {
    filters.keyword = searchKeyword.value
  }

  router.get('/members', filters, {
    preserveState: true,
    preserveScroll: true,
  })
}

const togglePart = (part) => {
  const index = selectedParts.value.indexOf(part)
  if (index > -1) {
    selectedParts.value.splice(index, 1)
  } else {
    selectedParts.value.push(part)
  }
}

const toggleGenre = (genre) => {
  const index = selectedGenres.value.indexOf(genre)
  if (index > -1) {
    selectedGenres.value.splice(index, 1)
  } else {
    selectedGenres.value.push(genre)
  }
}

const clearModalFilters = () => {
  modalSearchKeyword.value = ''
  selectedLevel.value = ''
  selectedParts.value = []
  selectedGenres.value = []
}

const applyModalFilters = () => {
  const filters = {}
  if (modalSearchKeyword.value) {
    filters.keyword = modalSearchKeyword.value
  }
  if (selectedLevel.value) {
    filters.level = selectedLevel.value
  }
  if (selectedParts.value.length > 0) {
    filters.parts = selectedParts.value
  }
  if (selectedGenres.value.length > 0) {
    filters.genres = selectedGenres.value
  }

  searchKeyword.value = modalSearchKeyword.value
  showSearchModal.value = false

  router.get('/members', filters, {
    preserveState: true,
    preserveScroll: true,
  })
}

const viewMemberDetail = (id) => {
  router.visit(`/members/${id}`)
}

const goToProfile = () => {
  router.visit('/profile/edit')
}
</script>

<style scoped>
.line-clamp-2 {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
</style>