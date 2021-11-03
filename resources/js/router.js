import Vue from 'vue';
import Router from 'vue-router';
import Homepage from './components/pages/Home.vue'
Vue.use(Router);

const routes = [
    { path : '/' , component : Homepage}
]


export default new Router({
    mode: 'history',
    routes
});
