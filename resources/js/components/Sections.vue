<template>
    <router-link to="/addsection" v-show="this.user.role=='admin'">
        <button class="btn btn-success">Добавить раздел</button>
    </router-link>
    <main class="flex justify-content-between flex-col" style="height: 600px">
        <div class="cards d-flex justify-content-between flex-wrap">
            <div
                class="card me-4 mt-4"
                style="width: 18rem"
                v-for="section in sections"
                :key="section.id"
            >
                <Section :section="section" />
            </div>
        </div>
    </main>
</template>
<script>
import { mapState, mapActions } from 'vuex'
import Section from './entity/Section.vue';
export default {
    data() {
        return {
            show: false,
        }
    },
    components: { Section },
    methods:{
        ...mapActions(['getSections', 'deleteSection']),
        closeModal(confirm) {
            this.show = false;
            if (confirm) {
                this.deleteSection(this.book.id).then(()=>this.getSections());
            }
        }
    },
    computed: {
        ...mapState(['user', 'sections'])
    },
    mounted(){
        this.getSections();
    },
}
</script>
<style scoped>
    
</style>