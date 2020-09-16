import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        events: []
    },
    getters: {
        EVENTS: state => state.events
    },
    mutations: {

    },
    actions: {

    },

})
export default store;
