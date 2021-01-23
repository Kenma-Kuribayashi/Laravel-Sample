import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

const initialState = {
  SearchWord: '',
}

const store = new Vuex.Store({
  state: initialState,
  mutations: {
    setSearchWord (state, word) {
    state.SearchWord = word
    }
  },
  plugins: [createPersistedState()]
});

// Vue.prototype.$store = store

export default store