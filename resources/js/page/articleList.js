import Vue from 'vue';
import router from '../router.js';
import axios from 'axios';
import jQuery from 'jquery';
import store from '../store';

window.$ = window.jQuery = jQuery;
import 'bootstrap/dist/css/bootstrap.css';

Vue.prototype.$axios = axios;

new Vue({
  router,
  store
}).$mount('#app');
