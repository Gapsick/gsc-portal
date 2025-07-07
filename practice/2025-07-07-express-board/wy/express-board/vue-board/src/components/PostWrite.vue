<template>
  <div class="write-box">
    <h2>글 작성</h2>
    <PostForm @submitPost="submitPost" />
  </div>
</template>

<script>
import PostForm from './PostForm.vue'; // PostForm 컴포넌트 불러오기

export default {
  components: {
    PostForm,
  },
  methods: {
    submitPost(postData) {
      // 서버로 글 데이터를 보내기
      fetch('http://localhost:3000/posts', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(postData),
      })
        .then(res => res.json())
        .then(() => {
          // 글 등록 후 글 목록 페이지로 이동
          this.$router.push('/');
        })
        .catch(err => {
          console.error('글 등록 실패:', err);
        });
    },
  },
};
</script>

<style scoped>
.write-box {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #f9f9f9;
}
.write-box h2 {
  margin-bottom: 16px;
}
</style>
