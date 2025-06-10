<template>
    <div>
        <h2>글 작성 </h2>
        <input v-model="title" placeholder="제목" />
        <textarea v-model="content" placeholder="내용" />
        <button @click="submitPost">등록</button>
        <router-link to="/">
            <button>목록</button>
        </router-link> 
    </div>
</template>

<script setup>
// 반응형 데이터
import { ref } from 'vue' 
// 페이지 이동을 위한 훅
import { useRouter } from 'vue-router';
// pinia 게시글 상태(store)를 불러오는 커스텀 훅
import { usePostStore } from '@/stores/postStore';

// 제목과 내용을 저장할 반응형 변수 생성
const title = ref('')
const content = ref('')
// vue-router 인스턴스 가져오기 → 페이지 이동에 사용
const router = useRouter();
// postStore 인스턴스 가져오기 → 게시글 추가 등 상태 관리
const postStore = usePostStore();

// 등록 버튼 클릭 시 실행되는 함수
const submitPost = () => {
    if (!title.value || !content.value) {
        alert('모든 내용을 입력하세요');
        return;
    }
    // 실제로는 저장 후 API 또는 상태 공유 필요
    postStore.addPost(title.value, content.value);
    router.push('/');
};
</script>
