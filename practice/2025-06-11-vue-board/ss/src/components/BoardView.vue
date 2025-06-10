<!-- src/views/BoardView.vue -->
<template>
  <div class="board">
    <h1>게시판</h1>

    <button @click="goToWrite">글쓰기</button>

    <ul>
      <li v-for="post in posts" :key="post.id">
        <router-link :to="`/post/${post.id}`">
          {{ post.title }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { usePostsStore } from '../stores/posts'

const router = useRouter()
const { posts } = usePostsStore()

const goToWrite = () => {
  router.push('/write')
}
</script>