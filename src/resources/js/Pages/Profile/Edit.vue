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
            <div class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-lg font-medium">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              マイページ
            </div>
          </nav>
        </div>
      </aside>

      <!-- Main content area -->
      <div class="flex-1 flex flex-col lg:overflow-hidden">
        <!-- モバイルヘッダー -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-10 lg:hidden">
          <div class="px-4 py-3 flex items-center justify-between">
            <Link
              href="/members"
              class="text-gray-600"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
            </Link>
            <h1 class="text-lg font-semibold text-gray-900">プロフィール編集</h1>
            <button
              @click="saveProfile"
              class="text-blue-600 font-medium"
            >
              保存
            </button>
          </div>
        </header>

        <!-- デスクトップヘッダー -->
        <header class="hidden lg:block bg-white border-b border-gray-200">
          <div class="px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">プロフィール編集</h1>
            <button
              @click="saveProfile"
              class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition"
            >
              保存する
            </button>
          </div>
        </header>

        <!-- フォーム -->
        <main class="flex-1 overflow-y-auto pb-20 lg:pb-0">
          <div class="lg:max-w-4xl lg:mx-auto lg:py-8">
            <form @submit.prevent="saveProfile" class="space-y-0">
              <!-- プロフィール画像 -->
              <div class="bg-white px-4 py-6 lg:px-8 lg:py-8 border-b border-gray-200 lg:rounded-t-lg lg:shadow-sm">
                <div class="flex justify-center mb-4 lg:mb-6">
                  <div class="relative">
                    <div class="w-32 h-32 lg:w-40 lg:h-40 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                      <img v-if="form.profile_image_preview" :src="form.profile_image_preview" alt="プロフィール画像" class="w-full h-full object-cover" />
                      <svg v-else class="w-20 h-20 lg:w-24 lg:h-24 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                      </svg>
                    </div>
                    <label class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 lg:p-3 cursor-pointer hover:bg-blue-700 transition">
                      <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                      <input type="file" accept="image/*" class="hidden" @change="handleImageUpload" />
                    </label>
                  </div>
                </div>
                <p class="text-center text-sm lg:text-base text-gray-500">プロフィール画像を選択</p>
              </div>

              <!-- 名前 -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">名前</label>
                <input
                  v-model="form.name"
                  type="text"
                  placeholder="ニックネームを入力"
                  class="w-full px-4 py-2 lg:px-5 lg:py-3 border border-gray-300 rounded-lg text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
              </div>

              <!-- グループ -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">グループ</label>
                <div class="flex gap-2 lg:gap-3">
                  <button
                    v-for="level in levels"
                    :key="level.value"
                    @click.prevent="form.level = level.value"
                    :class="[
                      'flex-1 py-2 lg:py-3 rounded-full text-sm lg:text-base font-medium transition',
                      form.level === level.value ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                  >
                    {{ level.label }}
                  </button>
                </div>
              </div>

              <!-- 担当パート -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">担当パート</label>
                <div class="flex flex-wrap gap-2 lg:gap-3">
                  <button
                    v-for="part in parts"
                    :key="part.value"
                    @click.prevent="togglePart(part.value)"
                    :class="[
                      'px-4 py-2 lg:px-5 lg:py-2.5 rounded-full text-sm lg:text-base font-medium transition',
                      form.parts.includes(part.value) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    type="button"
                  >
                    {{ part.label }}
                  </button>
                </div>
              </div>

              <!-- 好きなジャンル -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">好きなジャンル</label>
                <div class="flex flex-wrap gap-2 lg:gap-3">
                  <button
                    v-for="genre in genres"
                    :key="genre.value"
                    @click.prevent="toggleGenre(genre.value)"
                    :class="[
                      'px-4 py-2 lg:px-5 lg:py-2.5 rounded-full text-sm lg:text-base font-medium transition',
                      form.genres.includes(genre.value) ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]"
                    type="button"
                  >
                    {{ genre.label }}
                  </button>
                </div>
              </div>

              <!-- 音楽の好み -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">音楽の好み</label>
                <div class="space-y-2 lg:space-y-3">
                  <div v-for="(preference, index) in form.music_preferences" :key="index" class="flex gap-2 lg:gap-3">
                    <input
                      v-model="form.music_preferences[index]"
                      type="text"
                      placeholder="例：メロディアス"
                      class="flex-1 px-4 py-2 lg:px-5 lg:py-3 border border-gray-300 rounded-lg text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <button
                      @click.prevent="removeMusicPreference(index)"
                      class="px-3 py-2 lg:px-4 lg:py-3 text-red-600 hover:bg-red-50 rounded-lg transition"
                    >
                      <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <button
                    @click.prevent="addMusicPreference"
                    class="text-blue-600 text-sm lg:text-base font-medium hover:text-blue-700"
                  >
                    + 追加
                  </button>
                </div>
              </div>

              <!-- コピーしたい曲 -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">コピーしたい曲</label>
                <div class="space-y-2 lg:space-y-3">
                  <div v-for="(song, index) in form.songs_to_copy" :key="index" class="flex gap-2 lg:gap-3">
                    <input
                      v-model="form.songs_to_copy[index]"
                      type="text"
                      placeholder="例：小さな恋のうた"
                      class="flex-1 px-4 py-2 lg:px-5 lg:py-3 border border-gray-300 rounded-lg text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <button
                      @click.prevent="removeSongToCopy(index)"
                      class="px-3 py-2 lg:px-4 lg:py-3 text-red-600 hover:bg-red-50 rounded-lg transition"
                    >
                      <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <button
                    @click.prevent="addSongToCopy"
                    class="text-blue-600 text-sm lg:text-base font-medium hover:text-blue-700"
                  >
                    + 追加
                  </button>
                </div>
              </div>

              <!-- 好きなアーティスト -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">好きなアーティスト</label>
                <div class="space-y-2 lg:space-y-3">
                  <div v-for="(artist, index) in form.favorite_artists" :key="index" class="flex gap-2 lg:gap-3">
                    <input
                      v-model="form.favorite_artists[index]"
                      type="text"
                      placeholder="例：BUMP OF CHICKEN"
                      class="flex-1 px-4 py-2 lg:px-5 lg:py-3 border border-gray-300 rounded-lg text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <button
                      @click.prevent="removeFavoriteArtist(index)"
                      class="px-3 py-2 lg:px-4 lg:py-3 text-red-600 hover:bg-red-50 rounded-lg transition"
                    >
                      <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <button
                    @click.prevent="addFavoriteArtist"
                    class="text-blue-600 text-sm lg:text-base font-medium hover:text-blue-700"
                  >
                    + 追加
                  </button>
                </div>
              </div>

              <!-- 自己紹介 -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">自己紹介</label>
                <textarea
                  v-model="form.self_introduction"
                  rows="5"
                  placeholder="音楽経験や活動頻度などを書いてください"
                  class="w-full px-4 py-2 lg:px-5 lg:py-3 border border-gray-300 rounded-lg text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
              </div>

              <!-- こんな人とバンド組みたい -->
              <div class="bg-white px-4 py-4 lg:px-8 lg:py-6 border-b border-gray-200 lg:rounded-b-lg lg:shadow-sm">
                <label class="block text-sm lg:text-base font-medium text-gray-700 mb-2 lg:mb-3">こんな人とバンド組みたい</label>
                <textarea
                  v-model="form.band_preference"
                  rows="5"
                  placeholder="どんな人と一緒に音楽をやりたいか書いてください"
                  class="w-full px-4 py-2 lg:px-5 lg:py-3 border border-gray-300 rounded-lg text-sm lg:text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
              </div>
            </form>
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
        <div class="flex flex-col items-center p-2 text-blue-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="text-xs mt-1">マイページ</span>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { Link, router } from '@inertiajs/vue3'

// Props (実際のデータがある場合)
const props = defineProps({
  user: {
    type: Object,
    default: () => ({})
  }
})

// フォームデータ
const form = reactive({
  name: props.user.name || '',
  level: props.user.level || 'otoshika',
  parts: props.user.parts || [],
  genres: props.user.genres || [],
  music_preferences: props.user.music_preferences || [''],
  songs_to_copy: props.user.songs_to_copy || [''],
  favorite_artists: props.user.favorite_artists || [''],
  self_introduction: props.user.self_introduction || '',
  band_preference: props.user.band_preference || '',
  profile_image: null,
  profile_image_preview: props.user.profile_image || null,
})

// 選択肢のマスターデータ
const levels = [
  { value: 'kojika+', label: 'kojika+' },
  { value: 'otoshika', label: 'otoshika' },
  { value: 'shikamini', label: 'shikamini' },
  { value: 'shikasession', label: 'shikasession' },
  { value: 'sikacrowds', label: 'sikacrowds' }
]

const parts = [
  { value: 'ギター', label: 'ギター' },
  { value: 'ベース', label: 'ベース' },
  { value: 'ドラム', label: 'ドラム' },
  { value: 'キーボード', label: 'キーボード' },
  { value: 'ボーカル', label: 'ボーカル' },
  { value: 'ピアノ', label: 'ピアノ' },
  { value: 'その他', label: 'その他' }
]

const genres = [
  { value: 'ロック', label: 'ロック' },
  { value: 'ポップス', label: 'ポップス' },
  { value: 'ジャズ', label: 'ジャズ' },
  { value: 'ブルース', label: 'ブルース' },
  { value: 'ファンク', label: 'ファンク' },
  { value: 'メタル', label: 'メタル' },
  { value: 'クラシック', label: 'クラシック' },
  { value: 'R&B', label: 'R&B' },
  { value: 'その他', label: 'その他' }
]

// メソッド
const togglePart = (part) => {
  const index = form.parts.indexOf(part)
  if (index > -1) {
    form.parts.splice(index, 1)
  } else {
    form.parts.push(part)
  }
}

const toggleGenre = (genre) => {
  const index = form.genres.indexOf(genre)
  if (index > -1) {
    form.genres.splice(index, 1)
  } else {
    form.genres.push(genre)
  }
}

const handleImageUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.profile_image = file
    const reader = new FileReader()
    reader.onload = (e) => {
      form.profile_image_preview = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const addMusicPreference = () => {
  form.music_preferences.push('')
}

const removeMusicPreference = (index) => {
  if (form.music_preferences.length > 1) {
    form.music_preferences.splice(index, 1)
  }
}

const addSongToCopy = () => {
  form.songs_to_copy.push('')
}

const removeSongToCopy = (index) => {
  if (form.songs_to_copy.length > 1) {
    form.songs_to_copy.splice(index, 1)
  }
}

const addFavoriteArtist = () => {
  form.favorite_artists.push('')
}

const removeFavoriteArtist = (index) => {
  if (form.favorite_artists.length > 1) {
    form.favorite_artists.splice(index, 1)
  }
}

const saveProfile = () => {
  // 空の要素を除去
  form.music_preferences = form.music_preferences.filter(item => item.trim() !== '')
  form.songs_to_copy = form.songs_to_copy.filter(item => item.trim() !== '')
  form.favorite_artists = form.favorite_artists.filter(item => item.trim() !== '')

  // プロフィール保存処理（今はログに出力）
  console.log('プロフィール保存:', form)

  // 実際の実装ではここでAPIを呼ぶ
  // router.post('/profile', form, {
  //   onSuccess: () => {
  //     alert('プロフィールを更新しました')
  //   }
  // })

  alert('プロフィールを保存しました')
}
</script>
