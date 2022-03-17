<template lang="">
    <form @submit.prevent="addAuthor">
        <div class="mb-3">
            <label class="form-label">ФИО автора</label>
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
            <label class="form-label">Страна</label>
            <input
                type="text"
                name="country"
                v-model="v$.country.$model"
                @blur="v$.country.$touch"
                class="form-control"
                :class="{ 'is-invalid': v$.country.$errors.length }"
            />

            <div class="invalid-feedback" v-show="!v$.country.required.$response">
                Обязательно для заполнения
            </div>

            <div class="invalid-feedback" v-show="!v$.country.maxLength.$response">
                Макс. кол-во символов: {{ v$.country.maxLength.$params.max }}
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Комментарий</label>
            <textarea
                name="description"
                cols="30"
                rows="10"
                v-model="v$.comment.$model"
                @blur="v$.comment.$touch"
                class="form-control"
                :class="{ 'is-invalid': v$.comment.$errors.length }"
                required
            ></textarea>
            <div class="invalid-feedback" v-show="!v$.comment.maxLength.$response">
                Макс. кол-во символов: {{ v$.comment.maxLength.$params.max }}
            </div>

            <div class="invalid-feedback" v-show="!v$.comment.required.$response">
                Обязательно для заполнения
            </div>
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
            name: "",
            country: "",
            comment: "",
        };
    },
    methods: {
        addAuthor() {
            axios.post("/api/authors", {
                    name: this.name,
                    country: this.country,
                    comment: this.comment,
                })
                .then((resp) => {
                    alert('Успешно!')
                    this.$router.push('/authors')
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    mounted() {
        
    },
    validations() {
        return {
            name: {
                required,
                maxLength: maxLength(150),
            },
            country: {
                required,
                maxLength: maxLength(100) },
            comment: {
                required,
                maxLength: maxLength(500),
            },
        };
    },
};
</script>
