<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Desktop layout wrapper -->
    <div class="lg:flex lg:h-screen">
      <!-- Left Sidebar (desktop only) -->
      <aside class="hidden lg:block lg:w-64 lg:flex-shrink-0 bg-white border-r border-gray-200">
        <div class="h-full flex flex-col">
          <!-- Logo -->
          <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
              <img src="/img/icon.png" alt="ShikaMatch" class="w-10 h-10 object-contain" />
              <div>
                <h1 class="text-xl font-bold text-gray-900">ShikaMatch</h1>
                <p class="text-xs text-gray-500">音楽仲間を見つけよう</p>
              </div>
            </div>
          </div>

          <!-- Navigation -->
          <nav class="flex-1 px-4 py-4">
            <Link
              href="/members"
              class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition mb-2"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              ホーム
            </Link>
            <a
              href="/profile"
              class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-lg font-medium"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              マイページ
            </a>
          </nav>
        </div>
      </aside>

      <!-- Main content area -->
      <div class="flex-1 flex flex-col lg:overflow-hidden">
        <!-- モバイルヘッダー -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-10 lg:hidden">
          <div class="px-4 py-3 flex items-center justify-between">
            <h1 class="text-lg font-semibold text-gray-900">マイページ</h1>
            <Link
              href="/profile/edit"
              class="px-4 py-1.5 bg-blue-600 text-white rounded-full text-sm font-medium"
            >
              編集
            </Link>
          </div>
        </header>

        <!-- デスクトップヘッダー -->
        <header class="hidden lg:block bg-white border-b border-gray-200">
          <div class="px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">マイページ</h1>
            <Link
              href="/profile/edit"
              class="px-6 py-2 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-700 transition"
            >
              プロフィールを編集
            </Link>
          </div>
        </header>

        <!-- プロフィール詳細 -->
        <main class="flex-1 overflow-y-auto pb-20 lg:pb-0">
          <div class="lg:max-w-4xl lg:mx-auto lg:py-8">
            <div class="bg-white lg:rounded-lg lg:shadow-sm">
              <!-- プロフィール基本情報 -->
              <div class="px-4 py-6 lg:px-8 lg:py-8">
                <!-- プロフィール画像（中央配置） -->
                <div class="flex justify-center mb-4 lg:mb-6">
                  <div class="w-32 h-32 lg:w-40 lg:h-40 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg v-if="!user.profile_image" class="w-20 h-20 lg:w-24 lg:h-24 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <img v-else :src="user.profile_image" :alt="user.name" class="w-full h-full rounded-full object-cover" />
                  </div>
                </div>

                <!-- 名前とグループ -->
                <div class="text-center mb-2 lg:mb-4">
                  <div class="flex items-center justify-center gap-2 lg:gap-3">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-900">{{ user.name }}</h2>
                    <span
                      :class="[
                        'px-2 py-0.5 lg:px-3 lg:py-1 text-xs lg:text-sm rounded font-medium',
                        user.level === 'kojika+' ? 'bg-blue-100 text-blue-800' :
                        user.level === 'otoshika' ? 'bg-green-100 text-green-800' :
                        user.level === 'shikamini' ? 'bg-yellow-100 text-yellow-800' :
                        user.level === 'shikasession' ? 'bg-orange-100 text-orange-800' :
                        'bg-purple-100 text-purple-800'
                      ]"
                    >
                      {{ user.level }}
                    </span>
                  </div>
                </div>

                <!-- サブタイトル（パート｜ジャンル） -->
                <p class="text-center text-sm lg:text-base text-gray-600">
                  {{ user.parts && user.parts[0] ? user.parts[0] : 'ギター' }} ｜
                  {{ user.genres && user.genres[0] ? user.genres[0] : 'ポップス' }}
                  {{ user.parts && user.parts[1] ? ' ｜ ' + user.parts[1] : '' }}
                </p>
              </div>

              <!-- 担当パート -->
              <div class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">担当パート</h3>
                <div class="flex flex-wrap gap-2 lg:gap-3">
                  <!-- メインパート（ベタ塗り） -->
                  <span
                    v-for="(part, index) in user.parts"
                    :key="`main-${part}`"
                    :class="[
                      'px-3 py-1 lg:px-4 lg:py-2 text-sm lg:text-base rounded-full',
                      index % 2 === 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800'
                    ]"
                  >
                    {{ part }}
                  </span>
                  <!-- サブパート（白抜き） -->
                  <span
                    v-for="(part, index) in user.sub_parts"
                    :key="`sub-${part}`"
                    :class="[
                      'px-3 py-1 lg:px-4 lg:py-2 text-sm lg:text-base rounded-full bg-white border-2',
                      index % 2 === 0 ? 'border-yellow-400 text-yellow-800' : 'border-blue-400 text-blue-800'
                    ]"
                  >
                    {{ part }}
                  </span>
                </div>
              </div>

              <!-- 好きなジャンル -->
              <div class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">好きなジャンル</h3>
                <div class="flex flex-wrap gap-2 lg:gap-3">
                  <span
                    v-for="genre in user.genres"
                    :key="genre"
                    class="px-3 py-1 lg:px-4 lg:py-2 bg-gray-100 text-gray-700 text-sm lg:text-base rounded-full"
                  >
                    {{ genre }}
                  </span>
                </div>
              </div>

              <!-- 音楽の好み -->
              <div v-if="user.music_preferences && user.music_preferences.length > 0" class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">音楽の好み</h3>
                <div class="flex flex-wrap gap-2 lg:gap-3">
                  <span
                    v-for="preference in user.music_preferences"
                    :key="preference"
                    class="px-3 py-1 lg:px-4 lg:py-2 text-sm lg:text-base rounded-full border border-gray-300 text-gray-600"
                  >
                    {{ preference }}
                  </span>
                </div>
              </div>

              <!-- コピーしたい曲 -->
              <div v-if="user.songs_to_copy && user.songs_to_copy.length > 0" class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">コピーしたい曲</h3>
                <div class="grid gap-3 lg:gap-4 sm:grid-cols-2">
                  <div
                    v-for="(song, index) in getSongsData()"
                    :key="index"
                    class="bg-gray-50 p-3 lg:p-4 rounded-lg border border-gray-200 hover:shadow-sm transition"
                  >
                    <div class="flex items-start justify-between">
                      <div class="flex-1">
                        <h4 class="text-sm lg:text-base font-medium text-gray-900">
                          {{ typeof song === 'object' ? song.title : song }}
                        </h4>
                        <p v-if="typeof song === 'object' && song.artist" class="text-xs lg:text-sm text-gray-600 mt-1">
                          {{ song.artist }}
                        </p>
                      </div>
                      <a
                        v-if="typeof song === 'object' && song.youtube_url"
                        :href="song.youtube_url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="ml-3 text-red-600 hover:text-red-700 transition flex items-center"
                        title="YouTubeで見る"
                      >
                        <svg class="w-6 h-6 lg:w-7 lg:h-7" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 好きなアーティスト -->
              <div v-if="user.favorite_artists && user.favorite_artists.length > 0" class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">好きなアーティスト</h3>
                <div class="flex flex-wrap gap-2 lg:gap-3">
                  <span
                    v-for="artist in getFavoriteArtists()"
                    :key="artist"
                    class="px-3 py-1 lg:px-4 lg:py-2 text-sm lg:text-base rounded-full border border-gray-300 text-gray-600"
                  >
                    {{ artist }}
                  </span>
                </div>
              </div>

              <!-- 自己紹介 -->
              <div class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">自己紹介</h3>
                <p class="text-sm lg:text-base text-gray-600 whitespace-pre-wrap">{{ user.self_introduction || '自己紹介が未設定です' }}</p>
              </div>

              <!-- こんな人とバンド組みたい -->
              <div v-if="user.band_preference" class="px-4 py-4 lg:px-8 lg:py-6 border-t border-gray-200">
                <h3 class="text-sm lg:text-base font-medium text-gray-900 mb-3 lg:mb-4">こんな人とバンド組みたい</h3>
                <p class="text-sm lg:text-base text-gray-600 whitespace-pre-wrap">{{ user.band_preference }}</p>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <!-- 下部ナビゲーション (mobile only) -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 lg:hidden">
      <div class="flex justify-around py-2">
        <Link href="/members" class="flex flex-col items-center p-2 text-gray-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span class="text-xs mt-1">ホーム</span>
        </Link>
        <a href="/profile" class="flex flex-col items-center p-2 text-blue-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="text-xs mt-1">マイページ</span>
        </a>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

// Props
const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
})

// Methods for handling favorite artists
const getFavoriteArtists = () => {
  if (props.user.favorite_artists) {
    // 文字列の場合は配列に変換
    if (typeof props.user.favorite_artists === 'string') {
      return props.user.favorite_artists.split('、')
    }
    if (Array.isArray(props.user.favorite_artists)) {
      return props.user.favorite_artists
    }
  }
  return []
}

// Methods for handling songs data (backward compatibility)
const getSongsData = () => {
  if (props.user.songs_to_copy && Array.isArray(props.user.songs_to_copy)) {
    return props.user.songs_to_copy
  }
  return []
}
</script>