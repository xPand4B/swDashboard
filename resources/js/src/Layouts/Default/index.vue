<template>
    <div>
        <!-- Topnav -->
        <sw-topnav brand-text="swDashboard"
                   brand-image="./img/sw6-logo.png"
                   toggleable="sm"
        >
            <!-- Right Items -->
            <template v-slot:right-items>
                <b-dropdown variant="link" toggle-class="nav-link" lazy right>
                    <template v-slot:button-content>
                        <b-icon icon="php"/> PHP Version
                    </template>

                    <b-dropdown-header>Coming soon...</b-dropdown-header>

                    <div v-for="phpVersion in availablePhpVersions"
                         :key="phpVersion"
                    >
                        <div v-if="phpVersion === ''">
                            <b-dropdown-divider/>
                        </div>
                        <div v-else>
                            <b-dropdown-item-button :variant="isCurrentPhpVersion(phpVersion) ? 'success' : null"
                                                    @click="changePhpVersion(phpVersion)"
                            >
                                {{ phpVersion }}
                            </b-dropdown-item-button>
                        </div>
                    </div>
                </b-dropdown>
            </template>
        </sw-topnav>

        <b-container class="mt-4">
            <router-view/>
        </b-container>
    </div>
</template>

<script>
    import { swTopnav } from "../../Plugins";

    export default {
        name: "sw-layout-default",

        components: {
            swTopnav
        },

        data() {
            return {
                createModalId: 'newShopwareInstanceModal',
                currentPhpVersion: '',
                availablePhpVersions: [
                    '7.4', '7.3', '7.2', '7.1', '', '5.6'
                ],
            }
        },

        mounted() {
            this.getPhpVersion();
        },

        methods: {
            changePhpVersion(newPhpVersion) {
                if (this.isCurrentPhpVersion(newPhpVersion)) {
                    Toast.fire({
                        icon: 'info',
                        title: 'PHP v'+newPhpVersion+' already set!'
                    });
                    return null;
                }

                axios.post('api/phpversion', {
                    newPhpVersion
                })
                .then(res => {
                    Toast.fire({
                        icon: 'info',
                        title: 'Switching PHP Version...',
                        timer: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    Toast.showLoading();

                    if (res.status === 200) {
                        Toast.close();
                        this.getPhpVersion();
                        Toast.fire({
                            icon: 'error',
                            title: res.data['msg'],
                        });
                    }
                })
                .catch(err => {
                    Toast.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not fetch directory data!',
                        text: err
                    });
                });
            },

            isCurrentPhpVersion(version) {
                return this.currentPhpVersion.includes(version);
            },

            getPhpVersion() {
                axios.get('api/phpversion')
                .then(res => {
                    if (res.status === 200) {
                        this.currentPhpVersion = res.data['currentPhpVersion'];
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
        }
    };
</script>
