<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark border-bottom border-primary">
        <div class="container">
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

            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"/>
            </button>

            <div class="collapse navbar-collapse"
                 id="navbarSupportedContent"
            >
                <topnav-left-items>
                    <slot name="left-items"/>
                </topnav-left-items>

                <topnav-right-items>
                    <slot name="right-items"/>
                </topnav-right-items>
            </div>
        </div>
    </nav>
</template>

<script>
    import TopnavLeftItems from './_partials/left-items';
    import TopnavRightItems from './_partials/right-items';

    export default {
        name: "Topnav",

        components: {
            TopnavLeftItems, TopnavRightItems
        },

        props: {
            title: String,
            items: Array,
            image: String,
            imageAlt: String,
            imageHeight: {
                type: Number, default: () => 30
            },
            imageWidth: {
                type: Number, default: () => 30
            },
        },
    };
</script>
