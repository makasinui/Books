<template lang="">
    <form class="container border needs-validation" @submit.prevent="sendUpdate">
        <label class="form-label">Название</label> <br />
        <input
            type="text"
            :value="name"
            @blur="checkName"
            required
            class="form-control"
            :class="{'is-invalid': nameError }"
        />

        <div class="invalid-feedback" v-show="nameError">
            Макс. кол-во символов: {{ v$.name.maxLength.$params.max }}
        </div>

        
        <label class="form-label">Описание раздела</label> <br />
               <textarea
                name="description"
                @blur="checkDescription"
                :value="description"
                class="form-control"
                :class="{ 'is-invalid': descriptionError }"
                required
            ></textarea>
                <div class="invalid-feedback" v-show="descriptionError">
                Макс. кол-во символов: {{ v$.description.maxLength.$params.max }}
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
    data() {
        return {
            name: "",
            description: '',
            nameError: false,
            descriptionError: false,
        };
    },
    methods: {
        sendUpdate() {
            if (!document.querySelector(".is-invalid")) {
                axios.post("/api/sections/", {
                        name: this.name,
                        description: this.description,
                    })
                    .then(() => {
                        alert('Успешно!')
                        this.$router.push('/sections')
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
        checkDescription(e){
            this.description = e.target.value;
            this.v$.description.$touch();
            (!this.v$.description.maxLength.$response) ? this.descriptionError = true : this.descriptionError = false;
        }
    },
    validations() {
        return {
            name: { maxLength: maxLength(150) },
            description: { maxLength: maxLength(500) }
        };
    },
};
</script>
<style lang=""></style>
