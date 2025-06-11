<template>
  <div v-if="post">
    <h2>📄 게시글 상세</h2>
    <p><strong>ID:</strong> {{ post.id }}</p>
    <p><strong>제목:</strong> {{ post.title }}</p>
    <p><strong>내용:</strong> {{ post.content }}</p>
    
    <router-link :to="`/edit/${post.id}`">✏️ 수정하기</router-link>
    <button @click="deletePost">🗑 삭제하기</button>

  </div>
  <div v-else>
    <p>해당 글을 찾을 수 없습니다.</p>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { usePostStore } from '../stores/postStore'

const route = useRoute()                   // 현재 URL 정보 가져오기
const store = usePostStore()              // 게시글 목록 접근

const id = Number(route.params.id)        // URL에서 id 추출
const post = store.posts.find(p => p.id === id)  // 해당 id의 글 찾기

// 🗑 삭제 함수
function deletePost() {
  if (confirm("정말 삭제하시겠습니까?")) {
    store.posts = store.posts.filter(p => p.id !== id)
    router.push('/')
  }
}
</script>
