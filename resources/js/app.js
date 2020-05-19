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
Vue.component('schedule-trainer', require('./components/SheduleTrainer').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        showModal: false,
        eventId: null,
        current: null,
    },
    methods: {
        set_event(id)
        {
            this.eventId = id;
        },
        log(message)
        {
            console.log('LOG', message);
        },
        ev_change(event) {
            console.log("ev_change", event);
        },
    },
});
