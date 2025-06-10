<template>
  <div v-if="post">
    <h1>글 수정</h1>

    <form @submit.prevent="updatePost">
      <input v-model="title" placeholder="제목" required />
      <textarea v-model="content" placeholder="내용" required></textarea>
      <button type="submit">수정 완료</button>
    </form>
  </div>

  <div v-else>
    <p>해당 게시글을 찾을 수 없습니다.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { usePostsStore } from '../stores/posts'

const route = useRoute()
const router = useRouter()
const postsStore = usePostsStore()

const post = ref(null)
const title = ref('')
const content = ref('')

onMounted(() => {
  post.value = postsStore.getPostById(route.params.id)

  if (post.value) {
    title.value = post.value.title
    content.value = post.value.content
  }
})

const updatePost = () => {
  if (!post.value) return

  postsStore.updatePost(post.value.id, title.value, content.value)
  router.push(`/post/${post.value.id}`)
}
</script>

