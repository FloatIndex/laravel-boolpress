<template>

    <main>
        <div class="container">

            <h1>Elenco dei post</h1>

            <div class="row">
                <div class="col-6" v-for="post in posts" :key="post.id">
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">{{post.title}}</h5>
                            <p class="card-text">{{post.content}}</p>
                            <a href="#" class="btn btn-primary">show post</a>
                        </div>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" :class="(currentPage == 1) ? 'disabled' : ''"><span class="page-link" @click="getPosts(currentPage - 1)">Previous</span></li>
                    <li class="page-item" :class="(currentPage == lastPage) ? 'disabled' : ''"><span class="page-link" @click="getPosts(currentPage + 1)">Next</span></li>
                </ul>
            </nav>

        </div>
    </main>

</template>

<script>
export default {
    name: 'Main',

    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: null,
        }
    },

    created() {
        this.getPosts();
    },

    methods: {
        getPosts(apiPage) {
            axios.get('/api/posts', {
                'params': {
                    'page': apiPage
                }
            }).then((response) => {
                // corretto prima di usare la paginate in PostController
                // this.posts = response.data.results;
                
                this.posts = response.data.results.data;

                this.currentPage = response.data.results.current_page; 
                this.lastPage = response.data.results.last_page; 

            });
        }
    }
}
</script>

<style>

</style>