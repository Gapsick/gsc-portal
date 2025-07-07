<template>
  <div class="detail-box" v-if="post">
    <h2>{{ post.title }}</h2>
    <p>{{ post.content }}</p>
    <small>
      작성자: {{ post.author }}  
      <br />
      작성일: {{ formatDate(post.created_at) }}
    </small>
  </div>
</template>

<script>
export default {
  props: ['id'], // 라우터에서 전달된 글 번호
  data() {
    return {
      post: null,
    };
  },
  mounted() {
    this.fetchPost();
  },
  methods: {
    fetchPost() {
      fetch(`http://localhost:3000/posts/${this.id}`)
        .then(res => res.json())
        .then(data => {
          this.post = data;
        })
        .catch(err => {
          console.error('글 불러오기 실패:', err);
        });
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleString();
    },
  },
};
</script>

<style scoped>
.detail-box {
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #fefefe;
  margin: 30px auto;
  width: 80%;
}
.detail-box h2 {
  margin-bottom: 12px;
}
.detail-box p {
  margin-bottom: 10px;
  font-size: 16px;
}
.detail-box small {
  color: #666;
}
</style>
