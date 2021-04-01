import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from '../../routes';
import components from '../../components';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);
Vue.use(VueRouter);
//Vue.use(axios);

new Vue({
    el: "#app",
    components: components,
    router: new VueRouter(routes),
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
        },
    })
});
