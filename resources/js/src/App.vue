<template>
    <router-view/>
</template>

<script>
    export default {
        name: "App",

        mounted() {
            console.log('Vue.js successfully mounted!');

            this.$swDirectories.fetch();
        }
    }
</script>
