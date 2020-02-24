<template>
    <b-modal
        v-model="$createModal.show"
        title="Create new Shopware Instance"
        lazy
        hide-footer
    >
        <template v-slot:modal-title>
            Create new Shopware Instance
        </template>

        <b-form @submit.prevent="onSubmit">
            <b-form-group
                id="swVersion-FormGroup"
                label="Shopware Version:"
                label-for="swVersion-Select"
            >
                <b-form-select
                    id="swVersion-Select"
                    v-model="form.swVersion"
                    :options="$createModal.versions"
                    required
                />
            </b-form-group>

            <b-row class="mt-4">
                <b-col>
                    <b-button
                        type="reset"
                        variant="outline-danger btn-block"
                    >
                        Reset
                    </b-button>
                </b-col>
                <b-col>
                    <b-button
                        type="submit"
                        variant="outline-success btn-block"
                    >
                        Create
                    </b-button>
                </b-col>
            </b-row>

        </b-form>
    </b-modal>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    swVersion: null
                }
            }
        },

        methods: {
            onSubmit() {
                const me = this;

                me.$createModal.show = false;

                Toast.fire({
                    title: 'Downloading...',
                    icon: 'info',
                    timer: false,
                    allowEscapeKey: false
                });
                Toast.showLoading();

                axios.post('api/directory', {
                    swVersion: me.form.swVersion
                })
                .then(res => {
                    Toast.close();

                    if (res.status === 201) {
                        me.$swDirectories.fetch();

                        Toast.fire({
                            icon: 'success',
                            title: 'Download successful!',
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: res.data,
                        });
                    }
                })
                .catch(err => {
                    Toast.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        text: err,
                    });
                });
            }
        }
    }
</script>
