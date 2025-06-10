<template>
  <div class="write">
    <h1>글쓰기</h1>

    <form @submit.prevent="submitPost">
      <input v-model="title" placeholder="제목" required />
      <textarea v-model="content" placeholder="내용" required></textarea>
      <button type="submit">작성 완료</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { usePostsStore } from '../stores/posts'

const title = ref('')
const content = ref('')

const router = useRouter()
const postStore = usePostsStore()

const submitPost = () => {
  postStore.addPost(title.value, content.value)
  router.push('/')  // 글 작성 후 게시판으로 이동
}
</script>
