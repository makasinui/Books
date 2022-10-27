<template lang="">
    <form
        class="container border needs-validation"
        @submit.prevent="sendUpdate"
    >
        <h2>Редактирование книги '{{ book.name }}'</h2>
        <label class="form-label">Имя</label> <br />
        <input
            type="text"
            :value="name"
            @blur="checkName"
            required
            class="form-control"
            :class="{ 'is-invalid': nameError }"
        />

        <div class="invalid-feedback" v-show="nameError">
            Макс. кол-во символов: {{ v$.name.maxLength.$params.max }}
        </div>

        <label class="form-label">Автор</label> <br />
        <select name="author_id" v-model="author_id" class="form-control">
            <option
                v-for="author in authors"
                :key="author.id"
                :value="author.id"
                required
            >
                {{ author.name }}
            </option>
        </select>

        <label class="form-label">Раздел</label> <br />
        <select name="section_id" v-model="section_id" class="form-control">
            <option
                v-for="section in sections"
                :key="section.id"
                :value="section.id"
                required
            >
                {{ section.name }}
            </option>
        </select>

        <label class="form-label">Год издания</label> <br />
        <input
            type="text"
            :value="year"
            @blur="checkYear"
            class="form-control"
            :class="{ 'is-invalid': yearError }"
        />
        <div class="invalid-feedback" v-show="yearError">
            Макс. кол-во символов: {{ v$.year.maxLength.$params.max }}
        </div>
        <label class="form-label">Описание</label> <br />
        <textarea
            name="description"
            cols="30"
            rows="10"
            @blur="checkDescription"
            :value="description"
            class="form-control"
            :class="{ 'is-invalid': descriptionError }"
            required
        ></textarea>
        <div class="invalid-feedback" v-show="descriptionError">
            Макс. кол-во символов: {{ v$.description.maxLength.$params.max }}
        </div>
        <label class="form-label">Обложка</label> <br />
        <input type="file" class="form-control" @change="handleFileUpdate" />

        <input type="submit" class="btn btn-success mt-4" />
    </form>
</template>
<script>
import { maxLength, minLength, required } from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import { mapActions, mapState } from "vuex";

export default {
    setup() {
        return { v$: useVuelidate() };
    },
    props: ["bookId"],
    data() {
        return {
            book: [],
            author_id: "",
            section_id: "",
            name: "",
            year: "",
            img: "",
            description: "",
            nameError: false,
            yearError: false,
            descriptionError: false,
        };
    },
    mounted() {
        this.getAuthors();
        this.getSections();

        axios
            .get("/api/books/" + this.bookId)
            .then(({ data }) => {
                const resp = data.data;
                this.book = resp;
                this.author_id = resp.author_id;
                this.section_id = resp.section.id;
                this.name = resp.name;
                this.year = resp.year;
                this.img = resp.img;
                this.description = resp.description;
            })
            .catch((resp) => {
                console.log(resp);
            });
    },
    methods: {
        ...mapActions(["getAuthors", "getSections"]),
        handleFileUpdate(e) {
            this.img = e.target.files[0] ?? this.book.img;
        },
        sendUpdate() {
            if (!document.querySelector(".is-invalid")) {
                axios
                    .put("/api/books/" + this.bookId, {
                        name: this.name,
                        author_id: this.author_id,
                        section_id: this.section_id,
                        year: this.year,
                        description: this.description,
                        img: this.img,
                    })
                    .then(() => {
                        alert("Успешно!");
                        this.$router.push("/");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                alert("Проверьте ошибки!");
            }
        },
        checkName(e) {
            this.name = e.target.value;
            this.v$.name.$touch();
            !this.v$.name.maxLength.$response
                ? (this.nameError = true)
                : (this.nameError = false);
        },
        checkYear(e) {
            this.year = e.target.value;
            this.v$.year.$touch();
            !this.v$.year.maxLength.$response
                ? (this.yearError = true)
                : (this.yearError = false);
        },
        checkDescription(e) {
            this.description = e.target.value;
            this.v$.description.$touch();
            !this.v$.description.maxLength.$response
                ? (this.descriptionError = true)
                : (this.descriptionError = false);
        },
    },
    computed: {
        ...mapState(["authors", "sections"]),
    },
    validations() {
        return {
            name: { maxLength: maxLength(150) },
            year: { maxLength: maxLength(4) },
            description: { maxLength: maxLength(2000) },
        };
    },
};
</script>
<style lang=""></style>
