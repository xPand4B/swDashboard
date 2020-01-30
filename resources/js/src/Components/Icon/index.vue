<template>
    <i v-if="name"
       :class="name"
       :height="height ? height : null"
       :width="width ? width : null"
    />
</template>

<script>
    export default {
        name: "sw-icon",

        props: {
            name: String,
            height: String,
            width: String,
        }
    }
</script>
