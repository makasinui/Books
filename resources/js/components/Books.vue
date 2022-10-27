<template lang="">
    <router-link v-show="this.user?.name" to="/addbook">
        <button class="btn btn-success">Добавить книгу</button>
    </router-link>
    <Search v-model:value="filter"/>
    <Sort v-model:value="sortBy" />
    <main class="flex justify-content-between flex-col" style="height: 600px">
        <div class="flex justify-content-between flex-row flex-wrap">
            <div class="card me-4 mt-4"
                style="width: 40%"
                v-for="book in books"
                :key="book.id"
            >
                <Book :book="book" />
            </div>
        </div>
        <Pagination
            :pages="total"
            @selectPage="(p) => (this.page = p)"
        />
    </main>
</template>
<script>
import axios from "axios";
import Pagination from "./Pagination";
import Search from "./Search.vue";
import Sort from "./Sort";
import Book from "./entity/Book.vue";
import { mapState } from 'vuex';

export default {
    components: { Pagination, Search, Sort, Book },
    data() {
        return {
            books: [],
            filter: '',
            total: "",
            sortBy: null,
            detail: [],
            page: null,
        };
    },
    methods: {
        fsPage() {
            this.page = 1;
        },
        fetchBooks() {
            let url = `/api/books?page=${this.page ?? 1}&q=${this.filter??''}&sortBy=${this.sortBy??'name'}`;
            axios
                .get(url)
                .then((resp) => {
                    this.books = resp.data.data;
                    this.total = resp.data.meta.total;
                })
                .catch((resp) => {
                    console.log(resp);
                });
        },
    },
    async mounted() {
        this.fetchBooks();
    },
    computed: {
        ...mapState(['user'])
    },
    watch: {
        page() {
            this.fetchBooks()
        },
        filter() {
            this.fetchBooks()
        },
        sortBy() {
            this.fetchBooks()
        }
    },
};
</script>
