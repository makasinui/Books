<template>
    <div class="card-image flex justify-center">
        <img :src="book.img" class="card-img-top" alt="..." />
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ book.name }}</h5>

        <p class="card-text author">Автор: {{ book.authors.name }}</p>
        <p class="card-text" v-show="book.year">Год: {{ book.year }}</p>
        <p class="card-text" v-show="book.section">
            Раздел: {{ book.section.name }}
        </p>

        <div class="flex justify-between" v-show="this.user.role == 'admin'">
            <router-link
                :to="{
                    name: 'EditBook',
                    params: { bookId: book.id },
                }"
                class="btn btn-primary"
                >Изменить</router-link
            >
            <button @click="show = true" class="btn btn-danger"
                >Удалить</button
            >
        </div>
        <div class="accordion mt-4" :id="`accordion${book.id}`">
            <div class="accordion-item">
                <h2 class="accordion-header" :id="`heading${book.id}`">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        :data-bs-target="`#collapse${book.id}`"
                        aria-expanded="true"
                        :aria-controls="`collapse${book.id}`"
                    >
                        Детальная информация
                    </button>
                </h2>
                <div
                    :id="`collapse${book.id}`"
                    class="accordion-collapse collapse"
                    :aria-labelledby="`heading${book.id}`"
                    :data-bs-parent="`#accordion${book.id}`"
                >
                    <div class="accordion-body">
                        <p class="card-text">
                            {{ book.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Modal :show="show" @change="closeModal">
        You want to delete {book.id} ?
    </Modal>
</template>
<script>
import { mapActions, mapState } from 'vuex'
import Modal from '../Modal.vue';
export default {
  components: { Modal },
  data() {
    return {
        show: false,
    }
  },    
    props: {
        book: {
            type: Object,
            required: true,
        },
    },
    computed: {
        ...mapState(['user'])
    },
    methods: {
        ...mapActions(['deleteBook']),
        closeModal(confirm) {
            this.show = false;
            if (confirm) {
                this.deleteBook(this.book.id);
            }
        },
    },
};
</script>
<style scoped>
.card-img,
.card-img-top {
    width: unset !important;
    height: 406px;
    max-width: 100%;
}

.card-image {
    height: 400px;
}
</style>
