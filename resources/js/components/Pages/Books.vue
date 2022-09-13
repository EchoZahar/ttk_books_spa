<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" v-if="! isLoading">
                <h3>All books</h3>
                <div class="row">
                    <div v-for="book in books" :key="book.id" class="col-md-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img :src="book.cover" class="img-fluid rounded-start" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <router-link :to="{ name: 'getBookItem', params: {id: book.id}}">{{ book.title }}</router-link></h5>
                                        <p class="card-text">{{ book.description.substr(0, 100) }}</p>
                                        <p class="card-text">
                                            <small class="text-muted">{{ book.author.name }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center" v-else>loading</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Books",
    data () {
        return {
            books: [],
            pagination: {},
            errors: false,
            isLoading: false,
        }
    },
    methods: {
        async fetchBooks(page_url) {
            page_url = page_url || 'api/books'
            try {
                this.isLoading = true;
                const response = await axios.get(page_url);
                this.makePagination(response.data.links);
                console.log(response)
                this.books = response.data.data;

            } catch (e) {
                alert('Error');
                this.errors = true;
            } finally {
                this.isLoading = false
            }
        },
        makePagination(response) {

            let pagination = {
                // current_page: response.current_page,
                // last_page: response.last_page,
                first: response.first,
                prev: response.prev,
                next: response.next,
                last: response.last,
            };

            this.pagination = pagination;
        }
    },
    mounted() {
        this.fetchBooks()
        console.log('Books component mounted')
    }
}
</script>

<style scoped>

</style>
