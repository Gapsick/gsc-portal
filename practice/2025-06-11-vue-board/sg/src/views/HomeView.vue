<template>
    <PostList :posts="posts" />
</template>

<script setup>
import PostList from '@/components/PostList.vue';
import { usePostStore } from '@/stores/postStore';


const postStore = usePostStore();
const posts = postStore.posts;
</script>
