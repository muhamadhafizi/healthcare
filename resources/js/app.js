import './bootstrap';
import '../css/app.css'; 

import {createApp} from 'vue'

import axios from 'axios'
import Auth from './vue/auth/auth.js'

// Vue.prototype.auth = Auth;

import App from './App.vue'

import router from "./vue/router"

// createApp(App).mount("#app")
createApp(App).use(router).mount("#app");