//  src/stores/postStore.js

// pinia 스토어를 정의
import { defineStore } from 'pinia';
// vue의 반응형 상퇘 관리 위한 vue의 ref 함수
import { ref } from 'vue';

// post 이름으로 스토어 정의
export const usePostStore = defineStore('post', () => {
    // 초기 데이터
    const posts = ref([
        { id: 1, title: 'Vue 시작하기', content: 'Vue는 쉽고 강력해요' },
        { id: 2, title: '컴포넌트란?', content: '컴포넌트는 재사용 가능한 블록입니다' }
    ]);

    // 새로운 게시글을 추가하는 함수
    const addPost = (title, content) => {
        if (!title.trim() || !content.trim()) return;
        posts.value.push({
            id: Date.now(), // 현재 시간을 id로 사용 (고유 값 생성)
            title,
            content
        });
        };

    // 특정 id를 가진 게시글을 삭제하는 함수
    const deletePost = (id) => {
        posts.value = posts.value.filter(p => p.id !== id);
    };

    // 특정 게시글을 찾아 제목과 내용을 업데이트하는 함수
    const updatePost = (id, newTitle, newContent) => {
        const target = posts.value.find(p => p.id === id);
        if (target) {
            target.title = newTitle;
            target.content = newContent;
        }
    };

    // 특정 id를 가진 게시글을 반환하는 함수
    const getPostById = (id) => posts.value.find(p => p.id === id) || null;

    // 스토어에서 사용할 상태와 함수들을 반환
    return { posts, addPost, deletePost, updatePost, getPostById };
});
