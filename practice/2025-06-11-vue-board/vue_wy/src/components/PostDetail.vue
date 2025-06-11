<template>
    <div v-if="post">
        <p><strong>제목:</strong> {{ post.title }}</p>
        <p><strong>내용:</strong> {{ post.content }}</p>
    </div>
    <div v-else>
        <p>존재하지 않는 글입니다.</p>
    </div>
</template>

<script setup>
defineProps({
    post: Object
})
</script>
