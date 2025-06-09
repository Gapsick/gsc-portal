import { createRouter, createWebHistory } from 'vue-router'
import Notice from '@/pages/Notice.vue'
import NoticeItem from '@/pages/NoticeItem.vue'
import NoticeForm from '@/pages/NoticeForm.vue'

const routes = [
  { path: '/notices', component: Notice }, // 전체
  { path: '/notices/new', component: NoticeForm }, // 작성
  { path: '/notices/:id', component: NoticeItem, props: true }, // 상세보기
  { path: '/notices/:id/edit', component: NoticeForm, props: true } // 수정
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router