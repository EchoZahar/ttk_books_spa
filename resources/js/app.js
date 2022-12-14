import './bootstrap';
import '../sass/app.scss'
import Router from '@/router'
import store from '@/store'

import { createApp } from 'vue/dist/vue.esm-bundler';
import App from "@/components/App.vue";

const app = createApp({App})
app.use(Router)
app.use(store)
app.mount('#app')
