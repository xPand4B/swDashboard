import Vue from 'vue';
import VueRouter from "vue-router";
import { swLayoutDefault } from '../layouts';
import { ShoplistIndex} from '../pages';

const routes = [
    {
        path: '/',
        component: swLayoutDefault,
        children: [
            {
                path: '/',
                name: 'shoplist.index',
                component: ShoplistIndex
            }
        ]
    }
];

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes,
});
