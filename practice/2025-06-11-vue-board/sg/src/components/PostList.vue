<template>
    <div>
        <h1>게시판</h1>
        <div v-if="posts.length === 0"> 게시물이 존재하지 않습니다.</div>
        <ul>
            <li v-for="post in posts" :key="post.id">
                <router-link :to="`/post/${post.id}`">{{ post.title }}</router-link>
            </li>
        </ul>
        <router-link to="/write">
            <button>게시글 작성</button>
        </router-link>
    </div>
</template>

<script setup>
defineProps(['posts']);
</script>
