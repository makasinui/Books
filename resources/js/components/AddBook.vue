<template lang="">
    <form @submit.prevent="addBook">
        <div class="mb-3">
            <label class="form-label">Название книги</label>
            <input
                type="text"
                v-model="v$.name.$model"
                @blur="v$.name.$touch"
                name="name"
                required
                class="form-control"
                :class="{ 'is-invalid': v$.name.$errors.length }"
            />

            <div class="invalid-feedback" v-show="!v$.name.maxLength.$response">
                Макс. кол-во символов: {{ v$.name.maxLength.$params.max }}
            </div>

            <div class="invalid-feedback" v-show="!v$.name.required.$response">
                Обязательно для заполнения
            </div>

        </div>
        <div class="mb-3">
            <label class="form-label">Автор</label>
            <select
                name="author_id"
                v-model="author_id"
                required
                class="form-control"
            >
                <option
                    v-for="author in authors"
                    :key="author.id"
                    :value="author.id"
                >
                    {{ author.name }}
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Раздел</label>
            <select
                name="section_id"
                v-model="section_id"
                required
                class="form-control"
            >
                <option
                    v-for="section in sections"
                    :key="section.id"
                    :value="section.id"
                >
                    {{ section.name }}
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Год издания</label>
            <input
                type="number"
                name="year"
                v-model="v$.year.$model"
                @blur="v$.year.$touch"
                class="form-control"
                :class="{ 'is-invalid': v$.year.$errors.length }"
            />
            <div class="invalid-feedback" v-show="!v$.year.maxLength.$response">
                Макс. кол-во символов: {{ v$.year.maxLength.$params.max }}
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea
                name="description"
                cols="30"
                rows="10"
                v-model="v$.description.$model"
                @blur="v$.description.$touch"
                class="form-control"
                :class="{ 'is-invalid': v$.description.$errors.length }"
                required
            ></textarea>
            <div class="invalid-feedback" v-show="!v$.description.maxLength.$response">
                Макс. кол-во символов: {{ v$.description.maxLength.$params.max }}
            </div>

            <div class="invalid-feedback" v-show="!v$.description.required.$response">
                Обязательно для заполнения
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Обложка</label> <br />
            <input type="file" name="img" @change="imgLoad" id="img" required />
        </div>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
</template>
<script>
import { required, maxLength } from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";

export default {
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            book: {},
            authors: [],
            sections:[],
            name: "",
            author_id: "",
            section_id:'',
            year: "",
            description: "",
            img: "",
        };
    },
    methods: {
        imgLoad(e) {
            this.img = e.target.files[0];
        },
        addBook() {
            let formData = new FormData();
            formData.append('img',this.img);
            formData.append('name',this.name);
            formData.append('author_id',this.author_id);
            formData.append('section_id', this.section_id);
            formData.append('year', this.year);
            formData.append('description', this.description);
            
            if (!document.querySelector(".is-invalid")) {
                axios.post("/api/books",formData, {
                        headers:{
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((resp) => {
                        alert('Успешно!')
                        this.$router.push('/')
                        
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        changes() {
            console.log(this.name);
        },
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/authors")
            .then((resp) => {
                this.authors = resp.data.data;
            })
            .catch((resp) => {
                console.log(resp);
            });

        axios
            .get("http://127.0.0.1:8000/api/sections")
            .then((resp) => {
                this.sections = resp.data.data;
            })
            .catch((resp) => {
                console.log(resp);
            });
    },
    validations() {
        return {
            name: {
                required,
                maxLength: maxLength(150),
            },
            year: { maxLength: maxLength(4) },
            description: {
                required,
                maxLength: maxLength(2000),
            },
        };
    },
};
</script>
<style lang=""></style>
