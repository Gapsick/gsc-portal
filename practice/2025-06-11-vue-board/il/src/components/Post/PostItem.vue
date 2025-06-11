<template>
  <div class="post-card">
    <router-link :to="`/board/${post.id}`">
      <h3>{{ post.title }}</h3>
    </router-link>
    <p>{{ post.writer }} · {{ post.createdAt }}</p>
  </div>
</template>

<script setup>
defineProps({
  post: Object
})
</script>

<style scoped>
.post-card {
  padding: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
}
</style>
