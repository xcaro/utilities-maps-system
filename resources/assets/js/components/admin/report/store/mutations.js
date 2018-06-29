export default {
  TOGGLE (state, propertyName) {
    state[propertyName] = !state[propertyName]
  },

  SET (state, data) {
    state[data.propertyName] = data.payload
  },

  ADD_REPORT (state, report) {
    state.trafficReports.push(report)
  },

  EDIT_REPORT (state, data) {
    state.trafficReports[data.index] = data.report
  },

  DELETE_REPORT (state, index) {
    state.trafficReports.slice()
  }
}