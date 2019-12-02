import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Dashboard from './views/Dashboard.vue'
import Register from './views/Register.vue'
import Onboard from './views/OnBoard.vue'
import Products from './views/Products.vue'
import Product from './components/Product.vue'
import Sales from './views/Sales.vue'
import User from './views/User.vue'
import Settings from './views/Settings.vue'
import ConfirmSub from './views/ConfirmSub.vue'
import store from './store'
import { userInfo } from 'os';

Vue.use(Router)

/*
export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  */

  let router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
  routes: [
    /*
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard,
      meta: { 
        hideNavigation: false,
        requiresAuth: true
      }
    },
    {
      path: '/products',
      name: '',
      component: Products,
      meta: { 
        hideNavigation: false,
        requiresAuth: true
      }
    },
    {
      path: '/sales',
      name: '',
      component: Sales,
      meta: { 
        hideNavigation: false,
        requiresAuth: true
      }
    },
    {
      path: '/user',
      name: 'user',
      component: Register,
      meta: { 
        hideNavigation: true,
        requiresAuth: false
      }
    },
    {
      path: '/settings',
      name: 'settings',
      component: Settings,
      meta: { 
        hideNavigation: false,
        requiresAuth: true
      }
    },
    {
      path: '/settings/confirm',
      name: 'confirmation',
      component: ConfirmSub,
      meta: { 
        hideNavigation: false,
        requiresAuth: true
      }
    },
    {
      path: '/onboard',
      name: 'onboard',
      component: Onboard,
      meta: { 
        hideNavigation: false,
        requiresAuth: true
      }
    },
    {
      path: '/:name',
      name: 'merchant',
      component: User,
      props: true,
      meta: { 
        hideNavigation: true,
        requiresAuth: false
      }
    },*/
    {
      path: '/:id',
      name: 'product',
      component: Product,
      props: true,
      meta: { 
        hideNavigation: true,
        requiresAuth: false
      }
    },
    {
      path: '*', // /user
      name: 'user',
      component: Register,
      props: true,
      meta: { 
        hideNavigation: true,
        requiresAuth: false
      }
    },
    /*{
      path: '/products/:id',
      name: 'product',
      component: Product,
      meta: { 
        hideNavigation: false,
        //requiresAuth: true
      }
    },*/
    /*
    { path: '*', 
    component: Dashboard
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('./views/About.vue')
    },*/
    {
      path: '/',
      name: 'merchant',
      component: User,
      props: true,
      meta: { 
        hideNavigation: true,
        requiresAuth: false
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  /*
  const subdom = window.location.host.split('.')[0]
  const domain = 'mulaa.store'
  const pageToLoad = 'merchant'
*/
const host = window.location.host;
const parts = host.split('.');
const domain = 'mulaa'
const domainLength = 3; // route1.example.com => domain length = 3
const pageToLoad = 'merchant'

/*if(parts[0] !== domain && to.name !== pageToLoad){

}*/

if(to.name !== pageToLoad){ //|| parts[0] == domain
  //return next({name: pageToLoad, params:{name:parts[0]}})
  
    //return window.location.replace("https://mulaa.co");
  
  return next()
}else{
  //console.log(parts[0])
  return next()
}

/*
  if (to.meta.requiresAuth) {
    if (store.getters.isLoggedIn != true) {
      console.log('/userr')
    
      //return next('/user')
      return
    }
   // console.log(subdom)
    return next()
  } else if(parts[0] !== domain && to.name !== pageToLoad){
    //console.log('page to load else '+pageToLoad)
    //return next({name: pageToLoad, params:{user:parts[0]}})
    
      console.log('else: '+parts[0])
return next({params:{name:parts[0]}})

  }else{
    return next({params:{name:parts[0]}})
  }
  */
})

router.afterEach((to, from) => {
  // ...
  //console.log('to: '+to.fullPath+store.state.userDetails.username)
})

export default router