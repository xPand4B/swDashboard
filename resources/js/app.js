import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-vue/dist/bootstrap-vue.min.css';
import Vue from 'vue';
import VueRouter from "vue-router";
import routes from "./src/routes/routes";

// configure router
const router = new VueRouter({
    mode: 'hash',
    routes,
});

// Plugins
import GlobalPlugins from "./src/globalPlugins";
import GlobalComponents from "./src/globalComponents";
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

Vue.use(VueRouter);
Vue.use(GlobalPlugins);
Vue.use(GlobalComponents);
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);

// Vue app
import App from './src/App';

new Vue({
    el: '#app',
    components: { App },
    router,
}).$mount('#app');
