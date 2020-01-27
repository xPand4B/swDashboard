<template>
    <div>
        <topnav title="swDashboard"
                image="/img/sw6-logo.png"
                image-alt="Shopware 6 - Logo"
        >
            <template v-slot:left-items>
            </template>

            <template v-slot:right-items>
                <topnav-link name="Shopware Instance"
                             icon="fas fa-folder-plus"
                             :dataTarget="'#'+managementCreateModalId"
                             style="cursor: pointer"
                />

                <topnav-dropdown icon="fab fa-php"
                                 :items="phpVersions"/>
            </template>
        </topnav>

        <modal :id="managementCreateModalId"
               title="Create new Shopware Instance"
        >
            <template v-slot:body>
                <form @submit="">
                    <div class="container">
                        <div class="form-group">
                            <label for="swVersion">
                                Shopware Version:
                            </label>
                            <select name="swVersion"
                                    id="swVersion"
                                    class="form-control"
                                    onchange=""
                                    required
                            >
                                <option value="">...</option>
                            </select>
                        </div>

                        <custom-input type="text"
                                      id="swDirectory"
                                      name="swDirectory"
                                      hidden
                                      required/>
                    </div>
                    <hr>

                    <custom-button class="btn btn-primary btn-block btn-submit"
                                   icon="fas fa-folder-plus"
                    >Create</custom-button>
                </form>
            </template>
        </modal>

        <div class="container">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import { Topnav, TopnavLink, TopnavDropdown, Modal } from "../../Plugins";
    import { Icon, CustomButton, CustomInput } from "../../Components";

    export default {
        name: "DefaultLayout",

        components: {
            Topnav, TopnavLink, TopnavDropdown,
            Icon, CustomButton, CustomInput,
            Modal,
        },

        data() {
            return {
                managementCreateModalId: 'managementCreateModal',
                phpVersions: [
                    { id: 1, name: '7.4', link: '#' },
                    { id: 2, name: '7.2', link: '#' },
                    { id: 3, name: '7.1', link: '#' },
                    { id: 4, divider: true},
                    { id: 5, name: '5.6', link: '#' },
                ]
            }
        },

        created() {
            axios.get("/api/version")
                .then(res => {
                    if (res.status === 200) {
                        let swVersions = res.data['swVersions'];

                        this.PopulateVersionDropdown(swVersions);
                    }
                }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Could not fetch data correctly!',
                    text: err,
                });
            });
        },

        methods: {
            PopulateVersionDropdown(data) {
                let swVersionDropdown = document.getElementById('swVersion');

                for (const [key, value] of Object.entries(data)) {
                    let option = document.createElement('option');
                    option.value = value.toString();
                    option.innerHTML = value.toString();
                    swVersionDropdown.append(option);
                }
            },
        },
    }
</script>
