<template>
    <ul>
        <li v-for="post in posts" :key="post.id">
        <RouterLink :to="`/view/${post.id}`">
            [{{ post.id }}] {{ post.title }}
        </RouterLink>
        </li>
    </ul>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({
    posts: Array
})
</script>
