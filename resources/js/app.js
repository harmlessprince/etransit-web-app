/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

window.Vue = require('vue').default;
import FullCalendar from 'vue-full-calendar';
// import router from './router';

Vue.use(Vuetify);
Vue.use(FullCalendar);




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Navigation', require('./components/Navigation.vue').default);
Vue.component('Footer', require('./components/Footer.vue').default);
Vue.component('App', require('./components/App.vue').default);
Vue.component('Homepage', require('./components/pages/Home.vue').default);
Vue.component('Login', require('./components/pages/Login.vue').default);
Vue.component('excel-upload', require('./components/ExcelUpload.vue').default);
Vue.component('schedule-event', require('./components/ScheduleEvent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    // router,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",

});
