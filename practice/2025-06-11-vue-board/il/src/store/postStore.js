import { defineStore } from 'pinia'
import { loadPosts, savePosts } from '@/utils/storage'

export const usePostStore = defineStore('post', {
  state: () => ({
    posts: loadPosts()
  }),

  actions: {
    addPost(post) {
      this.posts.push(post)
      savePosts(this.posts)
    },
    updatePost(updated) {
      const idx = this.posts.findIndex(p => p.id === updated.id)
      if (idx !== -1) {
        this.posts[idx] = updated
        savePosts(this.posts)
      }
    },
    deletePost(id) {
      this.posts = this.posts.filter(p => p.id !== id)
      savePosts(this.posts)
    }
  }
})
