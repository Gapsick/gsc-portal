<template>
  <div>
    <h1>📘 게시판</h1>
    <nav>
      <router-link to="/">목록</router-link> |
      <router-link to="/write">글 작성</router-link>
    </nav>

    <router-view />
  </div>
</template>

<script setup>
// 특별히 할 일 없음
</script>

<style>
nav {
  margin-bottom: 1rem;
}
</style>
