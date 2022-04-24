<template>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="#">Boolpress</a>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <!--
                    le rotte specificate tramite path nell'href vengono intercettate dal file wep.php, che fa richiesta al server per la pagina
                    questo vanifica il senso del costrutto single pages di vue, quindi usiamo il tag router-link offerto da vue router
                 -->
                <!-- <a class="nav-link" href="/">Home</a> -->
                <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="/about">About</a> -->
                <router-link class="nav-link" :to="{name: 'about'}">About</router-link>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="/contacts">Contacts</a> -->
                <router-link class="nav-link" :to="{name: 'contacts'}">Contacts</router-link>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="/posts">Posts</a> -->
                <router-link class="nav-link" :to="{name: 'posts'}">Posts</router-link>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <!-- per accedere all'area amministrativa dal frontend dovrò invece necessariamente passare per un href -->
            <li class="nav-item">
                <a class="nav-link" href="/admin">Admin area</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style>
    .router-link-exact-active {
        font-weight: bold;
    }
</style>