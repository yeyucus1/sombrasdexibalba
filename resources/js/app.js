/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import swal from 'sweetalert';



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('artwork-component', require('./components/CreateArtworkComponent.vue').default);
Vue.component('show-artworks-component', require('./components/ShowArtworksComponent.vue').default);
Vue.component('artworks-component-read', require('./components/ArtworkComponentRead.vue').default);
Vue.component('test-component', require('./components/TestComponent.vue').default);

//Gadgets
Vue.component('somos-gadget-component', require('./components/gadgets/SomosGadget.vue').default);
Vue.component('comments-gadget-component', require('./components/gadgets/CommentsGadget.vue').default);
Vue.component('progressbar-gadget-component', require('./components/gadgets/ProgressbarGadgetComponent.vue').default);
Vue.component('loading-gadget-component', require('./components/gadgets/LoadingGadgetComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
