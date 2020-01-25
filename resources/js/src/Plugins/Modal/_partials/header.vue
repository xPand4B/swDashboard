<template>
    <div class="modal-header"
         v-if="title"
    >
        <h5 class="modal-title">{{ title }}</h5>
        <button type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        name: "ModalHeader",

        props: {
            title: String
        }
    }
</script>
