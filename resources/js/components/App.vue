<template lang="">
    <div class="container">
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
            <li class="nav-item" v-show="!str.name">
                <a class="nav-link active text-black" href="./register" aria-current="page">Регистрация</a>
            </li>
            <li class="nav-item" v-show="!str.name">
                <a class="nav-link active text-black" href="./login" aria-current="page">Авторизация</a>
            </li>
            <li class="nav-item" v-show="str.name">
               <a class="nav-link active text-black" aria-current="page">Текущий пользователь: {{str.name}}</a> 
            </li>
            <li class="nav-item" v-show="str.name">
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
import { createApp } from "vue"
import Search from "./Search.vue";
export default {
    components:{'Search':Search},
    props:{
        str:{
            type:Object,
            default(){
                return {}
            }
        },
        url:''
    },
    mounted(){
    }
}
</script>
