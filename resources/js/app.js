require('./bootstrap');

import Alpine from 'alpinejs';
import {createApp} from 'vue'
import App from './components/App.vue'
import Books from './components/Books'
import AddBook from './components/AddBook'
import EditBook from './components/EditBook'
import Authors from './components/Authors'
import AddAuthor from './components/AddAuthor'
import EditAuthor from './components/EditAuthor'
import Sections from './components/Sections'
import AddSection from './components/AddSection'
import EditSection from './components/EditSection'
import useValidate from "@vuelidate/core";
import axios from "axios";
const VueRouter = require('vue-router');
const { Vuelidate } = require('@vuelidate/core')


window.Alpine = Alpine;

const routes = [
    {
        path:'/',
        name:'Books',
        component:Books
    },
    {
        path:'/addbook',
        name:'AddBook',
        component:AddBook
    },
    {
        path:'/editbook/:bookId/',
        name:'EditBook',
        component:EditBook,
        props:true

    },
    {
        path:'/authors',
        name: 'Authors',
        component: Authors
    },
    {
        path:'/addauthor',
        name: 'AddAuthor',
        component: AddAuthor
    },
    {
        path:'/editauthor/:authorId/',
        name:'EditAuthor',
        component:EditAuthor,
        props:true
    },
    {
        path:'/sections',
        name: 'Sections',
        component: Sections
    },
    {
        path:'/editsection/:sectionId/',
        name: 'EditSection',
        component: EditSection,
        props:true
    },
    {
        path:'/addseciton',
        name: 'AddSection',
        component: AddSection
    }
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes
})

const app = createApp({})

app.use(router).use(useValidate);
app.component('component-app', App);

app.mount('#app')
Alpine.start();
