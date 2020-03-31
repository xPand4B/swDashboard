import CreateModal from "./template";

const ModalStore = {
    id: 'newShopwareInstanceModal',
    show: null,
    versions: [],
    selectedMajor: '6-x',
    apiReturnType: null,

    toggle() {
        const me = this;

        me.loadAvailableVersions();
        me.show = !!!me.show;
    },

    async loadAvailableVersions() {
        const me = this;

        await axios.get('api/version/' + me.selectedMajor)
            .then(res => {
                me.apiReturnType = res.data.data.type;

                let temp = [];
                temp.push({ text: '', value: null, selected: true });

                res.data.data.attributes.map((version, index) => {
                    temp.push({ value: version, text: version});
                });

                me.versions = temp;
            })
            .catch(err => {
                me.toggle();

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
