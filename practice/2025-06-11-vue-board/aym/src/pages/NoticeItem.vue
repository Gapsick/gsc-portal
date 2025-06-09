<template>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title display-6">{{ notice.title }}</h2>
                <p class="text-end text-muted mb-4">{{ notice.date }}</p>
                <p class="card-text fs-5">{{ notice.content }}</p>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button class="btn btn-warning" @click="editNotice">수정</button>
                    <button class="btn btn-danger" @click="deleteNotice">삭제</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { useRoute, useRouter } from 'vue-router'
import { useNoticeStore } from '@/stores/notices'

const route = useRoute()
const router = useRouter()
const store = useNoticeStore()

const notice = store.getNoticeById(route.params.id)

// 수정
const editNotice = () => {
    router.push(`/notices/${notice.id}/edit`)
}
// 삭제 확인 후 실행
const deleteNotice = () => {
    if (confirm('정말 삭제하시겠습니까?')) {
        store.removeNotice(notice.id)
        router.push('/notices')
    }
}
</script>
