import Vue from 'vue';
import router from '../router.js';
import axios from 'axios';
import jQuery from "jquery";

window.$ = window.jQuery = jQuery;
import 'bootstrap/dist/css/bootstrap.css';

Vue.prototype.$http = axios;

const app = new Vue({
  router
}).$mount('#app');
