// main.js

import { createApp } from 'vue' // vue 인스턴스 생성 
import { createPinia } from 'pinia' // 상태 관리
import router from './router/index.js' // 라우터 설정

import App from './App.vue'; // 최상위 컴포넌트

const app = createApp(App)
app.use(createPinia())
app.use(router)
app.mount('#app')