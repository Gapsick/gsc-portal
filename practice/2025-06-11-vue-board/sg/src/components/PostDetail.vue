<template>
    <div v-if="post">
        <h2>{{ post.title }}</h2>
        <p v-if="!isEditing">{{ post.content }}</p>
        <div v-else>
            <input v-model="editTitle" />
            <textarea v-model="editContent" /> 
                <button @click="saveEdit">저장</button>
                <button @click="cancelEdit">취소</button>
        </div>
        
        <div v-if="!isEditing">
            <button @click="isEditing = true">수정</button>
            <button @click="removePost">삭제</button>
        </div>

        <router-link to="/">
            <button>목록</button>
        </router-link>
    </div>
    <div v-else>
        <p>게시글을 찾을 수 없습니다.</p>
        <router-link to="/">
            <button>목록</button>
        </router-link>
    </div>
</template>

<script setup>
import { ref } from 'vue' 
import { useRoute, useRouter} from 'vue-router'
import { usePostStore } from '@/stores/postStore.js'

const route = useRoute();
const router = useRouter();
const postStore = usePostStore();

const post = postStore.getPostById(Number(route.params.id));

const isEditing = ref(false);
const editTitle = ref(post?.title || '');
const editContent = ref(post?.content || '');

const removePost = () => {
    const ok = confirm('정말 삭제하시겠습니까?');
    if (ok && post) {
        postStore.deletePost(post.id);
        router.push('/');
    }
};

const saveEdit = () => {
    if (post) {
        postStore.updatePost(post.id, editTitle.value, editContent.value);
        isEditing.value = false;
    }
};

const cancelEdit = () => {
    isEditing.value = false;
    editTitle.value = post.title;
    editContent.value = post.content;
};

</script>
