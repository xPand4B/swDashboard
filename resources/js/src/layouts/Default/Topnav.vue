<template>
    <div>
        <b-navbar :toggleable="toggleable"
                  :type="type"
                  :variant="variant"
                  :sticky="sticky"
        >
            <b-container>
                <b-navbar-brand :href="brandLink" tag="h1" class="mb-0">
                    <img v-if="brandImage"
                         class="mr-2"
                         :src="brandImage"
                         :alt="brandImageAlt ? brandImageAlt : null"
                         :height="brandImageHeight"
                         :width="brandImageWidth"
                    >
                    {{ brandText }}
                </b-navbar-brand>

                <b-navbar-toggle target="topnav-collapse"/>

                <b-collapse
                    id="topnav-collapse"
                    is-nav
                >
                    <!-- Left Items -->
                    <b-navbar-nav v-if="hasSlot('left-items')">
                        <slot name="left-items"/>
                    </b-navbar-nav>

                    <!-- Right Items -->
                    <b-navbar-nav v-if="hasSlot('right-items')"
                        class="ml-auto"
                    >
                        <slot name="right-items"/>
                    </b-navbar-nav>
                </b-collapse>

            </b-container>
        </b-navbar>
    </div>
</template>

<script>
    export default {
        name: "sw-topnav",

        props: {
            sticky: {
                type: Boolean,
                default: true
            },
            brandText: {
                type: String
            },
            brandLink: {
                type: String
            },
            brandImage: {
                type: String
            },
            brandImageAlt: {
                type: String
            },
            brandImageWidth: {
                type: String,
                default: '32'
            },
            brandImageHeight: {
                type: String,
                default: '32'
            },
            toggleable: {
                type: String,
                default: 'md'
            },
            type: {
                type: String,
                default: 'dark'
            },
            variant: {
                type: String,
                default: 'dark'
            },
        },

        methods: {
            hasSlot (name = 'default') {
                return !!this.$slots[ name ] || !!this.$scopedSlots[ name ];
            }
        },
    }
</script>
