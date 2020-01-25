import './bootstrap';
import Vue from 'vue';
import router from './src/routes/Router';
import App from './src/Components/App';

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
