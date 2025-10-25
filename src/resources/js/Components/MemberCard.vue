<template>
  <div
    @click="$emit('click')"
    class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer overflow-hidden"
  >
    <!-- プロフィール画像 -->
    <div class="aspect-square bg-gray-200 relative">
      <img
        v-if="member.profile_image"
        :src="member.profile_image"
        :alt="`${member.name}のプロフィール画像`"
        class="w-full h-full object-cover"
      />
      <div v-else class="w-full h-full flex items-center justify-center">
        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
      </div>
      <!-- グループバッジ -->
      <span
        :class="[
          'absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded',
          getLevelBadgeClass(member.level)
        ]"
      >
        {{ member.level }}
      </span>
    </div>

    <!-- カード情報 -->
    <div class="p-4">
      <!-- 名前とエリア -->
      <div class="mb-2">
        <h3 class="text-lg font-semibold text-gray-900">{{ member.name }}</h3>
        <p class="text-sm text-gray-600">{{ member.area }}</p>
      </div>

      <!-- タグ: 担当パート -->
      <div class="mb-2">
        <div class="flex flex-wrap gap-1">
          <span
            v-for="part in member.parts.slice(0, 3)"
            :key="part"
            class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded"
          >
            {{ part }}
          </span>
          <span
            v-if="member.parts.length > 3"
            class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded"
          >
            +{{ member.parts.length - 3 }}
          </span>
        </div>
      </div>

      <!-- タグ: ジャンル -->
      <div class="mb-3">
        <div class="flex flex-wrap gap-1">
          <span
            v-for="genre in member.genres.slice(0, 2)"
            :key="genre"
            class="inline-block px-2 py-1 text-xs bg-green-100 text-green-700 rounded"
          >
            {{ genre }}
          </span>
          <span
            v-if="member.genres.length > 2"
            class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded"
          >
            +{{ member.genres.length - 2 }}
          </span>
        </div>
      </div>

      <!-- 自己紹介（冒頭部分） -->
      <p class="text-sm text-gray-700 line-clamp-3">
        {{ member.self_introduction }}
      </p>

      <!-- 登録日 -->
      <p class="mt-3 text-xs text-gray-500">
        登録日: {{ formatDate(member.created_at) }}
      </p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

// Props
const props = defineProps({
  member: {
    type: Object,
    required: true,
  },
})

// Emits
defineEmits(['click'])

// Methods
const getLevelBadgeClass = (level) => {
  switch (level) {
    case '初級':
      return 'bg-green-500 text-white'
    case '中級':
      return 'bg-blue-500 text-white'
    case '上級':
      return 'bg-purple-500 text-white'
    default:
      return 'bg-gray-500 text-white'
  }
}

const formatDate = (dateString) => {
  const date = new Date(dateString)
  const year = date.getFullYear()
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const day = String(date.getDate()).padStart(2, '0')
  return `${year}/${month}/${day}`
}
</script>

<style scoped>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>