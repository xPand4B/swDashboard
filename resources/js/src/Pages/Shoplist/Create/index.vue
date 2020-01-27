<template>
    <div>
        <b-form @submit="onSubmit">
            <b-form-group id="swVersion-FormGroup"
                          label="Shopware Version:"
                          label-for="swVersion-Select"
            >
                <b-form-select id="swVersion-Select"
                               v-model="form.swVersion"
                               :options="versions"
                               required
                />
            </b-form-group>

            <b-row class="mt-4">
                <b-col>
                    <b-button type="reset" variant="outline-danger btn-block">
                        <sw-icon name="fas fa-redo"/> Reset
                    </b-button>
                </b-col>
                <b-col>
                    <b-button type="submit" variant="outline-success btn-block">
                        <sw-icon name="fas fa-folder-plus"/> Create
                    </b-button>
                </b-col>
            </b-row>


        </b-form>
    </div>
</template>

<script>
    export default {
        name: "swShoplistCreate",

        props: {
            modalShow: Boolean
        },

        data() {
            return {
                apiReturnType: null,
                form: {
                    swVersion: null
                },
                versions: [
                    { text: '...', value: null, selected: true },
                ]
            }
        },

        mounted() {
            this.loadAvailableVersions();
        },

        methods: {
            loadAvailableVersions() {
                axios.get('/api/version')
                .then(res => {
                    if (res.status === 200) {
                        this.apiReturnType = res.data['data']['type'];

                        res.data['data']['attributes'].map((version, index) => {
                            this.versions.push({ value: version, text: version});
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        text: err,
                    });
                });
            },

            onSubmit(event) {
                event.preventDefault();
            },
        }
    }
</script>
