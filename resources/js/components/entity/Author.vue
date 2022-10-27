<template>
    <div class="card-body">
        <h5 class="card-title">{{ author.name }}</h5>
        <p class="card-text">{{ author.country }}</p>
        <p class="card-text">{{ author.comment }}</p>
        <div class="flex justify-between" v-show="this.user.role == 'admin'">
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
                @click.prevent="show = true"
                class="btn btn-danger"
                >Удалить</a
            >
        </div>
    </div>
    <Modal :show="show" @change="closeModal"/>
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
    props: {
        author: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            show: false,
        };
    },
    methods: {
        ...mapActions(["deleteAuthor", 'getAuthors']),
        closeModal(confirm) {
            this.show = false;
            if (confirm) {
                this.deleteSection(this.section.id).then(() =>
                    this.getAuthors()
                );
            }
        },
    },
    computed: {
        ...mapState(["user"]),
    },
};
</script>
