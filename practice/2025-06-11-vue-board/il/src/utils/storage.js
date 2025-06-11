export const STORAGE_KEY = "vue-board-posts";

export function loadPosts() {
  const data = localStorage.getItem(STORAGE_KEY);
  return data ? JSON.parse(data) : [];
}

export function savePosts(posts) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(posts));
}
