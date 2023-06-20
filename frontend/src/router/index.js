import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CriarView from '../views/CriarView.vue'
import EditarView from '../views/EditarView.vue'

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
    path: '/editar/:id',
    name: 'editar',
    component: () => import(/* webpackChunkName: editar" */ '../views/EditarView.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
