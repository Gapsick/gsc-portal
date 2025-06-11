<template>
  <nav>
    <router-link to="/board">게시판</router-link>
    <router-link to="/board/new">글쓰기</router-link>
  </nav>
</template>

<script setup>
</script>

<style scoped>
nav {
  display: flex;
  gap: 1rem;
  padding: 1rem;
  background-color: #f5f5f5;
}
router-link {
  text-decoration: none;
  color: #333;
}
</style>
