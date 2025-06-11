import { createRouter, createWebHistory } from "vue-router";
import BoardView from "@/views/BoardView.vue";
import PostDetailView from "@/views/PostDetailView.vue";
import PostForm from "@/components/Post/PostForm.vue";

export default createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", redirect: "/board" },
    { path: "/board", component: BoardView },
    { path: "/board/new", component: PostForm },
    { path: "/board/:id", component: PostDetailView },
    { path: "/board/:id/edit", component: PostForm },
  ],
});
