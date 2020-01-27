<template>
    <li class="nav-item dropdown"
        v-if="items"
    >
        <a href="#"
           class="nav-link dropdown-toggle"
           :id="id ? id : null"
           role="button"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
        >
            <icon :name="icon"/>{{ name }}
        </a>

        <div class="dropdown-menu"
             aria-labelledby="navbarDropdown"
        >
            <div v-for="item in items">
                <div v-if="item.divider" class="dropdown-divider"></div>

                <topnav-link v-else
                             :key="item.id"
                             :name="item.name"
                             :link="item.link"
                             :icon="item.icon"
                             classes="dropdown-item"
                />
            </div>
        </div>
    </li>
</template>

<script>
    import { TopnavLink } from "../../index";
    import { Icon } from "../../../Components";

    export default {
        name: "topnav-dropdown",

        components: {
            TopnavLink, Icon
        },

        props: {
            id: String,
            name: String,
            icon: String,
            items: Array,
        }
    }
</script>
