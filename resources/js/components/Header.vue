<template>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <a class="navbar-brand" href="#">Boolpress</a>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item" v-for="menuItem in menuList" :key="menuItem.index">
                    <!--
                        le rotte specificate tramite path nell'href vengono intercettate dal file wep.php, che fa richiesta al server per la pagina
                        questo vanifica il senso del costrutto single pages di vue, quindi usiamo il tag router-link offerto da vue router
                        <a class="nav-link" href="/contacts">Home</a> ->NO
                        <router-link class="nav-link" :to="{name: 'contacts'}">Contacts</router-link> ->SI
                    -->
                    <router-link class="nav-link" :to="{name: menuItem.routeName}">{{menuItem.label}}</router-link>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- per accedere all'area amministrativa dal frontend dovrò invece necessariamente passare per un href -->
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Admin area</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header',

    data() {
        return {
            menuList: [
                {
                    routeName: 'home',
                    label: 'Home'
                },
                {
                    routeName: 'about',
                    label: 'About'
                },
                {
                    routeName: 'contacts',
                    label: 'Contacts'
                },
                {
                    routeName: 'blog',
                    label: 'Blog'
                },
            ]
        }
    }
}
</script>

<style>
    .router-link-exact-active {
        font-weight: bold;
    }
</style>