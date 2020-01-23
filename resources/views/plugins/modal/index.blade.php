@section('plugin.modal.index')
    <div class="modal fade"
         id="exampleModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true"
    >
        <div class="modal-dialog"
             role="document"
        >
            <div class="modal-content">

                <div class="modal-header">
                    @include('plugins.modal.header')
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @include('plugins.modal.body')
                </div>

                @include('plugins.modal.footer')
            </div>
        </div>
    </div>
@show
