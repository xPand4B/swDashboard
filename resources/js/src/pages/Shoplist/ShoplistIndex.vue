<template>
    <div>
        <b-card no-body>
            <b-tabs
                pills
                card
                vertical
                lazy
                active-nav-item-class="bg-info"
            >
                <b-tab
                    v-for="(versions, major) in $swDirectories.availableDirectories"
                    :key="major"
                    @click="$createModal.selectedMajor = major"
                    class="p-0"
                >
                    <template v-slot:title>
                        <b-row>
                            <b-col>
                                {{ major }}
                            </b-col>
                            <b-col>
                                <b-badge
                                    v-if="versions.length !== 0"
                                    pill
                                    variant="dark"
                                >
                                    {{ versions.length }}
                                </b-badge>
                            </b-col>
                        </b-row>
                    </template>

                    <b-card no-body >
                        <b-tabs card>
                            <b-tab
                                v-for="item in versions"
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
                                        <a
                                            :href="replaceDot(item.version)"
                                            class="btn btn-block btn-outline-primary"
                                            target="_blank"
                                        >
                                            {{ major.toString() === '6.x' ? 'Storefront' : 'Frontend' }}
                                        </a>
                                    </b-col>
                                    <b-col>
                                        <a
                                            :href="getBackendLink(major, item.version)"
                                            class="btn btn-block btn-outline-secondary"
                                            target="_blank"
                                        >
                                            {{ major.toString() === '6.x' ? 'Admin' : 'Backend' }}
                                        </a>
                                    </b-col>
                                    <b-col>
                                        <b-button
                                            @click="$swDirectories.deleteInstance(item.path)"
                                            variant="outline-danger btn-block"
                                        >
                                            Delete
                                        </b-button>
                                    </b-col>
                                </div>

                            </b-tab>

                            <!-- New Tab Button (Using tabs-end slot) -->
                            <template v-slot:tabs-end>
                                <b-nav-item
                                    @click.stop="$createModal.toggle"
                                    href="#"
                                >
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
        <create-modal/>

    </div>
</template>

<script>
    export default {
        methods: {
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
