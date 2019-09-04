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
import { userInfo } from 'os';

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard,
      meta: { 
        hideNavigation: false,
        //requiresAuth: true
      }
    },
    {
      path: '/products',
      name: '',
      component: Products,
      meta: { 
        hideNavigation: false,
        //requiresAuth: true
      }
    },
    {
      path: '/sales',
      name: '',
      component: Sales,
      meta: { 
        hideNavigation: false,
        //requiresAuth: true
      }
    },
    {
      path: '/user',
      name: 'user',
      component: Register,
      meta: { 
        hideNavigation: true,
        //requiresAuth: false
      }
    },
    {
      path: '/settings',
      name: 'settings',
      component: Settings,
      meta: { 
        hideNavigation: false,
        //requiresAuth: false
      }
    },
    {
      path: '/onboard',
      name: 'onboard',
      component: Onboard,
      meta: { 
        hideNavigation: true,
        //requiresAuth: true
      }
    },
    {
      path: '/u/:name',
      name: 'merchant',
      component: User,
      props: true,
      meta: { 
        hideNavigation: true,
        //requiresAuth: true
      }
    },
    {
      path: '/u/:name/:id',
      name: 'product',
      component: Product,
      props: true,
      meta: { 
        hideNavigation: true,
        //requiresAuth: true
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
    { path: '*', 
    component: Dashboard
   },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    }
  ]
})
