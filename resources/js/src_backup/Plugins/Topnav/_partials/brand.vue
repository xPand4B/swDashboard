<template>
    <a href="#"
       class="navbar-brand"
    >
        <img v-if="image"
             :src="image"
             :height="imageHeight"
             :width="imageWidth"
             class="d-inline-block align-top"
             :alt="imageAlt ? imageAlt : null">
        {{ title ? title : null}}
    </a>
</template>

<script>
    export default {
        name: "topnav-brand",

        props: {
            title: String,
            image: String,
            imageAlt: String,
            imageHeight: {
                type: Number, default: () => 30
            },
            imageWidth: {
                type: Number, default: () => 30
            },
        },
    }
</script>

