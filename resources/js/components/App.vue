<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'books'}">
                TTK books App
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Center Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'books'}">books</router-link>
                    </li>
                    <li class="nav-item" v-if="sections.length > 0" v-for="section in sections" :key="section.id">
                        <router-link class="nav-link" :to="{name: 'getOneSection', params: {id: section.id}}">{{ section.name }}</router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto" v-if="user === null">
                    <!-- Authentication Links -->

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'login'}">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'register'}">Register</router-link>
                    </li>

                </ul>
                <ul  class="navbar-nav ms-auto" v-else>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <router-link class="dropdown-item" :to="{name: 'dashboard'}">Dashboard</router-link>
                            <a class="dropdown-item" @click="logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <router-view></router-view>
    </main>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name:"App",
    data(){
        return {
            sections: {},
            user: null,
            errors: false
        }
    },
    methods:{
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post('/logout').then(({data})=>{
                this.signOut()
                this.checkUser()
                this.$router.push({name: "books"})
            })
        },
        checkUser() {
            if (this.$store.state.auth.authenticated === true) {
                this.user = this.$store.state.auth.user
            }
            else if(this.$store.state.auth.authenticated === false) {
                this.user = null
            }
        },
        async getSections() {
            await axios.get('api/sections').then(response => {
                this.sections = response.data.data
            }).catch(e => {
                this.errors = e
            })
        }
    },
    mounted() {
        this.checkUser()
        this.getSections()
        // console.log(this.$store.state.auth)
        // console.log(this.$store.state.auth.authenticated === false)
    }
}
</script>
