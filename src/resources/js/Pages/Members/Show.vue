<template>
  <div class="min-h-screen bg-gray-50">
    <!-- モバイルヘッダー -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
      <div class="px-4 py-3 flex items-center">
        <Link
          href="/members"
          class="mr-3"
        >
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </Link>
        <h1 class="text-lg font-semibold text-gray-900">プロフィール詳細</h1>
      </div>
    </header>

    <!-- メンバー詳細 -->
    <main class="pb-20">
      <div class="bg-white">
        <!-- プロフィール基本情報 -->
        <div class="px-4 py-6">
          <!-- プロフィール画像（中央配置） -->
          <div class="flex justify-center mb-4">
            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
              <svg v-if="!member.profile_image" class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
              </svg>
              <img v-else :src="member.profile_image" :alt="member.name" class="w-full h-full rounded-full object-cover" />
            </div>
          </div>

          <!-- 名前とレベル -->
          <div class="text-center mb-2">
            <div class="flex items-center justify-center gap-2">
              <h2 class="text-xl font-bold text-gray-900">{{ member.name }}</h2>
              <span class="px-2 py-0.5 text-xs rounded bg-green-500 text-white font-medium">
                {{ member.level }}レベル
              </span>
            </div>
          </div>

          <!-- サブタイトル（パート｜ジャンル） -->
          <p class="text-center text-sm text-gray-600">
            {{ member.parts && member.parts[0] ? member.parts[0] : 'ギター' }} ｜
            {{ member.genres && member.genres[0] ? member.genres[0] : 'ポップス' }}
            {{ member.parts && member.parts[1] ? ' ｜ ' + member.parts[1] : '' }}
          </p>
        </div>

        <!-- 担当パート -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">担当パート</h3>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="(part, index) in member.parts"
              :key="part"
              :class="[
                'px-3 py-1 text-sm rounded-full',
                index % 2 === 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800'
              ]"
            >
              {{ part }}
            </span>
          </div>
        </div>

        <!-- 好きなジャンル -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">好きなジャンル</h3>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="genre in member.genres"
              :key="genre"
              class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full"
            >
              {{ genre }}
            </span>
          </div>
        </div>

        <!-- 音楽の好み -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">音楽の好み</h3>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="preference in getMusicPreferences()"
              :key="preference.name || preference"
              :class="[
                'px-3 py-1 text-sm rounded-full border',
                isMatched(preference)
                  ? 'border-red-400 text-red-600 font-bold'
                  : 'border-gray-300 text-gray-600'
              ]"
            >
              {{ preference.name || preference }}
            </span>
          </div>
        </div>

        <!-- コピーしたい曲 -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">コピーしたい曲</h3>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="song in getSongsToCopy()"
              :key="song.name || song"
              :class="[
                'px-3 py-1 text-sm rounded-full border',
                isMatched(song)
                  ? 'border-red-400 text-red-600 font-bold'
                  : 'border-gray-300 text-gray-600'
              ]"
            >
              {{ song.name || song }}
            </span>
          </div>
        </div>

        <!-- 好きなアーティスト -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">好きなアーティスト</h3>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="artist in getFavoriteArtists()"
              :key="artist.name || artist"
              :class="[
                'px-3 py-1 text-sm rounded-full border',
                isMatched(artist)
                  ? 'border-red-400 text-red-600 font-bold'
                  : 'border-gray-300 text-gray-600'
              ]"
            >
              {{ artist.name || artist }}
            </span>
          </div>
        </div>

        <!-- 自己紹介 -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">自己紹介</h3>
          <p class="text-sm text-gray-600 whitespace-pre-wrap">{{ member.self_introduction }}</p>
        </div>

        <!-- こんな人とバンド組みたい -->
        <div class="px-4 py-4 border-t border-gray-200">
          <h3 class="text-sm font-medium text-gray-900 mb-3">こんな人とバンド組みたい</h3>
          <p class="text-sm text-gray-600 whitespace-pre-wrap">{{ getBandPreference() }}</p>
        </div>
      </div>
    </main>

    <!-- 下部固定ボタン -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-3">
      <button
        @click="sendMessage"
        class="w-full py-3 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-700 transition"
        :disabled="true"
        :title="'メッセージ機能は今後実装予定です'"
      >
        メッセージを送る
      </button>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

// Props
const props = defineProps({
  member: {
    type: Object,
    required: true,
  },
})

// Methods for mock data
const getMusicPreferences = () => {
  // 実際のデータがある場合はそれを使用、なければモックデータ
  if (props.member.music_preferences && Array.isArray(props.member.music_preferences)) {
    return props.member.music_preferences
  }
  // モックデータ（一部をマッチング状態で返す）
  return [
    { name: 'メロディアス', is_matched: true },
    { name: 'グルーヴィー', is_matched: false },
    { name: 'エモーショナル', is_matched: true }
  ]
}

const getSongsToCopy = () => {
  // 実際のデータがある場合はそれを使用、なければモックデータ
  if (props.member.songs_to_copy && Array.isArray(props.member.songs_to_copy)) {
    return props.member.songs_to_copy
  }
  // モックデータ（一部をマッチング状態で返す）
  return [
    { name: '小さな恋のうた', is_matched: true },
    { name: 'チェリー', is_matched: false },
    { name: '天体観測', is_matched: true }
  ]
}

const getFavoriteArtists = () => {
  // 実際のデータがある場合はそれを使用、なければモックデータ
  if (props.member.favorite_artists) {
    // 文字列の場合は配列に変換
    if (typeof props.member.favorite_artists === 'string') {
      const artists = props.member.favorite_artists.split('、')
      // オブジェクト形式に変換（実データの場合は全てマッチングなしで表示）
      return artists.map(artist => ({ name: artist, is_matched: false }))
    }
    if (Array.isArray(props.member.favorite_artists)) {
      // 配列の各要素がオブジェクトかどうかチェック
      if (props.member.favorite_artists.length > 0 && typeof props.member.favorite_artists[0] === 'object') {
        return props.member.favorite_artists
      }
      // 文字列配列の場合はオブジェクトに変換
      return props.member.favorite_artists.map(artist => ({ name: artist, is_matched: false }))
    }
  }
  // モックデータ（一部をマッチング状態で返す）
  return [
    { name: 'BUMP OF CHICKEN', is_matched: true },
    { name: 'スピッツ', is_matched: false },
    { name: 'MONGOL800', is_matched: true }
  ]
}

// マッチング判定メソッド
const isMatched = (item) => {
  // オブジェクトの場合は is_matched プロパティをチェック
  if (typeof item === 'object' && item !== null) {
    return item.is_matched === true
  }
  // 文字列の場合はマッチングなし
  return false
}

const getBandPreference = () => {
  // 実際のデータがある場合はそれを使用、なければモックデータ
  if (props.member.band_preference) {
    return props.member.band_preference
  }
  // モックデータ
  return '音楽を楽しめる人と一緒にバンドを組みたいです！初心者の方も大歓迎です。週末に練習できる方だと嬉しいです。'
}

const sendMessage = () => {
  // メッセージ送信機能は今後実装
  console.log('メッセージ送信機能は今後実装予定です')
}
</script>