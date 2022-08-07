import './bootstrap.js';
import { routes } from './routes';
import { createRouter, createWebHistory } from 'vue-router';
import { createApp } from 'vue';
import App from './Pages/App.vue';
import Toaster from '@meforma/vue-toaster';
import toast from './toast'

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App)
    .use(router)
    .use(Toaster)
	.use(toast)
    .mount("#app");
