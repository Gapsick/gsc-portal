import { createApp } from 'vue';
import App from './App.vue';
import router from './router';  // Vue Router 가져오기

createApp(App)
  .use(router)  // Vue Router 사용
  .mount('#app');
