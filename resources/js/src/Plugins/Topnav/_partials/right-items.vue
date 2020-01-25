<template>
    <ul class="navbar-nav ml-auto"
        v-if="!!this.$slots.default"
    >
        <slot/>
    </ul>
</template>

<script>
    export default {
        name: "topnav-right-items",
    }
</script>
