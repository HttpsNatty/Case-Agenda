import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/criar',
    name: 'criar',
    component: () => import(/* webpackChunkName: "criar" */ '../views/CriarView.vue')
  },
  {
    path: '/editar',
    name: 'editar',
    component: () => import(/* webpackChunkName: editar" */ '../views/EditarView.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
