import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
  state: () => ({
    userName: '',
    server: 'localhost/lumen-api/public/api' /* the specified api end point */
  }),

  mutations: {
    setUserName(state, newUserName) {
      state.userName = newUserName
    }
  },

  getters: {
    getUserName: (store) => store.userName
  }
})

export default store
