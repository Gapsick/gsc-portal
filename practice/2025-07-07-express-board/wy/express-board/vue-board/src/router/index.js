import { createRouter, createWebHistory } from 'vue-router';
import PostList from '../components/PostList.vue';
import PostDetail from '../components/PostDetail.vue';
import PostWrite from '../components/PostWrite.vue';
import PostEdit from '../components/PostEdit.vue'; 

const routes = [
  {
    path: '/',
    component: PostList,
    props: true,
  },
  {
    path: '/posts/:id',
    component: PostDetail,
    props: true,
  },
  {
    path: '/write',
    component: PostWrite,
  },
  {
    path: '/edit/:id',  // 수정 페이지 경로
    component: PostEdit, // PostEdit.vue
    props: true,  
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
