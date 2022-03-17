<template lang="">
    <div class="input-group rounded my-4">
        <input type="search" @input="searchItem" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
    </div>
</template>
<script>
export default {
    methods:{
        searchItem(e){
            console.log(e.target)
            const title = document.querySelectorAll('.card-title')
            const card = document.querySelectorAll('.card')
            const filter = e.target.value.toUpperCase()
            for(let i = 0; i<title.length;i++){
                let a = title[i];
                console.log(a.innerHTML.toUpperCase());
                if(a.innerHTML.toUpperCase().indexOf(filter)>-1){
                    card[i].style.display=''
                } else {
                    card[i].style.display="none"
                }
            }
        }
    }
}
</script>
