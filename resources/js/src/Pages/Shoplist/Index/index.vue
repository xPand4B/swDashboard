<template>
    <div>
        <b-card no-body>
            <b-tabs pills card vertical>
                <b-tab v-for>

                </b-tab>
                <b-tab title="Refresh" @click="loadDirectories">
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: "swShoplistIndex",

        data() {
            return {
                apiReturnType: null,
                availableDirectories: null
            }
        },

        mounted() {
            this.loadDirectories();
        },

        methods: {
            loadDirectories() {
                axios.get('/api/directory')
                .then(res => {
                    if (res.status === 200) {
                        this.apiReturnType = res.data['data']['type'];
                        this.availableDirectories = res.data['data']['attributes'];
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not fetch directory data!',
                        text: err
                    });
                });
            }
        }
    }
</script>
