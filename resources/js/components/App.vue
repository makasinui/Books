<template lang="">
    <div class="container" v-if="!loading">
        <ul class="nav justify-content-center navbar navbar-expand-lg navbar-light bg-light">
            <li class="nav-item">
                <router-link to="/" class="nav-link text-black">Список книг</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/authors" class="nav-link text-black">Список авторов</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/sections" class="nav-link text-black">Список разделов</router-link>
            </li>
        <ul class="nav justify-content-end" style="flex-grow:1">
            <li class="nav-item" v-show="!user.name">
                <a class="nav-link active text-black" href="./register" aria-current="page">Регистрация</a>
            </li>
            <li class="nav-item" v-show="!user.name">
                <a class="nav-link active text-black" href="./login" aria-current="page">Авторизация</a>
            </li>
            <li class="nav-item" v-show="user.name">
               <a class="nav-link active text-black" aria-current="page">Текущий пользователь: {{user.name}}</a> 
            </li>
            <li class="nav-item" v-show="user.name">
               <slot></slot>
            </li>
        </ul>
        </ul>
        
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import Search from "./Search.vue";
import { mapActions, mapState } from 'vuex'
export default {
    components:{'Search':Search},
    props:{
        url:''
    },
    data() {
        return {
            loading: true
        }
    },
    computed: {
        ...mapState(['user'])
    },  
    methods: {
        ...mapActions(['getUser'])
    },  
    async mounted() {
        await this.getUser();
        this.loading = false;
    }
}
</script>
