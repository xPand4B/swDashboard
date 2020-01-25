<template>
    <div>
        <div class="row mt-4"
             v-if="items"
        >
            <div class="col-3">
                <div class="nav flex-column nav-pills"
                     :id="tabId"
                     role="tablist"
                     aria-orientation="vertical"
                >
                    <a v-for="(value, index) in items"
                       :key="index"
                       class="nav-link text-center"
                       :class="index = activeKey ? 'active' : null"
                       :id="'v-tab-' + replaceCharacters(index)"
                       data-toggle="pill"
                       :href="'#' + tabContentId + '-' + replaceCharacters(index)"
                       role="tab"
                       :aria-controls="'v-tab-' + replaceCharacters(index)"
                    >
                        {{ index }}
                    </a>
                </div>
            </div>

            <div class="col-9">
                <div class="tab-content"
                     :id="tabContentId"
                >
                    <div v-for="(value, index) in items"
                         class="tab-pane fade"
                         :class="index = activeKey ? 'show active' : null"
                         :id="'#' + tabContentId + '-' + replaceCharacters(index)"
                         role="tabpanel"
                         :aria-labelledby="tabContentId + '-' + replaceCharacters(index)"
                    >
                        {{ value }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "vertical-tab-menu",

        props: {
            items: Array,
            activeKey: String,
            tabId: {
                type: String, default: () => 'v-tab'
            },
            tabContentId: {
                type: String, default: () => 'v-tabContent'
            },
        },

        methods: {
            replaceCharacters(string) {
                // return string.toString().replace('.', '-');
            },

        }
    }
</script>
