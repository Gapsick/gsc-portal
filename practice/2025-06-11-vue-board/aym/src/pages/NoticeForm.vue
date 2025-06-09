<template>
    <div class="container mt-4">
        <h2>{{ editing ? '공지 수정' : '공지 작성' }}</h2>

        <form @submit.prevent="submitForm">

            <input v-model="title" placeholder="제목" class="form-control mb-2" />
            <textarea v-model="content" placeholder="내용" class="form-control mb-2" />

            <button type="submit" class="btn btn-primary">{{ editing ? '수정' : '등록' }}</button>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useNoticeStore } from '@/stores/notices'

const title = ref('')
const content = ref('')

const editing = ref(false)  // 수정 모드인지

const router = useRouter()  // 페이지를 이동
const store = useNoticeStore()

const route = useRoute()  // 현재 라우트 정보
const id = route.params.id  // 주소(:id)의 id 값

// 초기 데이터 로드
onMounted(() => {
    // id 존재 → 수정 모드
    if (id) {
        // id가 존제하는건지 확인
        const existing = store.getNoticeById(id)
        // 값 초기화
        if (existing) {
            title.value = existing.title
            content.value = existing.content
            editing.value = true
        }
    }
})

const submitForm = () => {
    // 수정 등록
    if (editing.value) {
        store.updateNotice({
            id: Number(id),
            title: title.value,
            content: content.value,
            date: new Date().toISOString().slice(0, 10)
        })
    }
    // 등록
    else {
        store.addNotice({
            title: title.value,
            content: content.value,
            date: new Date().toISOString().slice(0, 10)
        })
    }
    router.push('/notices')
}
</script>

