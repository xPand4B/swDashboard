<template>
    <div>
        <sw-topnav
            brand-text="swDashboard"
            brand-image="./img/sw6-logo.png"
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
        }
    };
</script>
