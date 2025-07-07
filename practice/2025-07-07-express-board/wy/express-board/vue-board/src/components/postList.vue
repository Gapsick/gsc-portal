<template>
  <div>
    <!-- 글쓰기 버튼 추가 -->
    <router-link to="/write">
      <button>글쓰기</button>
    </router-link>

    <!-- 게시판 테이블 -->
    <table class="board-table">
      <thead>
        <tr>
          <th>제목</th>
          <th>작성자</th>
          <th>작성일</th>
        </tr>
      </thead>
      <tbody>
        <PostItem
          v-for="post in posts"
          :key="post.id"
          :post="post"
          @postDeleted="removePost"  
        />
      </tbody>
    </table>
  </div>
</template>

<script>
import PostItem from './PostItem.vue';

export default {
  components: {
    PostItem,
  },
  data() {
    return {
      posts: [],
    };
  },
  mounted() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      fetch('http://localhost:3000/posts')
        .then((res) => res.json())
        .then((data) => {
          this.posts = data;
        })
        .catch((err) => {
          console.error('글 목록 불러오기 실패:', err);
        });
    },
    removePost(id) {
      // 삭제된 글을 목록에서 제거
      this.posts = this.posts.filter((post) => post.id !== id);
    },
  },
};
</script>

<style scoped>
.board-table {
  width: 100%;
  border-collapse: collapse;
}
.board-table th,
.board-table td {
  padding: 10px;
  border: 1px solid #ccc;
  text-align: left;
}
.board-table th {
  background: #f0f0f0;
}

/* 글쓰기 버튼 스타일 */
button {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 20px;
}

button:hover {
  background-color: #45a049;
}
</style>
