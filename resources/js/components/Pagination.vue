<template>
        <nav class="justify-center flex">
            <ul class="pagination">
                
                    <li class="page-item"
                    
                    v-for="(item,i) in Math.ceil(pages/5)"
                    @click="active(item)"
                    :class="{'active':arr[item]}"
                    >
                        <a class="page-link" @click="$emit('selectPage',i+1)" href="#">{{+item}}</a>
                    </li>



               
            </ul>
        </nav>
</template>
<script>
export default {
    props:{
        pages:''
    },
    data(){
        return{
            arr:[],
            isClick:false
        }
        
    },
    mounted(){
        
    },
    methods: {
        active(item){
            const act = document.querySelectorAll('.active')
            act.forEach((item)=>{
                if(item.classList.contains('active')){
                    item.classList.remove('active')
                }
            })

            for(let i = 0;i<=Math.ceil(this.pages/5);i++){
                this.arr[i] = false;
            }

            this.arr[item] = !this.arr[item]
            

        }
    },
}
</script>
<style scoped>

</style>