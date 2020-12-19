import { createRouter, createWebHistory } from '@ionic/vue-router'

const routes = [
  {
    path: '/',
    name: 'register',
    component: () => import('@/pages/Register.vue')
  },
  {
    path: '/chat',
    name: 'chat',
    component: () => import('@/pages/Chat.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
