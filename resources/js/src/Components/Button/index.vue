<template>
    <button :type="type ? type : null">
        <icon v-if="icon" :name="icon"/>
        <slot/>
    </button>
</template>

<script>
    import { Icon } from "../index";

    export default {
        name: "custom-button",

        components: {
            Icon
        },

        props: {
            icon: String,
            text: String,
            type: String
        },
    }
</script>
