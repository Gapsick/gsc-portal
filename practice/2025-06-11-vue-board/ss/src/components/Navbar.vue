<!-- components/Navbar.vue -->
<template>
  <nav class="navbar">
    <router-link to="/">게시판</router-link>
    <router-link to="/write">글쓰기</router-link>
  </nav>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
</script>

<style scoped>
.navbar {
  display: flex;
  gap: 20px;
  padding: 20px;
  background-color: #f5f5f5;
  border-bottom: 1px solid #ddd;
}
</style>
