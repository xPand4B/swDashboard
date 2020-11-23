<template>
    <div>
        <sw-topnav
            :brand-text="brandText"
            :brand-image="brandImage"
            toggleable="sm"
        >
            <template v-slot:right-items>
                <b-nav-item
                    @click="regenerateCache"
                    :disabled="loading"
                >
                    <b-spinner
                        v-if="loading"
                        small
                        label="Re-generating cache..."
                    />
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
            brandImage: './img/sw6-logo.png',
            loading: false
        }),

        methods: {
            regenerateCache() {
                this.loading = true;

                axios.get('api/cache/regenerate')
                    .then(res => {
                        this.loading = false;
                        Toast.fire({
                            icon: 'success',
                            title: res.data
                        });
                    })
                    .catch(err => {
                        this.loading = false;
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
