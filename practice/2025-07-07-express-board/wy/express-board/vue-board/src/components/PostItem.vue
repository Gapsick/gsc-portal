<template>
  <tr>
    <td>
      <router-link :to="`/posts/${post.id}`">
        {{ post.title }}
      </router-link>
    </td>
    <td>{{ post.author }}</td>
    <td>{{ formatDate(post.created_at) }}</td>
    <td>
      <!-- 수정 버튼 -->
      <router-link :to="`/edit/${post.id}`">수정</router-link>
    </td>
    <td>
      <!-- 삭제 버튼 -->
      <button @click="deletePost(post.id)">삭제</button>
    </td>
  </tr>
</template>

<script>
export default {
  props: ['post'],
  methods: {
    formatDate(datetime) {
      const date = new Date(datetime);
      return date.toLocaleString(); // 보기 좋게 날짜 포맷
    },
    deletePost(id) {
      if (confirm('정말로 삭제하시겠습니까?')) {
        fetch(`http://localhost:3000/posts/${id}`, {
          method: 'DELETE', // DELETE 요청으로 글 삭제
        })
          .then((res) => res.json())
          .then(() => {
            // 삭제 후 목록을 갱신
            this.$emit('postDeleted', id);  // 부모에게 삭제 완료를 알림
          })
          .catch((err) => {
            console.error('글 삭제 실패:', err);
          });
      }
    },
  },
};
</script>
