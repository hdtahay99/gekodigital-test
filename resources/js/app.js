require('./bootstrap');

window.Vue = require('vue');


Vue.component('jugadores-historial', require('./components/jugadores-historial.vue').default);
Vue.component('jugar-sudoku', require('./components/jugar-sudoku.vue').default);



const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
    },
});