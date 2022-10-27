<template lang="">
    <div class="input-group rounded my-4">
        <input
            type="search"
            v-model.trim="filteredValue"
            class="form-control rounded"
            placeholder="Search"
            aria-label="Search"
            aria-describedby="search-addon"
        />
    </div>
</template>
<script>
export default {
    props: {
        value: {
            type: String
        }
    },
    computed:{
        filteredValue: {
            get() {
                return this.value;
            },
            set(newValue) {
                this.$emit("update:value", newValue);
            },
        }
    }
}
</script>
