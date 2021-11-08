import Vue from 'vue';
import Router from 'vue-router';
import Homepage from './components/pages/Home.vue';
import Login from './components/pages/Login.vue'
Vue.use(Router);

const routes = [
    { path : '/' , component : Homepage},
    { path : '/login-user' , component : Login},
    { path: "/:pathMatch(.*)*", component: Homepage }
]


export default new Router({
    mode: 'history',
    routes
});
