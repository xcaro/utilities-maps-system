import actions from './actions'
import mutations from './mutations'
import state from './state'
import vuex from 'vuex'
import vue from 'vue'

vue.use(vuex)

export default new vuex.Store({
  state,
  actions,
  mutations
})