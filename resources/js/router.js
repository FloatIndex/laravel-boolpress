import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home';
import About from './pages/About';
import Contacts from './pages/Contacts';
import Posts from './pages/Posts';
import SinglePost from './pages/SinglePost';

const router = new VueRouter({
    // per navigare con url privi di #, che sarebbe il comportamento di default di vue router.
    // affinché funzioni è necessario inserire quel Route::get('{any?}'.... in web.php
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/posts',
            name: 'posts',
            component: Posts
        },
        {
            path: '/posts/:slug', // sintassi per valore dinamico che corrisponde a quella di laravel /posts/{slug}
            name: 'single-post', // nome della rotta a livello di vue router
            component: SinglePost
        }
    ]
})

// serve esportare la costante router affinché un altro file js possa usare il codice al suo interno
export default router