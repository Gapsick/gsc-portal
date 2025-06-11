<template>
  <div>
    <h2>📝 새 글 작성</h2>
    <form @submit.prevent="submitForm">
      <input v-model="title" type="text" placeholder="제목을 입력하세요" />
      <br />
      <textarea v-model="content" placeholder="내용을 입력하세요" rows="5" cols="30"></textarea>
      <br />
      <button type="submit">작성 완료</button> 
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { usePostStore } from '../stores/postStore' // 스토어 가져오기

// 사용자가 입력한 제목을 담을 반응형 변수
const title = ref("")
// 사용자가 입력한 내용을 담을 반응형 변수
const content = ref("")

// 페이지 이동을 위한 라우터 인스턴스 가져오기
const router = useRouter()

const store = usePostStore() // 스토어 인스턴스 생성

// 작성 완료 버튼 클릭 시 실행될 함수
function submitForm() {
  if (title.value.trim() === "" || content.value.trim() === "") {
    alert("제목과 내용을 모두 입력해주세요!")
    return
  }

  store.addPost(title.value, content.value) // 제목, 내용 전달
  // 작성 후 목록으로 이동
  router.push("/")
}
</script>
