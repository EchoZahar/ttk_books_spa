<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>available only to the current {{ user.type }}</h3>
                    </div>
                    <div class="card-body">
                        <nav class="nav flex-column" v-if="user.type === 'admin'">
                            <a class="nav-link active" href="#">admin link</a>
                            <a class="nav-link" href="#">admin link</a>
                            <a class="nav-link" href="#">admin link</a>
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">disable</a>
                        </nav>
                        <nav class="nav flex-column" v-else-if="user.type === 'author'">
                            <a class="nav-link active" href="#">author link</a>
                            <a class="nav-link" href="#">author link</a>
                            <a class="nav-link" href="#">author link</a>
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">disable</a>
                        </nav>
                        <nav class="nav flex-column" v-else-if="user.type === 'user'">
                            <router-link :to="{name: 'createBook'}" class="nav-link active" href="#">create book</router-link>
                            <a class="nav-link" href="#">user link</a>
                            <a class="nav-link" href="#">user link</a>
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">disable</a>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard auth user</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">You are logged in as <b>{{user.email}}</b></p>
                        <p class="mb-0">Here show user properties as author or admin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"dashboard",
    data(){
        return {
            user: this.$store.state.auth.user
        }
    }
}
</script>
