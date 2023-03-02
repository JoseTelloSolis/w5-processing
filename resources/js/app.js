/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './web/App.vue';
import RouterWeb from './router/index'

import vClickOutside from "click-outside-vue3"

import HeaderComponent from "./components/admin/Header.vue";
import SidebarComponent from "./components/admin/Sidebar.vue";
//import FooterComponent from "./components/Footer.vue";

const app = createApp(App);

app.use(RouterWeb);
app.use(vClickOutside)

app.component('Header', HeaderComponent);
app.component('Sidebar', SidebarComponent);
//app.component('Footer', FooterComponent);

app.mount('#app');

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

//import ExampleComponent from './components/ExampleComponent.vue';
//app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */