<template>
  <div>
    <h2>📃 게시글 목록</h2>

    <ul>
      <li v-for="post in store.posts" :key="post.id">
        <!-- router-link를 사용해서 글 상세로 이동 -->
        <router-link :to="`/post/${post.id}`">{{ post.title }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from 'vue'

// 게시글 목록을 저장할 반응형 배열
import { usePostStore } from '../stores/postStore'  // Pinia 스토어 import

const store = usePostStore()  // store 인스턴스 생성 (posts 접근 가능)
</script>
