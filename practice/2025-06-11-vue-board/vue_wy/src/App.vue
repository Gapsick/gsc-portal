<template>
  <header class="nav">
    <RouterLink to="/">홈</RouterLink>
    <RouterLink to="/new">글 작성</RouterLink>
  </header>

  <RouterView />
</template>

<style scoped>
.nav {
  display: flex;
  gap: 20px; 
  margin-bottom: 24px; 
  padding: 20px;
  font-weight: bold;
}
</style>
