import { defineStore } from 'pinia'

export const usePostStore = defineStore('post', {
  state: () => ({
    posts: [],
    nextId: 1
  }),
  actions: {
    addPost(title, content) {
      this.posts.push({
        id: this.nextId++,
        title,
        content   // ✅ 내용 저장
      })
    }
  }
})
