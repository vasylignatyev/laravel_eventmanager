/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//import Vuetify from 'vuetify';
//Vue.use(Vuetify);

window.Vue = require('vue');

//import Vue from 'vue';
//import ElementUI from 'element-ui';
//import 'element-ui/lib/theme-chalk/index.css';

//Vue.use(ElementUI);
//Vue.component('app', require('./components/App.vue').default);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('duration', require('./components/Duration.vue').default);
Vue.component('event-selector', require('./components/event/EventSelector.vue').default);
//Vue.component('trainer', require('./components/trainer/Edit.vue').default);
Vue.component('schedule', require('./components/Schedule').default);
Vue.component('even ', require('./components/SheduleTrainer').default);
Vue.component('edit-donors', require('./components/project/EditDonors').default);
Vue.component('edit-projects', require('./components/project/EditProjects').default);
//Vue.component('customer-edit', require('./components/CustomerEdit').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
    },
    methods: {
    },
    mounted() {
        const full_desc = document.getElementById("full_desc");
        full_desc && CKEDITOR.replace("full_desc", {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    },
});
