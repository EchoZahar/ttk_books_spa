<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'books'}">
                books
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->

                    <li class="nav-item">
                        <a class="nav-link" :to="{name: 'login'}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :to="{name: 'register'}">Register</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
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
    name: "App",
    data(){
        return {
            user: '' //this.$store.state.auth.user
        }
    },
    methods:{
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout(){
            await axios.post('/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"login"})
            })
        },
        checkUser() {
            if (this.$store.state.auth) {
                this.user = this.$store.state.auth.user
            }
            else {
                this.user = null
            }
        }
    },
    mounted() {
        this.checkUser()
        console.log(this.$store.state.auth)
    }
}
</script>

<style scoped>

</style>
