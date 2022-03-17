<template lang="">
    <router-link to="/addauthor" v-show="this.user.role=='admin'"><button class="btn btn-success">Добавить автора</button></router-link
    >
    <main class="flex justify-content-between flex-col" style="height: 600px">
        <div class="cards d-flex flex-wrap">
            <div
                class="card me-4 mt-4"
                style="width: 18rem"
                v-for="(author, i) in authors"
                :key="author.id"
            >
                <div class="card-body">
                    <h5 class="card-title">{{ author.name }}</h5>
                    <p class="card-text">{{ author.country }}</p>
                    <p class="card-text">{{ author.comment }}</p>
                    <div class="flex justify-between" v-show="this.user.role=='admin'">
                        <router-link
                            :to="{
                                name: 'EditAuthor',
                                params: { authorId: author.id },
                            }"
                            class="btn btn-primary"
                            >Изменить</router-link
                        >
                        <a
                            href="#"
                            @click.prevent="deleteItem(author.id)"
                            class="btn btn-danger"
                            >Удалить</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import axios from "axios";
export default {
    data:function(){
        return{
            authors: [],
            user:{}
        }
    },
    methods:{
         deleteItem(id){
           if(confirm('Удалить автора?')){
               axios.post('http://127.0.0.1:8000/api/authors/'+id,{
                _method: 'DELETE'
                })
                .then(resp=>{
                    this.authors = null;
                    this.getAuthors();
                })
           }
        },
        getAuthors(){
            let url = `/api/authors`;
            axios.get(url)
            .then((resp)=>{
                this.authors = resp.data.data;
            })
            .catch((resp)=>{
                console.log(resp);
            })
        },
        
    },
    mounted(){
        this.getAuthors();
        axios.get('/api/current')
        .then((resp)=>{
            this.user = resp.data;
        })
        .catch((resp)=>{
            console.log(resp);
        })
    },
}
</script>
<style scoped>
    .card-title,.card-text{
        min-height:50px;
    }
</style>