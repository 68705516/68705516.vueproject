import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/About',
    name: 'About',

    component: () => import( '../views/AboutView.vue')
  },

 {
    path: '/Contract',
    name: 'Contract',

    component: () => import( '../views/Contract.vue')
  },

  {
    path: '/Product_api',
    name: 'Product_api',

    component: () => import( '../views/Product_api.vue')
  },

    {
    path: '/Product_list',
    name: 'Product_list',

    component: () => import( '../views/Product_list.vue')
  },

      {
    path: '/glod',
    name: 'glod',

    component: () => import( '../views/Glod.vue')
  },

  {
    path: '/Show customer',
    name: 'Customer',

    component: () => import( '../views/Show customer.vue')
  },

  {
    path: '/Show employees',
    name: 'Employees',

    component: () => import( '../views/Show customer.vue')
  },

  
  {
    path: '/register',
    name: 'Register',

    component: () => import( '../views/Register.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
