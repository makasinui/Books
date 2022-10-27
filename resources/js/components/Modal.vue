<template>
    <div class="modal" tabindex="-1" v-if="show" :style="[show ? 'display: block' : 'display: none']">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal(false)"
                    ></button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    >
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            @click="closeModal(false)"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary" @click="closeModal(true)">
                            Delete
                        </button>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        show: {
            type: Boolean
        }
    },

    methods: {
        closeModal(confirm) {
            this.$emit('change', false)
            if (confirm) {
                this.$emit('change', true)
            }
        }
    }
};
</script>
