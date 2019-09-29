import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VuexPersist from 'vuex-persist';
//import { exists } from 'fs';

//const BASEURL = 'http://dev.mulaa.africa/admin/wp-json'
const BASEURL = 'https://shop.mulaa.co/api/wp-json'
//const API_URL = 'http://dev.mulaa.africa/admin/wp-json/wp/v2/product'
const API_URL = 'https://shop.mulaa.co/api/wp-json/wp/v2/product'
//const API_URL_USER = 'http://dev.mulaa.africa/admin/wp-json/wp/v2/users'
const API_URL_USER = 'https://shop.mulaa.co/api/wp-json/wp/v2/users'
const Token_ENDPOINT = '/jwt-auth/v1/token'
const Products_ENDPOINT = '/mulaa-auth/v1/products'
const STAT_URL = 'https://mulaa.me/u/api/details?key=P1fjdH02F3y2&alias='

Vue.use(Vuex)

const vuexLocalStorage = new VuexPersist({
  key: 'mulaa',//vuex
  storage: window.localStorage, 
  reducer: state => ({
    token: state.token,
    user: state.user,
    productOwner: state.productOwner,
    registerMsg: state.registerMsg,
    color: state.color,
    show: state.show,
    myproducts: state.myproducts,
    product: state.product,
    theProduct: state.theProduct,
    profileID: state.profileID,
    allProducts: state.allProducts,
    userId: state.userId,
    userProducts: state.userProducts,
    userDiscounted: state.userDiscounted,
    userDetails: state.userDetails,
    Discounted: state.Discounted,
    Sales: state.Sales,
    userEmail: state.userEmail,
    userAcctStatus: state.userAcctStatus
    // getRidOfThisModule: state.getRidOfThisModule (No one likes it.)
  })
});

export default new Vuex.Store({
  state: {
    linkStat: [],
    status: '',
    token: localStorage.getItem('token') || '',
    user: '',
    productOwner: '',
    registerMsg: '', 
    color: 'success',
    show: false,
    snackbar: false,
    myproducts: [],
    product: '',
    theProduct:[],
    loading: false ,
    profileID: '',
    allProducts: [],
    userProducts: [],
    userDiscounted:[],
    userDetails:[],
    Discounted: [],
    Sales: [],
    userSales: [],
    emptyStore: false,
    userId: '',
    userEmail: '',
    userKey:'',
    userDesc:'',
    userBusiness:'',
    userPhone:'',
    userImage:'',
    userUrl: 'https://mulaa.me/u/',
    userAcctStatus:'',
    shortUrl: '',

  },
  getters: {
    showProducts: state => {
      return state.allProducts
    },
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    renderUser: state => state.user,
  },
  mutations: {
    create_product(state, {data}){

    },
    shortUrl(state,shortUrl){
      state.shortUrl = shortUrl
    },
    auth_request(state) {
      state.status = 'loading'
    },
    auth_success(state, {snackbar, message}) {
      state.status = 'success'
      //state.token = token
      state.registerMsg = message
      state.show = snackbar
      state.snackbar = true
      state.loading = false
      //console.log(state.registerMsg) 
    },
    auth_success_login(state, {token, user, userEmail, userID}) {
      state.status = 'success'
      state.userUrl = 'https://store.mulaa.co/u/'+user
            state.token = token
            state.user = user
            state.userEmail = userEmail
            state.userId = userID
            axios.defaults.headers.common['Authorization'] = token
            //console.log(state.user)
    },
    auth_error(state) {
      state.status = 'error'
      state.registerMsg = 'username or password incorrect'
      state.show = true
      state.snackbar = true
      state.color = 'red'
    },
    load_error(state, err){
        
    },
    logout(state) {
      state.loading = false;
      state.status = ''
      state.token = ''
      state.user = ''
      state.registerMsg = ''
    },
    snackbar(state, value){
      state.snackbar = value
    },
    loading(state, value){
      state.loading = value
    },
    renderUser1(state, value){
      state.user = value
    },
    showEmpty(state){
      state.emptyStore = true;
      state.userProducts = ''
      state.loading = false
    },
    set_products (state, products) {
        //state.allBooms = booms
        //console.log(booms)
        const filtered = products.filter(function(item){
         // console.log(item.authorName)
          return item.authorName == state.user; 
        });
        const Discounted = filtered.filter(function(item){
          return item.showDiscount == true; 
        });
//console.log('this user '+state.user)
        state.Discounted = Discounted
        state.allProducts = products
        state.myproducts = filtered
        //console.log(state.myproducts)
    
        state.loading = false
    },
    the_product (state, product) {
       /*const Discounted = product.filter(function(item){
         return item.showDiscount == true; 
       });*/
       //state.userDiscounted = Discounted
       state.theProduct = product.acf
       state.loading = false
       //console.log('the product: '+JSON.stringify(state.theProduct))
   },
    user_products (state, user_product) {
       
        const Discounted = user_product.filter(function(item){
          return item.show_discount === 1; 
        });
        state.userDiscounted = Discounted
        state.myproducts = user_product
        state.userProducts = user_product
        
       // console.log('mutation: '+user_product)
/*
        state.Discounted = Discounted
        state.allProducts = products
        state.myproducts = filtered
        console.log(state.myproducts)
    */
        state.loading = false
    },
    user_sales (state, allSales) {
       
      /*const filtered = products.filter(function(item){
        //console.log(item.authorName)
        return item.authorName == state.user; 
      });*/
      const userSale = allSales.filter(function(item){
        return item.merchant == state.user; 
      });
      //console.log('user sales: ' + JSON.stringify(userSale[0]))
      state.userSales = userSale
      //state.userProducts = products
/*
      state.Discounted = Discounted
      state.allProducts = products
      state.myproducts = filtered
      console.log(state.myproducts)
  */
      state.loading = false
  },
  user_detail_blank(state, value){
    state.userAcctStatus = value
  },
    user_detail(state, value){
      state.userDetails = value
    state.userAcctStatus = ' '
   state.userEmail = value.email
   state.userKey = value.payment_key
   state.userDesc = value.business_description
   state.userBusiness = value.business_name
   state.userPhone = value.phone_number
   state.userImage = value.brand_image
  
      //console.log('user detail: '+ JSON.stringify(value))
    },
    profileid(state, value){
      state.profileID = value
    },
    save_stat(state, value){
      state.linkStat = value
    }
  },
  actions: {
    linkStats ({commit, state}, data){
      //state.loading = true
        //console.log(data)
        if (data != ''){
          axios({ url: `${STAT_URL}`+data, method: 'GET' })
          .then(resp => { 
            //const linkData = resp.data.data
           // const socialData = resp.data.socialCount
           // console.log(resp.data.data)
            commit('save_stat', linkData)
          })
          .catch(err => {
            commit('load_error', err)
            //console.log(err)
            //reject(err)
          })
        }else {console.log('link not found')}
      },
    createProfile({ commit, state }, data) {
      return new Promise((resolve, reject) => {
        //commit('auth_request')
        axios({ url: `${API_URL_USER_PROFILE}`, data: data, method: 'POST' })
          .then(resp => {
            //{code: 200, message: "User 'gdi009' Registration was Successful"}
            //const token = resp.data.token
            const snackbar = true;
            const message = resp.data.message
            
            //localStorage.setItem('token', token)
            // Add the following line:
            //axios.defaults.headers.common['Authorization'] = token
            commit('auth_success', {snackbar, message})
            //console.log(message)
            //resolve(resp)
          })
          .catch(err => {
            commit('auth_error', err)
            localStorage.removeItem('token')
            reject(err)
          })
      })
    },
    register({ commit }, user) {
      return new Promise((resolve, reject) => {
        //console.log(user)
        commit('auth_request')
        axios({ url: `${API_URL_USER}/register`, data: user, method: 'POST',
        headers: {
          'content-type': 'application/json'
       } })
          .then(resp => {
            //{code: 200, message: "User 'gdi009' Registration was Successful"}
            //const token = resp.data.token
            const snackbar = true;
            const message = resp.data.message
           
            //localStorage.setItem('token', token)
            // Add the following line:
            //axios.defaults.headers.common['Authorization'] = token
            commit('auth_success', {snackbar, message})
            //console.log(message)
            
            resolve(resp)
          })
          .catch(err => {
            commit('auth_error', err)
           // console.log(`error here: ` + err)
            localStorage.removeItem('token')
            reject(err)
          })
      })
    },
    loadAllProducts ({commit, state}, data){
    state.loading = true
      //console.log(data)
      if (data != ''){
        axios({ url: `${API_URL}`, method: 'GET' })
        .then(resp => { 
          const all_products = resp.data
          commit('set_products', all_products)
          //console.log(resp.data)
          //resolve(all_booms)
        })
        .catch(err => {
          commit('load_error', err)
          //console.log(err)
          //reject(err)
        })
      }else {console.log('logout and login, user object not found')}
    },
    loadUserProducts ({commit, state}, userdata){
      state.loading = true
      return new Promise((resolve, reject) => {
    
      //console.log(data) https://shop.mulaa.co/api/wp-json/mulaa-auth/v1/products
      if (userdata != ''){ //http://dev.mulaa.africa/admin/wp-json/wp/v2/product?per_page=100
        axios({ url: `${BASEURL}${Products_ENDPOINT}`+'?author='+userdata, method: 'GET' })
        .then(resp => { 
          if(resp.data.length > 0){
            const user_products = resp.data
            const authorID = resp.data.theAuthor
            //$store.dispatch('getUser', authorID)
            commit('user_products', user_products)
            //console.log('action: '+resp.data)
          }else {
            //console.log('Store Empty')
            commit('showEmpty')
            return
          }
          
          resolve(resp)
        })
        .catch(err => {
          commit('load_error', err)
          console.log(err)
          reject(err)
        })
      }else {console.log('An error occured loading product data, try again later')}
    })
    },
    loadUserSales ({commit, state}, userdata){
      state.loading = true
        //console.log(data)
        if (userdata != ''){ //http://dev.mulaa.africa/admin/wp-json/wp/v2/product?search=userdata&per_page=100
          axios({ url: `${BASEURL}`+'/wp/v2/sale', method: 'GET' })
          .then(resp => { 
            if(resp.data.length > 0){
              const allSales = resp.data
              //const userID = resp.data.acf.merchant
              //$store.dispatch('getUser', authorID)
             commit('user_sales', allSales) //{allSales, userID}
              //console.log(allSales)
            }else {
              console.log('No Sales Record')
              commit('showEmpty')
            }
            
            //resolve(resp)
          })
          .catch(err => {
            commit('load_error', err)
            console.log(err)
            //reject(err)
          })
        }else {console.log('An error occured loading product data, try again later')}
      },
    loadProduct ({commit, state}, userdata){
    state.loading = true
      //console.log(data)
      if (userdata != ''){ //http://dev.mulaa.africa/admin/wp-json/wp/v2/product
        axios({ url: `${API_URL}`+'/'+userdata, method: 'GET' })// url: `${API_URL}`+'/'+userdata
        .then(resp => { 
          console.log(userdata)
          if(resp.data.hidden == false || resp.data.hidden == null){//resp.data.acf.hidden 
            const the_product = resp.data
            //const authorID = resp.data.author
            //$store.dispatch('getUser', authorID)
            commit('the_product', the_product) //resp.data.acf.hidden
            //console.log("hidden: "+ JSON.stringify(resp.data))
         }else {
            console.log('Product not found')
            //console.log('data'+JSON.stringify(resp.data.acf))
            state.loading = false
          }
          
          resolve(resp)
        })
        .catch(err => {
          commit('load_error', err)
          console.log(err)
          //reject(err)
        })
      }else {console.log('An error occured loading product data, try again later')}
    },
    loadUserDetails({ commit }, user){
      if (user != ''){
      return new Promise((resolve, reject) => {
        axios({ url: `${API_URL_USER}`+ '/?search='+ user, headers: {
          'Content-Type':  'application/json',
        }, 
        method: 'GET' 
      })
      .then(
        resp => {
          if(resp.data[0]){
            //console.log(JSON.stringify(resp.data[0].acf))
            commit('user_detail', resp.data[0].acf)
            //commit('auth_success_login', {token, user, userEmail})

            resolve(resp)
          }else{
            commit('user_detail_blank', 'Your store account is not activated yet')
            console.log('user acct not activated')
          }
            
        }
      )
      })
    }else{
      console.log('User not found here')
    }
    },
    logout({ commit }) {
      return new Promise((resolve, reject) => {
        commit('logout')
        localStorage.removeItem('token')
        localStorage.removeItem('mulaa')
        localStorage.removeItem('vuex')
        delete axios.defaults.headers.common['Authorization']
        resolve()
      })
    },
    getUser({ commit }, user){
      if (user != ''){
      return new Promise((resolve, reject) => {
        axios({ url: `${BASEURL}`+ '/users/?search='+ user, headers: {
          'Authorization': 'Bearer '+ localStorage.getItem('token'),
          'Content-Type':  'application/json',

        }, 
        method: 'GET' 
      })
      .then(
        resp => {
            //console.log('user response' + resp)
            //commit('auth_success_login', {token, user, userEmail})
        }
      )
      })
    }else{
      console.log('User not found here')
    }
    },
    login({ commit, dispatch }, user) {
      return new Promise((resolve, reject) => {
        commit('auth_request')
        //commit('shortUrl', shortUrl)
        axios({ url: `${BASEURL}${Token_ENDPOINT}`, data: user, method: 'POST' })
          .then(resp => { //{token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJod…n19fQ.2LubxcLKvJSYJVinXDMN0oo0r9eQ0ng6_3KF_L7QgIE", user_email: "user0004@gdi.com", user_nicename: "00004", user_display_name: "00004"}
            const token = resp.data.token
            const user = resp.data.user_nicename
            const userEmail = resp.data.user_email
            const userID = resp.data.user_display_id
            //const userEmail = resp.data.user_email
            localStorage.setItem('token', token)
            axios.defaults.headers.common['Authorization'] = token
            commit('auth_success_login', {token, user, userEmail, userID})
            resolve(resp)
            //dispatch('loadAllProducts', 'top')
            //dispatch('loadUserProducts', user)
          })
          .catch(err => {
            commit('auth_error')
            localStorage.removeItem('token')
            reject(err)
          })
      })
    }
    
  },
  plugins: [vuexLocalStorage.plugin]
})
