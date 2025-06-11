<template>
  <form @submit.prevent="handleSubmit" class="post-form">
    <input v-model="title" placeholder="제목" required />
    <input v-model="writer" placeholder="작성자" required />
    <textarea v-model="content" placeholder="내용" required />
    <button type="submit">{{ isEdit ? '수정' : '등록' }}</button>
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { usePostStore } from '@/store/postStore'

const route = useRoute()
const router = useRouter()
const store = usePostStore()

const isEdit = ref(false)
const postId = ref(null)
const title = ref('')
const content = ref('')
const writer = ref('')

onMounted(() => {
  const id = route.params.id
  if (id) {
    isEdit.value = true
    postId.value = Number(id)
    const post = store.posts.find(p => p.id === postId.value)
    if (post) {
      title.value = post.title
      content.value = post.content
      writer.value = post.writer
    }
  }
})

function handleSubmit() {
  const postData = {
    id: isEdit.value ? postId.value : Date.now(),
    title: title.value,
    content: content.value,
    writer: writer.value,
    createdAt: new Date().toLocaleString()
  }

  if (isEdit.value) {
    store.updatePost(postData)
    router.push(`/board/${postId.value}`)
  } else {
    store.addPost(postData)
    router.push('/board')
  }
}
</script>

<style scoped>
.post-form {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  max-width: 600px;
}
textarea {
  min-height: 120px;
}
</style>
