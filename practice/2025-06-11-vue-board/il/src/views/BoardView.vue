<template>
  <div>
    <h1>게시판 목록</h1>
    <PostList :posts="store.posts" />
  </div>
</template>

<script setup>
import { usePostStore } from '@/store/postStore'
import PostList from '@/components/Post/PostList.vue'

const store = usePostStore()
</script>

<style scoped>
h1 {
  margin-bottom: 1rem;
}
</style>
