import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import router from '../routes'
import axios from 'axios'

Vue.use(VueRouter)
Vue.config.productionTip = false

const baseUrl = "http://localhost:8000"

window.axios = axios
window.axios.defaults.baseURL = baseUrl

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
