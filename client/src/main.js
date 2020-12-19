import { createApp } from 'vue'
import { IonicVue } from '@ionic/vue'
import App from './App.vue'
import router from './router'
import store from './store'

/* Core CSS required for Ionic components to work properly */
import '@ionic/vue/css/core.css'

/* Theme variables */
import './theme/variables.css'
import './theme/tailwind.css'

const app = createApp(App)
  .use(IonicVue)
  .use(router)
  .use(store)

/* Global components import */
import BaseLayout from '@/components/layout/BaseLayout.vue'

/* Global components registration */
app.component('base-layout', BaseLayout)

/* Laravel echo and pusher setup */
window.Pusher = require('pusher-js')

import Echo from 'laravel-echo'
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '' /* same as PUSHER_APP_KEY found in .env in server folder (lumen) */,
  cluster: 'mt1',
  encrypted: false,
  wsHost: 'localhost',
  wsPort: 6001,
  wssPort: 6001
})

/* Mounting the app */
router.isReady().then(() => {
  app.mount('#app')
})
