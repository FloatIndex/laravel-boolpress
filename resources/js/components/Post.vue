<template>
    <div class="card my-3">
        <div class="card-body">
            <img class="card-img-top" :src="img" :alt="title">
            <h5 class="card-title">{{title}}</h5>
            <h4 class="card-text">{{category ? category.name : 'ND'}}</h4>
            <p class="card-text">{{truncateText(content)}}</p>
            <!-- in questo caso oltre al nome della rotta abbiamo bisogno del parametro variabile slug = slug props -->
            <router-link class="btn btn-primary" :to="{name: 'single-post', params: {slug: slug}}">Show post</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Post',

    props: ['img', 'title', 'content', 'slug', 'category', 'tags'],

    methods: {
        truncateText(text) {
            const maxLength = 50;
            if(text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            } else {
                return text;
            }
            
        }
    }
}
</script>

<style>

</style>