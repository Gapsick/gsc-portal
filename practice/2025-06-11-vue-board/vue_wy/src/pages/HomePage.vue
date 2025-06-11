<template>
  <div>
    <h1>게시판 목록</h1>
    <PostList :posts="postStore.posts" />
  </div>
</template>

<script setup>
import { usePostStore } from '@/stores/postStore'
import PostList from '@/components/PostList.vue'

const postStore = usePostStore()
</script>
<style scoped>
ul {
  padding-left: 20px;
}

li {
  margin-bottom: 10px;
  font-size: 18px;
}
</style>
