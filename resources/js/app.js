require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'; // importing Vue router library
import router from './routes';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

window.Vue = Vue;
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router
});
