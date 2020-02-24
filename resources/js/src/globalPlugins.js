import {
    CreateModalPlugin,
    swDirectoryPlugin
} from './plugins';

const GlobalPlugins = {
    install(Vue) {
        Vue.use(CreateModalPlugin);
        Vue.use(swDirectoryPlugin);
    }
};

export default GlobalPlugins;
