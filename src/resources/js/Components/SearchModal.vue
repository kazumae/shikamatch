<template>
  <!-- モーダルオーバーレイ -->
  <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" @click="$emit('close')">
    <!-- モーダルコンテンツ -->
    <div
      class="relative top-20 mx-auto p-6 border w-full max-w-2xl shadow-lg rounded-lg bg-white"
      @click.stop
    >
      <!-- モーダルヘッダー -->
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-900">検索条件を設定</h3>
        <button
          @click="$emit('close')"
          class="text-gray-400 hover:text-gray-600 transition"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- 検索フォーム -->
      <form @submit.prevent="handleSearch">
        <!-- フリーワード検索 -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">
            フリーワード検索
          </label>
          <input
            v-model="searchForm.keyword"
            type="text"
            placeholder="名前や自己紹介文から検索"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- レベル選択 -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">
            レベル
          </label>
          <div class="flex gap-2">
            <button
              v-for="level in filterOptions.levels"
              :key="level.value"
              type="button"
              @click="toggleLevel(level.value)"
              :class="[
                'px-4 py-2 rounded-md transition',
                searchForm.level === level.value
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ level.label }}
            </button>
          </div>
        </div>

        <!-- 担当パート選択（複数選択可） -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">
            担当パート（複数選択可）
          </label>
          <div class="flex flex-wrap gap-2">
            <button
              v-for="part in filterOptions.parts"
              :key="part.value"
              type="button"
              @click="togglePart(part.value)"
              :class="[
                'px-3 py-1.5 rounded-md transition',
                searchForm.parts.includes(part.value)
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ part.label }}
            </button>
          </div>
        </div>

        <!-- ジャンル選択（複数選択可） -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">
            ジャンル（複数選択可）
          </label>
          <div class="flex flex-wrap gap-2">
            <button
              v-for="genre in filterOptions.genres"
              :key="genre.value"
              type="button"
              @click="toggleGenre(genre.value)"
              :class="[
                'px-3 py-1.5 rounded-md transition',
                searchForm.genres.includes(genre.value)
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ genre.label }}
            </button>
          </div>
        </div>

        <!-- エリア選択 -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">
            活動エリア
          </label>
          <select
            v-model="searchForm.area"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="">すべてのエリア</option>
            <option v-for="area in filterOptions.areas" :key="area.value" :value="area.value">
              {{ area.label }}
            </option>
          </select>
        </div>

        <!-- ボタン -->
        <div class="flex justify-between">
          <button
            type="button"
            @click="clearForm"
            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition"
          >
            条件をクリア
          </button>
          <div class="flex gap-2">
            <button
              type="button"
              @click="$emit('close')"
              class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition"
            >
              キャンセル
            </button>
            <button
              type="submit"
              class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition"
            >
              検索する
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'

// Props
const props = defineProps({
  filterOptions: {
    type: Object,
    required: true,
  },
  initialFilters: {
    type: Object,
    default: () => ({}),
  },
})

// Emits
const emit = defineEmits(['close', 'search'])

// State
const searchForm = reactive({
  keyword: '',
  level: '',
  parts: [],
  genres: [],
  area: '',
})

// Initialize form with existing filters
onMounted(() => {
  if (props.initialFilters.keyword) {
    searchForm.keyword = props.initialFilters.keyword
  }
  if (props.initialFilters.level) {
    searchForm.level = props.initialFilters.level
  }
  if (props.initialFilters.parts) {
    searchForm.parts = [...props.initialFilters.parts]
  }
  if (props.initialFilters.genres) {
    searchForm.genres = [...props.initialFilters.genres]
  }
  if (props.initialFilters.area) {
    searchForm.area = props.initialFilters.area
  }
})

// Methods
const toggleLevel = (level) => {
  if (searchForm.level === level) {
    searchForm.level = ''
  } else {
    searchForm.level = level
  }
}

const togglePart = (part) => {
  const index = searchForm.parts.indexOf(part)
  if (index > -1) {
    searchForm.parts.splice(index, 1)
  } else {
    searchForm.parts.push(part)
  }
}

const toggleGenre = (genre) => {
  const index = searchForm.genres.indexOf(genre)
  if (index > -1) {
    searchForm.genres.splice(index, 1)
  } else {
    searchForm.genres.push(genre)
  }
}

const clearForm = () => {
  searchForm.keyword = ''
  searchForm.level = ''
  searchForm.parts = []
  searchForm.genres = []
  searchForm.area = ''
}

const handleSearch = () => {
  // Filter out empty values
  const filters = {}
  if (searchForm.keyword) filters.keyword = searchForm.keyword
  if (searchForm.level) filters.level = searchForm.level
  if (searchForm.parts.length > 0) filters.parts = searchForm.parts
  if (searchForm.genres.length > 0) filters.genres = searchForm.genres
  if (searchForm.area) filters.area = searchForm.area

  emit('search', filters)
}
</script>