window.Vue = require('vue');
window.axios = require('axios');

import Vue from 'vue';

import App from './views/App';

const app = new Vue({ // nuova istanza di un oggetto Vue
    el: '#root', //
    render: h => h(App) // il metodo render di vue chiede di reindirizzare il componento principale (App) della vista creata
});