<template>
    <nav class="justify-center flex">
        <ul class="pagination">
            <li
                class="page-item"
                v-for="(item, i) in Math.ceil(pages / 5)"
                @click="active(item)"
                :class="{ active: item === currentPage }"
            >
                <a
                    class="page-link"
                    @click="$emit('selectPage', i + 1)"
                    >{{ item }}</a
                >
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: {
        pages: {
            required: true
        },
    },
    data() {
        return {
            currentPage: 1
        };
    },
    methods: {
        active(item) {
            this.currentPage = item;
        },
    },
};
</script>
<style scoped>
.page-link {
    cursor: pointer;
}
</style>
