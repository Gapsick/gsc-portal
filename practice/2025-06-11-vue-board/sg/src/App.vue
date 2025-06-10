<template>
  <div class="layout">
    <header class="navbar">
      <RouterLink to="/" class="logo">MyBoard</RouterLink>
      <nav>
        <RouterLink to="/" class="nav-item">홈</RouterLink>
        <RouterLink to="/write" class="nav-item">글쓰기</RouterLink>
      </nav>
    </header>

    <main class="container">
      <router-view />
    </main>

  </div>
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<style scoped>
.layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #42b983;
  padding: 1rem 2rem;
  color: white;
}

.logo {
  font-size: 1.5rem;
  font-weight: bold;
  color: white;
  text-decoration: none;
}

.nav-item {
  margin-left: 1rem;
  color: white;
  text-decoration: none;
}

.nav-item:hover {
  text-decoration: underline;
}

.container {
  max-width: 720px;
  margin: 0 auto;
  padding: 2rem;
  font-family: 'Arial', sans-serif;
  flex: 1;
}

.footer {
  text-align: center;
  padding: 1rem;
  background-color: #f2f2f2;
  font-size: 0.875rem;
}
</style>