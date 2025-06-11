<template>
  <PostForm mode="edit" :post="post" @submit="handleEdit" />
</template>

<script setup>
import PostForm from '@/components/PostForm.vue'
import { useRoute, useRouter } from 'vue-router'
import { usePostStore } from '@/stores/postStore'

const route = useRoute()
const router = useRouter()
const postStore = usePostStore()

const postId = parseInt(route.params.id)
const post = postStore.posts.find(p => p.id === postId)

function handleEdit({ title, content }) {
  postStore.updatePost(postId, title, content)
  alert('수정 완료!')
  router.push(`/view/${postId}`)
}
</script>


<style scoped>
div {
  display: flex;
  flex-direction: column;
  gap: 16px;
  max-width: 700px;
  margin: 40px auto;
}

input {
  padding: 14px;
  font-size: 18px;
  border: 1px solid #ccc;
  border-radius: 8px;
}

textarea {
  height: 200px;
  padding: 16px;
  font-size: 18px;
  resize: vertical;
  border: 1px solid #ccc;
  border-radius: 8px;
  line-height: 1.5;
}

button {
  align-self: flex-start;
  padding: 12px 24px;
  font-size: 18px;
  background-color: #42b983;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

button:hover {
  background-color: #369f72;
}
</style>
