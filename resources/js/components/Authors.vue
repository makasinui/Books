<template lang="">
    <router-link to="/addauthor" v-show="this.user.role=='admin'"><button class="btn btn-success">Добавить автора</button></router-link
    >
    <main class="flex justify-content-between flex-col" style="height: 600px">
        <div class="cards d-flex flex-wrap">
            <div
                class="card me-4 mt-4"
                style="width: 18rem"
                v-for="author in authors"
                :key="author.id"
            >
                <Author :author="author"/>
            </div>
        </div>
    </main>
    <Modal :show="show" @change="closeModal"/>
</template>
<script>
import axios from "axios";
import { mapState, mapActions } from 'vuex'
import Author from "./entity/Author.vue";
export default {
    components: {Author},
    methods: {
        ...mapActions(['getAuthors']),
        
    },
    computed: {
        ...mapState(['user', 'authors'])
    },
    mounted(){
        this.getAuthors();
    },
}
</script>
<style scoped>
    .card-title,.card-text{
        min-height:50px;
    }
</style>