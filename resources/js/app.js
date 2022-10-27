require('./bootstrap');

import App from './components/App.vue';
import { router } from './router/index'
import { store } from './store';

import { createApp } from 'vue'
import useValidate from "@vuelidate/core";

const app = createApp({})

app.use(router).use(store).use(useValidate);
app.component('component-app', App);

app.mount('#app')
