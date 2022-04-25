<template>
    <section class="container">
        <div class="row">
            <!-- dato che post può essere null, accedo al suo contenuto e lo stampo solo se non null -->
            <div class="col" v-if="post">

                <h1>{{post.title}}</h1>

                <!-- il v-if gestisce il caso in cui la categoria sia null -->
                <h4 v-if="post.category">
                    {{post.category.name}}
                </h4>

                <p>{{post.content}}</p>

                <span>Tags:</span>
                <ul>
                    <li v-for="tag in post.tags" :key="tag.id">
                        {{tag.name}}
                    </li>
                </ul>
            </div>
        </div>
        
        
    </section>
</template>

<script>
export default {
    name: 'SinglePost',

    data() {
        return {
            post: null
        }
    },

    created() {
        this.getPost();
    },

    methods: {
        getPost() {
            // $route.params.slug => vedi sul browser nel terminale Vue App-route-$route-params-slug
            // dove 'slug' corrisponde al nome del parametro scelto da noi in router.js quando abbiamo definito il path del componente SinglePost
            const slug = this.$route.params.slug;
            axios.get('/api/posts/' + slug).then(response => {
                console.log(response.data);
                if(response.data.success == false) {
                    // $router è la costante istanza di VueRouter definita nel file router.js 
                    this.$router.push({name: 'not-found'}) // redirect ad altra rotta
                } else {
                    this.post = response.data.results;
                }
            });
        }
    }
}
</script>

<style>

</style>