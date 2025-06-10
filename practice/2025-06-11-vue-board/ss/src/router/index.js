import { createRouter, createWebHistory } from 'vue-router'

import BoardView from '../components/BoardView.vue'
import WriteView from '../views/WriteView.vue'
import PostDetailView from '../views/PostDetailView.vue'
import PostEditView from '../views/PostEditView.vue'

const routes = [
  { path: '/', name: 'Board', component: BoardView },
  { path: '/write', name: 'Write', component: WriteView },
  { path: '/post/:id', name: 'PostDetail', component: PostDetailView },
  { path: '/edit/:id', name: 'PostEdit', component: PostEditView}
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
