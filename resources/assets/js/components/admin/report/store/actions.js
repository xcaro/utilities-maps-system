export default {
  toggle ({commit}, data) {
    commit('TOGGLE', data)
  },

  set ({commit}, data) {
    commit('SET', data)
  },

  addReport ({commit}, report) {
    report.isOpenInfoWindow = false
    commit('ADD_REPORT', report)
  },

  deleteReport (store, report) {
    let index = store.state.trafficReports.filter(e => e.id === report.id)
    if (index === -1) {
      /**
       * Never happend
       */
      return
    }

    store.commit('DELETE_REPORT', index)
  },

  editReport (store, report) {
    let index = store.state.trafficReports.filter(e => e.id === report.id)
    if (index === -1) {
      /**
       * Never happend
       */
      return
    }

    /**
     * Assign everything from new marker to old marker using object assign
     */
    store.commit('EDIT_REPORT', {
      index,
      report
    })
  }
}