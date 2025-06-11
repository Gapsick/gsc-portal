<template>
  <div v-if="post">
    <h2>✏️ 게시글 수정</h2>
    <form @submit.prevent="submitEdit">
      <input v-model="editedTitle" type="text" />
      <br />
      <textarea v-model="editedContent" rows="5" cols="30"></textarea>
      <br />
      <button type="submit">수정 완료</button>
    </form>
  </div>
  <div v-else>
    <p>해당 글을 찾을 수 없습니다.</p>
  </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { usePostStore } from '../stores/postStore'
import { ref } from 'vue'

const route = useRoute()
const router = useRouter()
const store = usePostStore()

const id = Number(route.params.id)
const post = store.posts.find(p => p.id === id)

// 수정할 제목과 내용
const editedTitle = ref(post ? post.title : '')
const editedContent = ref(post ? post.content : '')

function submitEdit() {
  if (!editedTitle.value.trim() || !editedContent.value.trim()) {
    alert("제목과 내용을 모두 입력해주세요!")
    return
  }

  if (post) {
    post.title = editedTitle.value
    post.content = editedContent.value
    router.push('/')
  }
}
</script>
