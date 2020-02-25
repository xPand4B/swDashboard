<template>
    <div>
        <sw-topnav
            :brand-text="brandText"
            :brand-image="brandImage"
            toggleable="sm"
        />

        <sw-content/>
    </div>
</template>

<script>
    import swTopnav from "./Topnav";
    import swContent from './Content';

    export default {
        name: "sw-layout-default",

        components: {
            swTopnav, swContent
        },

        data: () => ({
            brandText: 'swDashboard',
            brandImage: './img/sw6-logo.png'
        })
    };
</script>
