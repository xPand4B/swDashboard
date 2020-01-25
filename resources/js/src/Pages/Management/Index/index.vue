<template>
    <div class="row mt-4"
         v-if="swDirectories"
    >
        <div class="col-3">
            <div class="nav flex-column nav-pills"
                 id="v-tab"
                 role="tablist"
                 aria-orientation="vertical"
            >
                <a v-for="(value, major) in swDirectories"
                   :key="major"
                   class="nav-link text-center"
                   :class="checkIfActive(major)"
                   :id="generateVerticalTabId(major)"
                   data-toggle="pill"
                   :href="'#' + generateVerticalContentId(major)"
                   role="tab"
                   :aria-controls="generateVerticalTabId"
                >
                    {{ major }}
                </a>
            </div>
        </div>

        <div class="col-9">
            <div class="tab-content"
                 id="v-tabContent"
            >
                <div v-for="(value, major) in swDirectories"
                     :key="major"
                     class="tab-pane fade"
                     :class="checkIfActive(major, 'show active')"
                     :id="generateVerticalContentId(major)"
                     role="tabpanel"
                     :aria-labelledby="generateVerticalContentId(major)"
                >
                    <div v-if="Object.keys(value).length !== 0">
                        <nav>
                            <div class="nav nav-tabs"
                                 id="nav-tab"
                                 role="tablist"
                            >
                                <a v-for="(item, index) in value"
                                   class="nav-item nav-link"
                                   :class="index.toString() === '0' ? 'active' : null"
                                   :id="generateHorizontalTabId(major, index)"
                                   :href="'#' + generateHorizontalContentId(major, index)"
                                   data-toggle="tab"
                                   role="tab"
                                   :aria-controls="generateHorizontalTabId(major, index)"
                                >
                                    {{ item.version }}
                                </a>
                            </div>
                        </nav>

                        <div class="tab-content mt-4"
                             id="nav-tabContent"
                        >
                            <div v-for="(item, index) in value"
                                 class="tab-pane fade"
                                 :class="index.toString() === '0' ? 'show active' : null"
                                 :id="generateHorizontalContentId(major, index)"
                                 role="tabpanel"
                                 :aria-labelledby="generateHorizontalContentId(major, index)"
                            >

                                <div class="row">
                                    <div class="col-md-9">
                                        <dl class="row">
                                            <dt class="col-sm-2">Major:</dt>
                                            <dd class="col-sm-10">{{ major }}</dd>

                                            <dt class="col-sm-2">Version:</dt>
                                            <dd class="col-sm-10">{{ item.version }}</dd>
                                        </dl>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md">
                                                <form @submit="deleteDirectory">
                                                    <input type="text"
                                                           name="swPathToDelete"
                                                           :value="item.path"
                                                           hidden
                                                           required
                                                    >
                                                    <input type="text"
                                                           name="swVersionToDelete"
                                                           :value="item.version"
                                                           hidden
                                                           required
                                                    >
                                                    <button class="btn btn-sm btn-outline-danger btn-block">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md">
                                                <button class="btn btn-sm btn-outline-success btn-block">
                                                    Re-Install
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <dl class="row mt-2">
                                    <dt class="col-sm-1">Path:</dt>
                                    <dd class="col-sm-11">{{ item.path }}</dd>
                                </dl>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#"
                                           class="btn btn-outline-primary btn-block btn-lg btn-rounded"
                                        >{{ major === '6.x' ? 'Storefront' : 'Frontend' }}</a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="#"
                                           class="btn btn-outline-secondary btn-block btn-lg btn-rounded"
                                        >{{ major === '6.x' ? 'Backend' : 'Backend' }}</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="card text-center">
                            <div class="card-header h3">
                                Seems like you have no versions installed yet.
                            </div>
                            <div class="card-body">
                                <p class="card-text h5">
                                    If you want you can click the "Shopware Instance" button.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ManagementIndex",

        data () {
            return {
                defaultMajorVersion: '6.x',
                swDirectories: Object,
            }
        },

        created() {
            this.refreshDirectories();
        },

        methods: {
            refreshDirectories() {
                axios.get("/api/directory")
                    .then(res => {
                        if (res.status === 200) {
                            this.swDirectories = res.data;
                        }
                    }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not fetch data correctly!',
                        text: err,
                    });
                });
            },

            deleteDirectory(e){
                event.preventDefault();

                let swPathToDelete = e.target['swPathToDelete'].value;
                let swVersionToDelete = e.target['swVersionToDelete'].value;

                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    confirmButtonText: '<i class="fas fa-trash"></i> Delete',
                    cancelButtonText: '<i class="fas fa-times"></i> Cancel',
                    showCancelButton: true,
                    reverseButtons: true,
                    customClass: {
                        cancelButton: 'col-md-5 btn btn-outline-danger',
                        confirmButton: 'offset-md-1 col-md-5 btn btn-outline-success',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.value) {
                        axios.post("/api/directory/delete", {
                            swPathToDelete, swVersionToDelete
                        }).then(res => {
                            if (res.status === 200) {
                                this.refreshDirectories();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: res.data,
                                });
                            }
                        }).catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong!',
                                text: err,
                            });
                        });
                    }
                });
            },

            generateHorizontalTabId(major, index){
                return 'h-tab-' + this.replaceMajor(major) + '-' + index;
            },

            generateHorizontalContentId(major, index){
                return 'h-tabContent-' + this.replaceMajor(major) + '-' + index;
            },

            generateVerticalTabId(major){
                return 'v-tab-' + this.replaceMajor(major);
            },

            generateVerticalContentId(major){
                return 'v-tabContent-' + this.replaceMajor(major);
            },

            replaceMajor(major){
                return major.toString().replace('.', '-');
            },

            checkIfActive(major, classes = 'active') {
                if (major === this.defaultMajorVersion){
                    return classes;
                }else{
                    return null;
                }
            },
        }
    }
</script>
