import { createRouter, createWebHistory } from 'vue-router'

import LoginPage from '../components/login.vue'
import HomePage from '../components/home.vue'
import UserPage from '../components/user.vue'
import AdminPage from '../components/admin.vue'
import Tracuu   from '../components/tracuu.vue'
import Service from '../components/service.vue'
import Yeucau from '../components/req.vue'

const routes = [
    {path: '/', component: HomePage},
    {path: '/login', component: LoginPage},
    {path: '/user', component: UserPage},
    {path: '/admin', component: AdminPage},
    {path: '/admin/tracuu', component: Tracuu},
    {path: '/service', component: Service},
    {path: '/admin/yeucau', component: Yeucau}

] 

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    root: '/',
    routes
})

export default router