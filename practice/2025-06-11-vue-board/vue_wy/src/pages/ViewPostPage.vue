<template>
  <div>
    <h1>글 상세</h1>
    
    <!-- 글 내용 보여주기 -->
    <PostDetail :post="post" />

    <!-- 수정 / 삭제 버튼 -->
    <button @click="goEdit">수정하기</button>
    <button @click="removePost">삭제하기</button>
  </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { usePostStore } from '@/stores/postStore'
import PostDetail from '@/components/PostDetail.vue'

const route = useRoute()
const router = useRouter()
const postStore = usePostStore()

const postId = parseInt(route.params.id)
const post = postStore.posts.find(p => p.id === postId)

function goEdit() {
  router.push(`/edit/${postId}`)
}

function removePost() {
  if (confirm('정말 삭제하시겠습니까?')) {
    postStore.deletePost(postId)
    alert('삭제 완료!')
    router.push('/')
  }
}
</script>
