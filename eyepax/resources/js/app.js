import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue";
import router from './router/index.js'
import MembersIndex from './components/members/Index.vue'

createApp({
    components: {
        MembersIndex
    }
}).use(router).mount('#app')
