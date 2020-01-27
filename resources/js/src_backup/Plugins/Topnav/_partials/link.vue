<template>
    <li class="nav-item"
        v-if="name"
    >
        <a class="px-3"
           :class="classes"
           :href="link ? link : null"
           data-toggle="modal"
           :data-target="dataTarget ? dataTarget : null"
        >
            <icon :name="icon"/>
            {{ name }}
        </a>
    </li>
</template>

<script>
    import { Icon } from "../../../Components";

    export default {
        name: "topnav-link",

        components: {
            Icon
        },

        props: {
            name: String,
            icon: String,
            link: String,
            runFunction: String,
            dataTarget: String,
            classes: {
                type: String, default: () => 'nav-link'
            },
        },
    }
</script>
