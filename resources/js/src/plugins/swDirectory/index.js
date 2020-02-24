const DirectoryStore = {
    apiReturnType: null,
    availableDirectories: null,

    fetch() {
        const me = this;

        axios.get('api/directory')
            .then(res => {
                if (res.status === 200) {
                    me.apiReturnType = res.data['data']['type'];
                    me.availableDirectories = res.data['data']['attributes'];
                }
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Could not fetch directory data!',
                    text: err
                });
            });
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

        Object.defineProperty(Vue.prototype, '$swDirectories', {
            get() {
                const me = this;

                return me.$root.swDirectories;
            }
        });
    }
};

export default swDirectoryPlugin;
