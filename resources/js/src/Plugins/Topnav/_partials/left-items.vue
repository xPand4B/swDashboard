<template>
    <ul class="navbar-nav pl-4 mr-auto"
        v-if="!!this.$slots.default"
    >
        <slot/>
    </ul>
</template>

<script>
    export default {
        name: "topnav-left-items",
    }
</script>
