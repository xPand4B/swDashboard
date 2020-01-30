<template>
    <div>
        <b-card no-body>
            <b-tabs pills card vertical lazy active-nav-item-class="bg-info">
                <b-tab v-for="(versions, major) in availableDirectories"
                       :key="major"
                       @click="setSelectedMajor(major)"
                       class="p-0"
                >
                    <template v-slot:title>
                        <b-row>
                            <b-col>
                                {{ major }}
                            </b-col>
                            <b-col>
                                <b-badge v-if="versions.length !== 0" pill variant="dark">{{ versions.length }}</b-badge>
                            </b-col>
                        </b-row>
                    </template>

                    <b-card no-body >
                        <b-tabs card>
                            <b-tab v-for="item in versions"
                                   :key="'dyn-tab-' + replaceDot(major) + item.version"
                                   :title="item.version"
                                   lazy
                            >
                                <dl class="row">
                                    <dt class="col-sm-2">Version:</dt>
                                    <dd class="col-sm-10">{{ item.version }}</dd>

                                    <dt class="col-sm-2">Path:</dt>
                                    <dd class="col-sm-10">{{ item.path }}</dd>
                                </dl>


                                <div class="row">
                                    <b-col>
                                        <a :href="replaceDot(item.version)" class="btn btn-block btn-outline-primary" target="_blank">
                                            {{ major.toString() === '6.x' ? 'Storefront' : 'Frontend' }}
                                        </a>
                                    </b-col>
                                    <b-col>
                                        <a :href="getBackendLink(major, item.version)" class="btn btn-block btn-outline-secondary" target="_blank">
                                            {{ major.toString() === '6.x' ? 'Admin' : 'Backend' }}
                                        </a>
                                    </b-col>
                                    <b-col>
                                        <b-button variant="outline-danger btn-block" @click="deleteInstance(item.path)">
                                            <div v-if="deleting">
                                                <b-spinner type="grow" small></b-spinner> Deleting...
                                            </div>
                                            <div v-else>
                                                <b-icon icon="trash"/> Delete
                                            </div>
                                        </b-button>
                                    </b-col>
                                </div>

                            </b-tab>

                            <!-- New Tab Button (Using tabs-end slot) -->
                            <template v-slot:tabs-end>
                                <b-nav-item @click="createNewInstance" href="#">
                                    <b> <b-icon icon="plus" font-scale="1,5"/> </b>
                                </b-nav-item>
                            </template>

                            <!-- Render this if no tabs -->
                            <template v-slot:empty>
                                <div class="text-center text-muted">
                                    There are no versions installed.
                                    <br>
                                    Create a new instance using the <b><b-icon icon="plus"/></b> icon above.
                                </div>
                            </template>

                        </b-tabs>
                    </b-card>

                </b-tab>
            </b-tabs>
        </b-card>

        <!-- Create Modal -->
        <b-modal v-model="modalShow" title="Create new Shopware Instance" lazy hide-footer>
            <template v-slot:modal-title>
                Create new Shopware Instance
            </template>

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
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "swShoplistIndex",

        data() {
            return {
                apiReturnType: null,
                availableDirectories: null,
                createModalId: 'newShopwareInstanceModal',
                selectedMajor: '6-x',
                modalShow: false,
                deleting: false,
                form: {
                    swVersion: null
                },
                versions: []
            }
        },

        mounted() {
            this.loadDirectories();
        },

        methods: {
            loadDirectories() {
                axios.get('api/directory')
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
            },

            loadAvailableVersions() {
                axios.get('api/version/'+this.selectedMajor)
                    .then(res => {
                        if (res.status === 200) {
                            this.apiReturnType = res.data['data']['type'];

                            let temp = [];
                            temp.push({ text: '', value: null, selected: true });

                            res.data['data']['attributes'].map((version, index) => {
                                temp.push({ value: version, text: version});
                            });

                            this.versions = temp;
                        }
                    })
                    .catch(err => {
                        this.toggleModal();

                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: err,
                        });
                    });
            },

            onSubmit(event) {
                event.preventDefault();
                this.toggleModal();

                Toast.fire({
                    title: 'Downloading...',
                    icon: 'info',
                    timer: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                Toast.showLoading();

                axios.post('api/directory', {
                    swVersion: this.form.swVersion
                })
                .then(res => {
                    Toast.close();

                    if (res.status === 201) {
                        this.loadDirectories();

                        Toast.fire({
                            icon: 'success',
                            title: 'Download successfull!',
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
            },

            setSelectedMajor(major) {
                this.selectedMajor = major;
            },

            createNewInstance() {
                this.toggleModal();
                this.loadAvailableVersions();
            },

            toggleModal() {
                this.modalShow = !this.modalShow;
            },

            toggleDeleting() {
                this.deleting = !this.deleting;
            },

            deleteInstance(path) {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    showCancelButton: true,
                    reverseButtons: true,
                    customClass: {
                        cancelButton: 'col-md-5 btn btn-outline-info',
                        confirmButton: 'offset-md-1 col-md-5 btn btn-outline-danger',
                    },
                    buttonsStyling: false
                })
                .then(res => {
                    if (res.value) {
                        this.toggleDeleting();
                        Toast.fire({
                            icon: 'info',
                            title: 'Deleting...',
                            timer: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });

                        axios.post('api/directory/delete', {
                            swPathToDelete: path
                        })
                        .then(res => {
                            this.loadDirectories();
                            Toast.close();
                            Toast.fire({
                                icon: 'success',
                                title: 'Deleted!'
                            });
                            this.toggleDeleting();
                        })
                        .catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong!',
                                text: err,
                            });
                        });
                    }
                });
            },

            replaceDot(string) {
                return string.toString().split('.').join('-');
            },

            getBackendLink(major, version) {
                if (major === '6.x') {
                    return this.replaceDot(version)+'/admin';
                } else {
                    return this.replaceDot(version)+'/backend';
                }
            }
        }
    }
</script>
