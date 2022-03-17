<template>
    <router-link to="/addauthor" v-show="this.user.role=='admin'">
        <button class="btn btn-success">Добавить раздел</button>
    </router-link>
    <main class="flex justify-content-between flex-col" style="height: 600px">
        <div class="cards d-flex flex-wrap">
            <div
                class="card me-4 mt-4"
                style="width: 18rem"
                v-for="(section, i) in sections"
                :key="section.id"
            >
                <div class="card-body">
                    <h5 class="card-title">{{ section.name }}</h5>
                    <p class="card-text">{{section.description}}</p>
                    <div class="flex justify-between" v-show="this.user.role=='admin'">
                        <router-link
                            :to="{
                                name: 'EditSection',
                                params: { sectionId: section.id },
                            }"
                            class="btn btn-primary"
                            >Изменить</router-link
                        >
                        <a
                            href="#"
                            @click.prevent="deleteItem(section.id)"
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
            sections: [],
            user:{}
        }
    },
    methods:{
         deleteItem(id){
           if(confirm('Удалить автора?')){
               axios.post('http://127.0.0.1:8000/api/sections/'+id,{
                _method: 'DELETE'
                })
                .then(resp=>{
                    this.sections = null;

                    this.getSections();
                })
           }
        },
        getSections(){
            let url = `/api/sections`;
            axios.get(url)
            .then((resp)=>{
                this.sections = resp.data.data;
            })
            .catch((resp)=>{
                console.log(resp);
            })
        },
        
    },
    mounted(){
        this.getSections();
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
    
</style>