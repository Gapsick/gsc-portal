<template>
  <div class="edit-box">
    <h2>글 수정</h2>
    <form @submit.prevent="submitEdit">
      <div>
        <label for="title">제목</label>
        <input
          id="title"
          v-model="title"
          placeholder="제목을 수정하세요"
          required
        />
      </div>

      <div>
        <label for="content">내용</label>
        <textarea
          id="content"
          v-model="content"
          placeholder="내용을 수정하세요"
          required
        ></textarea>
      </div>

      <div>
        <label for="author">작성자</label>
        <input
          id="author"
          v-model="author"
          placeholder="작성자 이름을 수정하세요"
          required
        />
      </div>

      <button type="submit">수정 완료</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: '',
      content: '',
      author: '',
    };
  },
  mounted() {
    this.fetchPost(); // 페이지 로드 시 해당 글 데이터를 가져옵니다.
  },
  methods: {
    // 글 수정 API 요청
    submitEdit() {
      const postData = {
        title: this.title,
        content: this.content,
        author: this.author,
      };

      fetch(`http://localhost:3000/posts/${this.$route.params.id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(postData),
      })
        .then((res) => res.json())
        .then(() => {
          this.$router.push('/'); // 수정 후 목록 페이지로 리디렉션
        })
        .catch((err) => {
          console.error('글 수정 실패:', err);
        });
    },

    // 글 데이터를 서버에서 가져오기
    fetchPost() {
      const postId = this.$route.params.id;
      fetch(`http://localhost:3000/posts/${postId}`)
        .then((res) => res.json())
        .then((data) => {
          this.title = data.title;
          this.content = data.content;
          this.author = data.author;
        })
        .catch((err) => {
          console.error('글 불러오기 실패:', err);
        });
    },
  },
};
</script>

<style scoped>
.edit-box {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #f9f9f9;
}
.edit-box h2 {
  margin-bottom: 16px;
}
</style>
