import Vue from 'vue';
import routes from "./routes";
import VueRouter from "vue-router";

Vue.use(VueRouter);

export default new VueRouter({
    linkActiveClass: "active",
    mode: 'history',
    routes,
});
