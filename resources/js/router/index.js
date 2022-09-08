import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/Auth/Login.vue')
const Register = () => import('@/components/Auth/Register.vue')
const Books = () => import('@/components/Pages/Books.vue')
/* Guest Component */

/* Layouts */
const AppLayout = () => import('@/components/App.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Auth/Dashboard.vue')
/* Authenticated Component */


const routes = [
    {
        path: "/",
        component: AppLayout,
        meta: {
            middleware: "guest",
        },
        children: [
            {
                name: "books",
                path: '/',
                component: Books,
                meta: {
                    title: `Books App`
                }
            }
        ]
    },
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/dashboard",
        component: AppLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/dashboard',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware === "guest") {
        if (store.state.auth.authenticated) {
            next() //{ name: "dashboard" }
        }
        next() //{ name: "books" }
    } else {
        if (store.state.auth.authenticated) {
            next()
        }
        else {
            next({ name: "login" })
        }
    }
})

export default router
