// 📁 src/stores/posts.js
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const usePostsStore = defineStore('posts', () => {
  // 게시글 목록
  const posts = ref([
    {
      id: 1,
      title: 'Vue 게시판 프로젝트 시작!',
      content: '이 프로젝트는 Vue 3 기반으로 진행됩니다.'
    },
    {
      id: 2,
      title: 'Vue Router가 이렇게 편할 줄이야',
      content: 'router-link와 router-view는 SPA 핵심입니다.'
    },
    {
      id: 3,
      title: 'Composition API는 언제 쓰는 거지?',
      content: 'script setup을 사용하면 훨씬 간결해집니다.'
    }
  ])

  // 고유 ID 증가용 변수
  let nextId = 4

  // 게시글 추가
  function addPost(title, content) {
    posts.value.push({
      id: nextId++,
      title,
      content
    })
  }

  // 게시글 삭제
  function deletePost(id) {
    posts.value = posts.value.filter(post => post.id !== id)
  }

  // 게시글 가져오기 (id 기반)
  function getPostById(id) {
    return posts.value.find(p => p.id === Number(id))
  }

  // 게시글 수정
  function updatePost(id, newTitle, newContent) {
    const target = posts.value.find(p => p.id === Number(id))
    if (target) {
      target.title = newTitle
      target.content = newContent
    }
  }

  return {
    posts,
    addPost,
    deletePost,
    getPostById,
    updatePost
  }
})
