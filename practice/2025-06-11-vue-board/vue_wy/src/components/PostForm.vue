<template>
    <div>
        <input v-model="localTitle" placeholder="제목을 입력하세요" />
        <textarea v-model="localContent" placeholder="내용을 입력하세요"></textarea>
        <button @click="submitForm">{{ mode === 'edit' ? '수정 완료' : '글 등록' }}</button>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

console.log('✅ PostForm.vue 로드됨')

const props = defineProps({
    mode: String,
    post: Object
})

const emit = defineEmits(['submit'])

const localTitle = ref(props.post?.title || '')
const localContent = ref(props.post?.content || '')

watch(() => props.post, (newPost) => {
    localTitle.value = newPost?.title || ''
    localContent.value = newPost?.content || ''
})

function submitForm() {
    if (localTitle.value.trim() === '' || localContent.value.trim() === '') {
        alert('제목과 내용을 모두 입력해주세요!')
        return
    }

    emit('submit', {
        title: localTitle.value,
        content: localContent.value
    })
}
</script>
