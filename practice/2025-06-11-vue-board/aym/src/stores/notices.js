import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useNoticeStore = defineStore('noticeStore', () => {
    // 게시글 관리 
    const notices = ref([])
    // id count
    let currentId = ref(1)

    // 추가
    const addNotice = (notice) => {
        notice.id = currentId.value++  // id 추가
        notices.value.push(notice)
    }
    // id 찾기
    const getNoticeById = (id) => {
        return notices.value.find(n => n.id === Number(id))
    }
    // id 기준으로 수정
    const updateNotice = (updated) => {
        const index = notices.value.findIndex(n => n.id === updated.id)
        if (index !== -1) {
            notices.value[index] = { ...updated }
        }
    }
    // id 기준으로 삭제
    const removeNotice = (id) => {
        notices.value = notices.value.filter(n => n.id !== Number(id))
    }

    return { notices, addNotice, getNoticeById, removeNotice, updateNotice }
})
