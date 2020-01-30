import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-vue/dist/bootstrap-vue.min.css';
import Vue from 'vue';
import router from './src/routes/Router';
import { App, swIcon } from './src/Components';
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);

Vue.component('swIcon', swIcon);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
}).$mount('#app');

// if (process.env.MIX_ENV_MODE === 'production') {
//     Vue.config.devtools = false;
//     Vue.config.debug = false;
//     Vue.config.silent = true;
// }
