const DirectoryStore = {
    apiReturnType: null,
    availableDirectories: null,
    selectedMajor: '6-x',
    comments: [],

    async fetch() {
        const me = this;

        await axios.get('api/directory')
            .then(res => {
                me.apiReturnType = res.data.data.type;
                me.availableDirectories = res.data.data.attributes;
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Could not fetch directory data!',
                    text: err
                });
            });

        const selectedVersion = Object.values(me.availableDirectories)[0][0].version;

        this.getComments(selectedVersion);
    },

    async addComment(version, comment) {
        const me = this;

        await axios.post(`api/comment/${version}`, {
            comments: comment
        }).catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Could not fetch comments!',
                text: err
            });
        });

        me.getComments(version);
    },

    async getComments(version) {
        const me = this;

        me.comments = [];

        await axios.get(`api/comment/${version}`)
            .then(res => {
                if (res.data.comments !== undefined) {
                    me.comments = res.data.comments;
                }
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Could not fetch comments!',
                    text: err
                });
            });
    },

    async deleteComment(version, comment) {
        const me = this;

        await axios.post(`api/comment/${version}/delete`, {
            comments: comment
        }).catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Could not delete comment!',
                text: err
            });
        });

        await me.getComments(version);
    },

    deleteInstance(path = '') {
        if (path === '') {
            return;
        }

        const me = this;

        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            showCancelButton: true,
            reverseButtons: true,
            customClass: {
                cancelButton: 'col-md-5 btn btn-outline-info',
                confirmButton: 'offset-md-1 col-md-5 btn btn-outline-danger',
            },
            buttonsStyling: false
        }).then(res => {
            if (res.value) {
                Toast.fire({
                    icon: 'info',
                    title: 'Deleting...',
                    timer: false,
                    allowEscapeKey: false
                });
                Toast.showLoading();

                axios.post('api/directory/delete', {
                    swPathToDelete: path
                }).then(res => {
                    me.fetch();
                    Toast.close();
                    Toast.fire({
                      icon: 'success',
                        title: 'Deleted!'
                    });
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
};

const swDirectoryPlugin = {
    install(Vue) {
        Vue.mixin({
            data: () => ({
                swDirectories: DirectoryStore
            })
        });

        Vue.prototype.$swDirectories = DirectoryStore;
    }
};

export default swDirectoryPlugin;
