<template lang="">
    <form class="container border needs-validation" @submit.prevent="sendUpdate">
        <h2>Редактирование автора '{{ author.name }}'</h2>
        <label class="form-label">Имя</label> <br />
        <input
            type="text"
            :value="name"
            @blur="checkName"
            class="form-control"
            required
            :class="{'is-invalid': nameError }"
        />

        <div class="invalid-feedback" v-show="nameError">
            Макс. кол-во символов: {{ v$.name.maxLength.$params.max }}
        </div>

        <label class="form-label">Страна</label> <br />
        <input type="text" :value="country" @blur="checkCountry" class="form-control" :class="{ 'is-invalid': countryError }" />
        <div class="invalid-feedback" v-show="countryError">
            Макс. кол-во символов: {{ v$.country.maxLength.$params.max }}
        </div>
        <label class="form-label">Комментарий</label> <br />
               <textarea
                name="comment"
                @blur="checkComment"
                :value="comment"
                class="form-control"
                :class="{ 'is-invalid': commentError }"
                required
            ></textarea>
                <div class="invalid-feedback" v-show="commentError">
                Макс. кол-во символов: {{ v$.comment.maxLength.$params.max }}
            </div>
        <input type="submit" class="btn btn-success mt-4">
    </form>
</template>
<script>
import { maxLength } from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";

export default {
    setup() {
        return { v$: useVuelidate() };
    },
    props: ["authorId"],
    data() {
        return {
            author: [],
            name: "",
            country:'',
            comment:'',
            nameError: false,
            countryError: false,
            commentError:false
        };
    },
    mounted() {
        axios
            .get("/api/authors/" + this.authorId)
            .then((resp) => {
                this.author = resp.data.data;
                this.name = resp.data.data.name;
                this.country = resp.data.data.country;
                this.comment = resp.data.data.comment;
            })
            .catch((resp) => {
                console.log(resp);
            });
    },
    methods: {

        sendUpdate() {
            if (!document.querySelector(".is-invalid")) {
                axios.post("/api/authors/" + this.authorId, {
                        _method: "PUT",
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
            } else {
                alert('Проверьте ошибки!')
            }
        },
        checkName(e) {
            this.name = e.target.value;
            this.v$.name.$touch();
            (!this.v$.name.maxLength.$response) ? this.nameError = true : this.nameError = false;
        },
        checkCountry(e) {
            this.country = e.target.value;
            this.v$.country.$touch();
            (!this.v$.country.maxLength.$response) ? this.countryError = true : this.countryError = false;
        },
        checkComment(e){
            this.comment = e.target.value;
            this.v$.comment.$touch();
            (!this.v$.comment.maxLength.$response) ? this.commentError = true : this.commentError = false;
        }
    },
    validations() {
        return {
            name: { maxLength: maxLength(150) },
            country: { maxLength: maxLength(100) },
            comment: { maxLength: maxLength(500) }
        };
    },
};
</script>
<style lang=""></style>
