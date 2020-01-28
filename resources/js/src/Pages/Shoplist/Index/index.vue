<template>
    <div>
        <b-card no-body>
            <b-tabs pills card vertical>
                <b-tab v-for="(versions, major) in availableDirectories"
                       :title="major"
                       :key="major"
                       @click="setSelectedMajor(major)"
                       class="p-0"
                >

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
                                        <a href="#" class="btn btn-block btn-outline-primary" target="_blank">
                                            {{ major.toString() === '6.x' ? 'Storefront' : 'Frontend' }}
                                        </a>
                                    </b-col>
                                    <b-col>
                                        <a href="#" class="btn btn-block btn-outline-secondary" target="_blank">
                                            {{ major.toString() === '6.x' ? 'Admin' : 'Backend' }}
                                        </a>
                                    </b-col>
                                    <b-col>
                                        <b-button variant="outline-danger btn-block" @click="deleteInstance(item.path)">
                                            <sw-icon name="fas fa-trash"/> Delete
                                        </b-button>
                                    </b-col>
                                </div>

                            </b-tab>

                            <!-- New Tab Button (Using tabs-end slot) -->
                            <template v-slot:tabs-end>
                                <b-nav-item @click="createNewInstance" href="#">
                                    <b> <sw-icon name="fas fa-folder-plus"/> </b>
                                </b-nav-item>
                            </template>

                            <!-- Render this if no tabs -->
                            <template v-slot:empty>
                                <div class="text-center text-muted">
                                    There are no versions installed.
                                    <br>
                                    Create a new instance using the <b><sw-icon name="fas fa-folder-plus"/></b> icon above.
                                </div>
                            </template>

                        </b-tabs>
                    </b-card>

                </b-tab>
            </b-tabs>
        </b-card>

        <!-- Create Modal -->
        <b-modal :ref="createModalId" :id="createModalId" title="Create new Shopware Instance" lazy hide-footer>
            <template v-slot:modal-title>
                Create new Shopware Instance
            </template>

            <router-view :major="selectedMajor"/>

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
                selectedMajor: '6-x'
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
            },

            setSelectedMajor(major) {
                this.selectedMajor = major;
            },

            createNewInstance() {
                this.toggleModal();
            },

            toggleModal() {
                this.$root.$emit('bv::toggle::modal', this.createModalId, '#btnToggle');
            },

            deleteInstance(path) {

            },

            replaceDot(string) {
                return string.toString().replace('.', '-');
            }
        }
    }
</script>
