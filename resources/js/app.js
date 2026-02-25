require('./bootstrap');

window.Vue = require('vue').default;

Vue.component(
    'artwork-info-gadget-component',
    require('./components/gadgets/ArtworkInfoGadgetComponent.vue').default
);

const app = new Vue({
    el: '#app',
    data: {
        avgRating: 0
    }
});
