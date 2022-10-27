<template>
    <div class="card-body">
        <h5 class="card-title">{{ section.name }}</h5>
        <p class="card-text">{{ section.description }}</p>
        <div class="flex justify-between" v-show="this.user.role == 'admin'">
            <router-link
                :to="{
                    name: 'EditSection',
                    params: { sectionId: section.id },
                }"
                class="btn btn-primary"
                >Изменить</router-link
            >
            <a href="#" @click.prevent="show = true" class="btn btn-danger"
                >Удалить</a
            >
        </div>
    </div>
    <Modal :show="show" @change="closeModal"/>
</template>
<script>
import { mapState, mapActions } from "vuex";
import Modal from '../Modal.vue';
export default {
    components: { Modal },
    props: {
        section: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            show: false
        }
    },
    methods: {
        ...mapActions(['getSections','deleteSection']),
        closeModal(confirm) {
            this.show = false;
            if (confirm) {
                this.deleteSection(this.section.id).then(() =>this.getSections());
            }
        }
    },
    computed: {
        ...mapState(['user'])
    }
};
</script>
