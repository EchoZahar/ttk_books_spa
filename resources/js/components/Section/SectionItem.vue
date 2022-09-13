<template>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ section.name }}</h5>
                    <p class="card-text">{{ section.description }}</p>
                </div>
                <div class="card-footer text-end">
                    <router-link :to="{name: 'sections'}" class="btn btn-outline-secondary">go back</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SectionItem",
    data() {
        return {
            section: {},
            errors: false,
        }
    },

    methods: {
        async getSection() {
            await axios.get('/api/sections/' + this.$route.params.id)
                .then(response => {
                    this.section = response.data
                }).catch(e => {
                    this.errors = e
                })
        }
    },

    mounted() {
        this.getSection()
        console.log('section item component')
        // console.log(this.$route.params.id)
    }
}
</script>

<style scoped>

</style>
