<!-- 최상위 컴포넌트 전체 페이지 구조 -->
<template>
  <div>
    <NavBar />
    <router-view />
  </div>
</template>

<script setup>
import NavBar from '@/components/NavBar.vue'
</script>
