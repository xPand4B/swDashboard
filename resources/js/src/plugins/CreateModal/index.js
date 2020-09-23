import CreateModal from "./template";

const ModalStore = {
    id: 'newShopwareInstanceModal',
    show: null,
    versions: [],
    selectedMajor: '6-x',
    apiReturnType: null,

    toggle() {
        this.loadAvailableVersions()
            .then(res => {
                this.show = !!!this.show;
            });
    },

    async loadAvailableVersions() {
        await axios.get('api/version/' + this.selectedMajor)
            .then(res => {
                this.apiReturnType = res.data.data.type;

                let temp = [];
                temp.push({ text: '', value: null, selected: true });

                res.data.data.attributes.map((version, index) => {
                    temp.push({ value: version, text: version});
                });

                this.versions = temp;
            })
            .catch(err => {
                this.toggle();

                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                    text: err,
                });
            });
    }
};

const CreateModalPlugin = {
    install(Vue) {
        Vue.mixin({
            data: () => ({
                createModalStore: ModalStore
            })
        });

        Vue.prototype.$createModal = ModalStore;
        Vue.component('create-modal', CreateModal);
    }
};

export default CreateModalPlugin;
