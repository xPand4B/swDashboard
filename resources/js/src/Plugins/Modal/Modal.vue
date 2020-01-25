<template>
    <div class="modal fade"
         :id="id"
         tabindex="-1"
         role="dialog"
         :aria-labelledby="ariaLabel"
         aria-hidden="true"
         v-if="title || hasSlot('body') || hasSlot('footer')"
    >
        <div class="modal-dialog"
             role="document"
        >
            <div class="modal-content">
                <modal-header :title="title"/>

                <div class="modal-body"
                     v-if="hasSlot('body')"
                >
                    <slot name="body"/>
                </div>

                <div class="modal-footer"
                     v-if="hasSlot('footer')"
                >
                    <slot name="footer"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ModalHeader from './_partials/header';

    export default {
        name: "Modal",

        components: {
            ModalHeader
        },

        props: {
            title: String,
            id: {
                type: String, default: () => 'exampleModal'
            },
            ariaLabel: {
                type: String, default: () => 'exampleModalLabel'
            },
        },

        methods: {
            hasSlot (name = 'default') {
                return !!this.$slots[ name ] || !!this.$scopedSlots[ name ];
            }
        },
    };
</script>
