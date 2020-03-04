/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Internationalization via laravel-vue-i18n-generator and vue-i18n
 */
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

Vue.use(VueInternationalization);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('../../vendor/kokst/core/Resources/components/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    i18n
});
