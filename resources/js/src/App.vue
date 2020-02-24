<template>
    <router-view/>
</template>

<script>
    export default {
        name: "App",

        mounted() {
            const me = this;

            me.$swDirectories.fetch();

            console.log('Vue.js successfully mounted!');
        }
    }
</script>
