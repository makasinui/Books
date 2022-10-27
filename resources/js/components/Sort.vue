<template lang="">
    <div>
        <select name="select" @change="sortItem($e)" v-model="sort">
            <option value="books.name">По имени</option>
            <option value="author_name">По автору</option>
        </select>
    </div>
</template>
<script>
export default {
    props: {
        value: {
            required: true
        }
    },
    computed: {
        sort: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit('update:value', value);
            }
        }
    }
};
</script>
