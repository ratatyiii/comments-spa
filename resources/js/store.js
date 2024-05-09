import { createStore  } from 'vuex'

const store = createStore({
  state () {
    return {
      comments: [],
    }
  },
  mutations: {
    setComments (state, comments) {
      state.comments = comments
    }
  },
  actions: {
    fetchComments ({ commit }) {

      axios.get('/api/comments').then(response => {
        const comments = response.data;

        commit('setComments', comments)
      }).catch(reason => {
        console.log(reason)
      })
    }
  },
  getters: {
    getComments (state) {
      return state.comments
    }
  }
})

export default store