// main.js or main.ts
import { createApp } from 'vue';
import App from './App.vue';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

app.use(Toast, {
  // optional options
  position: "top-right",
  timeout: 3000,
  closeOnClick: true,
});

app.mount('#app');
