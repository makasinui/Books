<template lang="">
    <router-link v-show="this.user.name" to="/addbook"><button class="btn btn-success">Добавить книгу</button></router-link>
    <Search />
    <Sort />
    <main class="flex justify-content-between flex-col" style="height:600px" >
        <div class="cards d-flex flex-wrap justify-between">
            <div class="card me-4 mt-4" style="width: 40%;"
                v-for="(book, i) in books"
                :key="book.id"
            >
            
                <div class="card-image flex justify-center">
                    <img :src="book.img" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{book.name}}</h5>
                    
                    <p class="card-text author">Автор: {{book.authors.name}}</p>
                    <p class="card-text" v-show="book.year">Год: {{book.year}}</p>
                    <p class="card-text" v-show="book.section">Раздел: {{book.section.name}}</p>

                    <div class="flex justify-between" v-show="this.user.role=='admin'">
                        <router-link :to="{name:'EditBook', params:{bookId: book.id}}" class="btn btn-primary">Изменить</router-link>
                        <a href="#" @click="deleteItem(book.id)" class="btn btn-danger">Удалить</a>
                    </div>
                   <div class="accordion mt-4" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" @click="detail[book.id]=!detail[book.id]" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Детальная информация
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body" v-show="detail[book.id]">
                                <p class="card-text">{{book.description}}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <Pagination :pages="total" @selectPage="(p)=>this.page=p"></Pagination>
    </main>

        

</template>
<script>
import axios from "axios";
import Pagination from './Pagination'
import Search from "./Search.vue";
import Sort from './Sort'
export default {
    components:{'Pagination': Pagination, 'Search': Search, 'Sort':Sort},
    data:function(){
        return{
            books:[],
            authors: [],
            user:{},
            total:'',
            detail:[],
            page:null
        }
    },
    methods:{
        deleteItem(id){
           if(confirm('Удалить книгу?')){
               axios.post('/api/books/'+id,{
                _method: 'DELETE'
                })
                .then(resp=>{
                    this.books = null;
                    this.getBooks();
                })
           }
        },
        hideItem(id){
           if(confirm('Скрыть книгу?')){
               axios.post('/api/books/'+id,{
                _method: 'PUT',
                hide:1
                })
                .then(resp=>{
                    this.books = null;
                    this.getBooks();
                })
           }
        },
        fsPage(){
            this.page = 1 
        },
        getBooks(){
            let url = `/api/books?page=${this.page?this.page:1}`
            axios.get(url)
            .then((resp)=>{
                this.books = resp.data.data;
                this.total = resp.data.meta.total
            })
            .catch((resp)=>{
                console.log(resp);
            }) 
        }
    },
    mounted(){
        this.getBooks();

        axios.get('/api/authors')
        .then((resp)=>{
            this.authors = resp.data.data;
            
        })
        .catch((resp)=>{
            console.log(resp);
        })

        axios.get('/api/current')
        .then((resp)=>{
            this.user = resp.data;
        })
        .catch((resp)=>{
            console.log(resp);
        })


    },
    watch: {
        page(){
            var url = `/api/books/?page=${this.page?this.page:'1'}`
                axios.get(url)
                .then((resp)=>{
                    this.books = resp.data.data;
                    this.total = resp.data.meta.total
                    console.log(this.total)
                    
                })
                .catch((resp)=>{
                    console.log(resp);
                }) 
        }
    }

}
</script>
<style scoped>
.card-img, .card-img-top{
    width: unset !important;
    height: 406px;
    max-width: 100%;
}

.card-image{
    height: 400px;
}
</style>