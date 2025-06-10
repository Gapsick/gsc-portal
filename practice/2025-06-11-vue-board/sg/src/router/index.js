import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import WriteView from '@/views/WriteView.vue'
import PostDetail from '@/components/PostDetail.vue' 

const routes = [
    { path: '/', component: HomeView },
    { path: '/write', component: WriteView },
    { path: '/post/:id', component: PostDetail, props: true }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;