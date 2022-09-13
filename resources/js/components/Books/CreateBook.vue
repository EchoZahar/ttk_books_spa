<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>add new book</h5>
                    </div>
                    <div class="card-body">

                        <div v-if="errors">
                            <div v-for="error in errors" class="alert alert-danger">{{ error }}</div>
                        </div>

                        <form method="post" enctype="multipart/form-data" @submit.prevent="createBook">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">

                                    <label for="coverFile">Choose an you cover</label>
                                    <input type="file" ref="file" @change="uploadCover" class="form-control" id="coverFile">

                                    <div v-if="coverPreview" class="mt-3">
                                        <img :src="coverPreview" class="figure-img img-fluid rounded"
                                             style="max-height:100px;">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>inter title</label>
                                            <input type="text" name="title" v-model="formData.title"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-6 col-sm-12">
                                                <label> year </label>
                                                <input type="text" name="year" v-model="formData.year"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <label>inter description</label>
                                    <textarea type="text" name="description" v-model="formData.description"
                                              class="form-control"></textarea>
                                    <label for="authorName">author name</label>
                                    <input type="text" v-model="formData.author" class="form-control" id="authorName">

                                    <label for="country_of_birth">author country</label>
                                    <input id="country_of_birth" type="text" v-model="formData.country_of_birth" class="form-control">

                                    <label for="comments">comments about author</label>
                                    <input id="comments" type="text" v-model="formData.comments" class="form-control">

                                    <div class="text-end mt-5">
                                        <button class="btn btn-outline-secondary">Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateBook",
    data() {
        return {
            formData: {
                title: '',
                year: '',
                description: '',
                author: this.$store.state.auth.user.name,
                country_of_birth: '',
                comments: '',
            },

            cover: null,
            coverPreview: null,

            errors: false,
        }
    },
    mounted() {
        console.log('create book component')
        console.log()
    },
    methods: {
        uploadCover(e) {
            this.cover = e.target.files[0]
            console.log(e.target.files[0]);
            let reader = new FileReader();
            reader.readAsDataURL(this.cover);
            reader.onload = e => {
                this.coverPreview = e.target.result;
            };
            //await axios.post('api/books/uploadCover', formData)
        },
        createBook() {
            // const config = {
            //     headers: {'content-type': 'multipart/form-data'}
            // }

            // this.cover = e.target.files[0]

            // let formData = new FormData();
            // formData.append('cover', this.file);

            console.log(this.cover)

            this.errors = null

            let formData = new FormData()

            formData.append('cover', this.cover)

            _.each(this.formData, (value, key) => {
                formData.append(key, value)
            })

            axios.post('/api/books', formData, {
                    headers: {
                        'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                    }
                }
            ).then(response => {
                // this.books.push(book)
                console.log(response.data)
                // this.book = response.data.data
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = []
                    _.each(err.response.data.errors, error => {
                        _.each(error, e => {
                            this.errors.push(e)
                        })
                    })

                }
            });
        }
    }
}
</script>

<style scoped>

</style>
