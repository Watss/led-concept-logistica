require("./bootstrap");

require("alpinejs");
require("./config-template/bootstrap");
require("./config-template/sidebar");
import feather from "feather-icons";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

document.addEventListener("DOMContentLoaded", () => {
    feather.replace();
});

window.feather = feather;

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require("vue").default;
Vue.use(Vuetify);
Vue.use(Toast);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "generate-report",
    require("./components/GenerateReport.vue").default
);

Vue.component(
    "companies-component",
    require("./components/companies/Companies-component.vue").default
);

Vue.component(
    "documents-component",
    require("./components/companies/Documents-component.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
});
