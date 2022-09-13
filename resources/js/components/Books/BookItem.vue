<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6"><h5>{{ book.title }} </h5></div>
                            <div class="col-6 text-end">id this book: {{ book.id }}</div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img :src="book.cover" class="img-fluid rounded-start" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text text-dark">Book year: <strong>{{ book.year }}</strong></p>
                                <p class="card-text">{{ book.description }}</p>
                                <p class="card-text"><small class="text-muted">Author data</small></p>
                                <p class="card-text text-success">
                                        Author name: <strong>{{ authorBook.name }}</strong><br>
                                        author country: <strong>{{ authorBook.country_of_birth }}</strong><br>
                                        comments: <strong>{{ authorBook.comments }}</strong> <br>
                                        show all book this author <strong>LATER</strong>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BookItem",
    data() {
        return {
            book: {},
            authorBook: {},
            errors: false,
        }
    },
    methods: {
        async getBookData() {
            await axios.get('api/books/' + this.$route.params.id)
                .then(r => {
                    this.book = r.data
                    this.authorBook = r.data.authorBook
                }).catch(e => {
                    this.errors = e
                })
        }
    },
    mounted() {
        this.getBookData()
        // console.log()
        console.log('book item component')
    }
}
</script>

<style scoped>

</style>
