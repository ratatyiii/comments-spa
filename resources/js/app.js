import '../css/app.css'
import { createApp } from 'vue';
import axios from 'axios'

import App from './components/App.vue';
import router from './router';
import store from './store';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


createApp(App)
  .use(router)
  .use(store)
  .mount('#app');