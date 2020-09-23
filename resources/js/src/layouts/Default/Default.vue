<template>
    <div>
        <sw-topnav
            :brand-text="brandText"
            :brand-image="brandImage"
            toggleable="sm"
        >
            <template v-slot:right-items>
                <b-nav-item @click="regenerateCache">
                    Re-generate cache
                </b-nav-item>
            </template>
        </sw-topnav>

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
        }),

        methods: {
            regenerateCache() {
                axios.get('api/cache/regenerate')
                    .then(res => {
                        Swal.fire({
                            icon: 'success',
                            title: res.data
                        });
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: err,
                        });
                    });
            }
        }
    };
</script>
