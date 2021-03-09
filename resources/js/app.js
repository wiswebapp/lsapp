require('./bootstrap');

window.Vue = require('vue');

import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
//import {routes} from './routes.js';
import AllPost from './components/AllPost.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: [{
        name: 'home',
        path: '/',
        component: AllPost
    }],
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('notice-component', require('./components/NoticeComponent.vue').default);
Vue.component('allpost-component', require('./components/AllPost.vue').default);
Vue.component('addpost-component', require('./components/AddPost.vue').default);
Vue.component('editpost-component', require('./components/EditPost.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});