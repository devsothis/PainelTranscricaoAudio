
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('Dashboard', require('./components/Dashboard.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdiSvg', // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
          },
    }),
});
