import Vue from 'vue';
import timeSlot from './components/timeSlot.vue';

Vue.component('slot', timeSlot);

const app = new Vue({
    el: '#app',
});
