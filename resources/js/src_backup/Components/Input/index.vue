<template>
    <input :id="id"
           :type="type"
           :name="name"
           :value="value ? value : null"
           :minlength="minLength ? minLength : null"
           :maxlength="maxLength ? maxLength : null"
    >
</template>

<script>
    import { Icon } from "../index";

    export default {
        name: "custom-input",
        components: {
            Icon
        },

        props: {
            id: String,
            type: String,
            name: String,
            value: String,
            minLength: Number,
            maxLength: Number,
        },
    }
</script>
