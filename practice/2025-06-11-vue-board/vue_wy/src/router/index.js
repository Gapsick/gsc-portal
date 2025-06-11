import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../pages/HomePage.vue'
import NewPostPage from '../pages/NewPostPage.vue'
import EditPostPage from '../pages/EditPostPage.vue'
import ViewPostPage from '../pages/ViewPostPage.vue'

const routes = [
  { path: '/', component: HomePage },
  { path: '/new', component: NewPostPage },
  { path: '/edit/:id', component: EditPostPage },
  { path: '/view/:id', component: ViewPostPage },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router