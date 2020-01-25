<template>
    <i v-if="name" :class="name"/>
</template>

<script>
    export default {
        name: "icon",

        props: {
            name: String
        }
    }
</script>
