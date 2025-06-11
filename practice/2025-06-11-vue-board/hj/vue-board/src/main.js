import { createApp } from 'vue'
import App from './App.vue'
import { createPinia } from 'pinia'
import router from './router'

const app = createApp(App)
app.use(createPinia())  // ✅ pinia 연결
app.use(router)
app.mount('#app')
