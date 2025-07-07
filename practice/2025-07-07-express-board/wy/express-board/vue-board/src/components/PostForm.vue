<template>
  <form @submit.prevent="submitPost">
    <div>
      <label for="title">제목</label>
      <input
        id="title"
        v-model="title"
        placeholder="제목을 입력하세요"
        required
      />
    </div>

    <div>
      <label for="content">내용</label>
      <textarea
        id="content"
        v-model="content"
        placeholder="내용을 입력하세요"
        required
      ></textarea>
    </div>

    <div>
      <label for="author">작성자</label>
      <input
        id="author"
        v-model="author"
        placeholder="작성자 이름을 입력하세요"
        required
      />
    </div>

    <button type="submit">글 등록</button>
  </form>
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
  methods: {
    submitPost() {
      // 폼 제출 시 부모로 데이터를 전송
      this.$emit('submitPost', { title: this.title, content: this.content, author: this.author });
    },
  },
};
</script>

