<template>
    <div>
        <!-- Topnav -->
        <sw-topnav brand-text="swDashboard"
                   brand-image="/img/sw6-logo.png"
                   toggleable="sm"
        >
            <!-- Right Items -->
            <template v-slot:right-items>
                <b-button @click="toggleModal" variant="link" class="nav-link mr-3">
                    <sw-icon name="fas fa-folder-plus"/> Shopware Instance
                </b-button>

                <b-dropdown variant="link" toggle-class="nav-link" lazy right>
                    <template v-slot:button-content>
                        <sw-icon name="fab fa-php"/>
                    </template>

                    <b-dropdown-header>PHP Version</b-dropdown-header>

                    <b-dropdown-item-button>7.4</b-dropdown-item-button>
                    <b-dropdown-item-button>7.3</b-dropdown-item-button>
                    <b-dropdown-item-button>7.2</b-dropdown-item-button>
                    <b-dropdown-item-button>7.1</b-dropdown-item-button>
                    <b-dropdown-divider/>
                    <b-dropdown-item-button>5.6</b-dropdown-item-button>
                </b-dropdown>
            </template>
        </sw-topnav>

        <!-- Create Modal -->
        <b-modal v-model="modalShow" title="Create new Shopware Instance" lazy hide-footer>
            <template v-slot:modal-title>
                Create new Shopware Instance
            </template>

            <router-view name="create" :modalShow="modalShow"/>

        </b-modal>

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
                modalShow : false
            }
        },

        methods: {
            toggleModal() {
                this.modalShow = !this.modalShow;
            }
        }
    };
</script>
