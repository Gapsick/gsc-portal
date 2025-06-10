<template>
  <div v-if="post">
    <h1>{{ post.title }}</h1>
    <p>{{ post.content }}</p>

    <div class="button-group">
      <router-link :to="`/edit/${post.id}`">
        <button>수정</button>
      </router-link>

      <button @click="deletePost">삭제</button>
    </div>

    <router-link to="/">목록으로 돌아가기</router-link>
  </div>

  <div v-else>
    <p>해당 게시글을 찾을 수 없습니다.</p>
  </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { usePostsStore } from '../stores/posts'
import { computed } from 'vue'

const route = useRoute()
const router = useRouter()
const postsStore = usePostsStore()

const post = computed(() => postsStore.getPostById(route.params.id))

// 삭제 로직
const deletePost = () => {
  const confirmDelete = window.confirm('정말 삭제하시겠습니까?')
  if (confirmDelete) {
    postsStore.deletePost(post.value.id)
    router.push('/')
  }
}
</script>
