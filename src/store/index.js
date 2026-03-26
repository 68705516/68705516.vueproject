import { createStore } from 'vuex'

export default createStore({
  state: {
    user: null
  },
  getters: {
    isLoggedIn: state => !!state.user
  },
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    logout(state) {
      state.user = null
    }
  },
  actions: {
    login({ commit }, user) {
      commit('setUser', user)
    },
    logout({ commit }) {
      commit('logout')
    },
    initializeStore({ commit }) {
      const user = JSON.parse(localStorage.getItem('user'))
      if (user) {
        commit('setUser', user)
      }
    }
  },
  modules: {
  }
})
