const DirectoryStore = {
    apiReturnType: null,
    availableDirectories: null,

    fetch() {
        const me = this;

        fetch('api/directory')
            .then(data => data.json())
            .then(res => {
                me.apiReturnType = res.data.type;
                me.availableDirectories = res.data.attributes;
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

                fetch('api/directory/delete', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        swPathToDelete: path
                    })
                }).then(data => data.json())
                    .then(res => {
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
