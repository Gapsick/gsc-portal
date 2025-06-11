<template>
  <div v-if="post">
    <h2>{{ post.title }}</h2>
    <p>작성자: {{ post.writer }}</p>
    <p>{{ post.content }}</p>
    <p>{{ post.createdAt }}</p>
    <router-link :to="`/board/${post.id}/edit`">수정</router-link>
    <button @click="deletePost">삭제</button>
  </div>
  <div v-else>
    <p>해당 게시글을 찾을 수 없습니다.</p>
  </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { usePostStore } from '@/store/postStore'

const route = useRoute()
const router = useRouter()
const store = usePostStore()

const postId = Number(route.params.id)
const post = store.posts.find(p => p.id === postId)

function deletePost() {
  if (confirm('정말 삭제하시겠습니까?')) {
    store.deletePost(postId)
    router.push('/board')
  }
}
</script>

<style scoped>
h2 {
  margin-bottom: 0.5rem;
}
button {
  margin-left: 1rem;
}
</style>
