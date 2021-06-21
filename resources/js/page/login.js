import Vue from 'vue';
import router from '../router.js';
import axios from 'axios';
import jQuery from 'jquery';
import store from '../store';
import '../plugins/validation';

window.$ = window.jQuery = jQuery;
import 'bootstrap/dist/css/bootstrap.css';

import { ValidationProvider, ValidationObserver} from "vee-validate";
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

Vue.prototype.$axios = axios;

new Vue({
    router,
    store
}).$mount('#app');
