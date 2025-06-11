import { defineStore } from 'pinia'
import { ref } from 'vue'

export const usePostStore = defineStore('post', () => {
  // 글 목록을 담는 배열 (초기 상태)
  const posts = ref([
    { id: 1, title: '첫 번째 글입니다' },
    { id: 2, title: '두 번째 글입니다' },
    { id: 3, title: '세 번째 글입니다' },
  ])

  // 새로운 글 추가하는 함수
  function addPost(title, content) {
  const newId = posts.value.length + 1
  posts.value.push({
    id: newId,
    title,
    content 
  })
}

function updatePost(id, newTitle, newContent) {
  console.log('수정 버튼 눌림')
  const target = posts.value.find(p => p.id === id)
  if (target) {
    target.title = newTitle
    target.content = newContent
  }
}

function deletePost(id) {
  posts.value = posts.value.filter(post => post.id !== id)
}



  return {
    posts,
    addPost,
    updatePost,
    deletePost
  }
})
