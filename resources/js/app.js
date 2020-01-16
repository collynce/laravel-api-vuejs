import router from './router/router'

require('./components/components');
require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#root',
    router
});
