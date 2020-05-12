
// require('./bootstrap');

window.Vue = require('vue');

import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
Vue.use(VueToastr)

// import axios from 'axios'
// Vue.use(axios)

Vue.component('navbar-component', require('./components/layouts/NavbarComponent.vue').default);
Vue.component('footer-component', require('./components/layouts/FooterComponent.vue').default);
Vue.component('sidebar-component', require('./components/layouts/SidebarComponent.vue').default);

Vue.component('home-component', require('./components/home/HomeComponent.vue').default);

Vue.component('profile-component', require('./components/profile/ProfileComponent.vue').default);

Vue.component('data-entri-component', require('./components/data/IndexComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
