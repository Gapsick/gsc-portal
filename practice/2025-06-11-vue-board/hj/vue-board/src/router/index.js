import { createRouter, createWebHistory } from 'vue-router'
import PostList from '../components/PostList.vue'
import PostForm from '../components/PostForm.vue'
import PostDetail from '../components/PostDetail.vue'
import PostEdit from '../components/PostEdit.vue'

const routes = [
  { path: '/', component: PostList },
  { path: '/write', component: PostForm },
  { path: '/post/:id', component: PostDetail },
  { path: '/edit/:id', component: PostEdit }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
