import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'About',
    component: () => import('../views/About.vue')
  },
  {
    path: '/contract',
    name: 'Contract',
    component: () => import('../views/Contract.vue')
  },
  {
    path: '/Product_api',
    name: 'Product',
    component: () => import('../views/Product_api.vue')
  },
  {
    path: '/Product_list',
    name: 'ProductList',
    component: () => import('../views/Product_list.vue')
  },
  {
    path: '/Gold',
    name: 'Gold',
    component: () => import('../views/Glod.vue')
  },
  {
    path: '/customers',
    name: 'Customers',
    component: () => import('../views/Show customer.vue')
  },
  {
    path: '/employees',
    name: 'Employees',
    component: () => import('../views/Show employees.vue')
  },
  {
    path: '/add-employee',
    name: 'AddEmployee',
    component: () => import('../views/Add employees.vue')
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Register.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue')
  },
  {
    path: '/logout',
    name: 'Logout',
    component: () => import('../views/Logout.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
