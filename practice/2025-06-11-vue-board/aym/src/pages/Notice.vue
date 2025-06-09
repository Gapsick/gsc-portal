<template>
    <div class="container mt-4">
        <h2>전체 게시글</h2>
        <!-- 5개 씩 표시 -->
        <div v-for="notice in visibleNotices" :key="notice.id" class="card my-3">
            <div class="card-body">
                <!-- 제목 -->
                <h5 class="card-title">
                    <router-link :to="`/notices/${notice.id}`">{{ notice.title }}</router-link>
                </h5>
                <!-- 날짜 -->
                <p class="card-text"><small class="text-muted">{{ notice.date }}</small></p>
            </div>
        </div>
        <!-- 표시 안되있는게 있으면 더보기 버튼 표시 -->
        <div class="text-center" v-if="canLoadMore">
            <button class="btn btn-outline-primary" @click="loadMore">더보기</button>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useNoticeStore } from '@/stores/notices'

const store = useNoticeStore()
const limit = ref(5)

// limit개 만큼 화면에 표시
const visibleNotices = computed(() => 
    store.notices.slice(0, limit.value)
)

// 더보기 하면 5개 추가
const loadMore = () => {
    limit.value += 5
}

// 표시 안되있는게 있는지 확인
const canLoadMore = computed(() => 
    limit.value < store.notices.length
)

</script>