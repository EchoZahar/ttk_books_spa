<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" v-if="sections.length > 0">
                    <div class="card-header"><h3>Sections Page. Find <strong>{{ sections.length }}</strong> sections</h3></div>
<!--                    <section-item v-for="section in sections" :key="section.id" :section="section"></section-item>-->
                    <div class="card-body" v-for="section in sections" :key="section.id">
                        <h5 class="card-title">{{ section.name }}</h5>
                        <p class="card-text">{{ section.description }}</p>
                        <div class="text-end">
                            <router-link :to="{name: 'getOneSection', params: {id: section.id}}" class="btn btn-outline-secondary">go</router-link>
                        </div>
                    </div>
                </div>
                <div class="card" v-else>
                    <div class="card-header"><h3>Sections Page. <strong> Sorry not found sections.</strong> </h3></div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import SectionItem from "@/components/Section/SectionItem.vue";

export default {
    components: {
        SectionItem
    },
    name: "SectionList",
    data() {
        return {
            sections: {},
            errors: false,
        }
    },
    props: {
        sections: {
            type: Array,
            required: true,
        }
    },
    methods: {
        async fetchSections() {
            await axios.get('api/sections')
                .then(response => {
                    this.sections = response.data.data
                    // console.log(response.data.data)
                })
                .catch(e => {
                    alert('Error !')
                    this.errors = true
                })
           }
    },
    mounted() {
        this.fetchSections()
        console.log('sections list component')
        console.log(this.sections)
    }
}
</script>

<style scoped>

</style>
