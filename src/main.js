import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './store'
import './registerServiceWorker'
import vuetify from './plugins/vuetify';
import VueMeta from 'vue-meta'
import VueFriendlyIframe from 'vue-friendly-iframe';
import VueCurrencyFilter from 'vue-currency-filter'

import vueCustomElement from 'vue-custom-element'


Vue.use(vueCustomElement)

import VueLazyload from 'vue-lazyload'
 
Vue.use(VueLazyload)

import VueClipboard from 'vue-clipboard2'
import ImgInputer from 'vue-img-inputer'
import 'vue-img-inputer/dist/index.css'
//import VueGlide from 'vue-glide-js'
import 'vue-glide-js/dist/vue-glide.css'
//import LogRocket from 'logrocket';
//LogRocket.init('rbxlbi/mulaa');


var SocialSharing = require('vue-social-sharing')
Vue.component('vue-friendly-iframe', VueFriendlyIframe)

Vue.use(VueMeta, {
  // optional pluginOptions
  refreshOnceOnNavigation: true
})

//Vue.use(VueCurrencyFilter)
Vue.use(VueClipboard);
//Vue.use(VueGlide)
Vue.component('ImgInputer', ImgInputer)
Vue.use(SocialSharing)

Vue.use(VueCurrencyFilter,
  {
    symbol : '₦',
    thousandsSeparator: ',',
    fractionCount: 2,
    fractionSeparator: '.',
    symbolPosition: 'front',
    symbolSpacing: true
  })

Vue.config.productionTip = false

const token = localStorage.getItem('token')
//console.log(token) 

//Vue.use(VueFirestore)
const base = axios.create({
  //baseURL: 'http://dev.mulaa.africa/private/wp-json/wp/v2', //http://res189.servconfig.com/~hosted5/kboom/private/
  baseURL: 'https://shop.mulaa.co/api/wp-json/wp/v2',
  headers: {
    'Authorization': 'Bearer '+`${token}`,
    'Content-Type':  'application/json', //'application/json'

  }
})

Vue.prototype.$http = base

/*
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
*/

App.store = store
App.router = router
App.vuetify = vuetify
Vue.customElement('mulaa-sdk', App)