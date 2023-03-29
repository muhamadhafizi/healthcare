import './bootstrap';
import '../css/app.css'; 

import {createApp} from 'vue'

import App from './App.vue'

import router from "./vue/router"

// createApp(App).mount("#app")
createApp(App).use(router).mount("#app");