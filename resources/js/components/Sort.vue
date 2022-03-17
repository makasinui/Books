<template lang="">
    <div>
        <select name="select" id="" @change="sortItem" v-model="sort">
            <option value="name">По имени</option>
            <option value="authors">По автору</option>
        </select>
    </div>
</template>
<script>
export default {
    data(){
        return{
            sort:''
        }
    },
    methods:{
        sortItem(){
            if(this.sort=='name'){
                const cards = [...document.querySelectorAll('.card')];
                const card = document.querySelector('.cards')
                cards.sort((a,b)=>{
                    a=a.querySelector('.card-title').textContent.toLowerCase();
                    b=b.querySelector('.card-title').textContent.toLowerCase();
                    return ((a<b)?-1 : ((a>b)?1:0))
                })
                
                cards.forEach((it)=>{
                    card.append(it)
                })
                
            } else {
                const cards = [...document.querySelectorAll('.card')];
                const card = document.querySelector('.cards')
                cards.sort((a,b)=>{
                    a=a.querySelector('.author').textContent.toLowerCase();
                    b=b.querySelector('.author').textContent.toLowerCase();
                    return ((a<b)?-1 : ((a>b)?1:0))
                })
                console.log(cards)
                cards.forEach((it)=>{
                    card.append(it)
                })
            }
        }
    }
}
</script>
