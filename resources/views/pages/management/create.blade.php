@extends('plugins.modal')

@section('plugins.modal.header.text')
    @lang('pages.management.create.headline')
@endsection

@section('plugins.modal.body')
    <form onsubmit="Submit(this)">
        <div class="container">
            <div class="form-group">
                <label for="swVersion">
                    @lang('pages.management.create.form.version')
                </label>
                <select name="swVersion"
                        id="swVersion"
                        class="form-control"
                        onchange="SetDefaultDirectory(this)"
                        required
                >
                    <option value="">@lang('pages.management.create.form.placeholder')</option>
                    @if (isset($swVersions))
                        @foreach($swVersions as $version)
                            <option value="{{ $version }}">
                                {{ $version }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="swDirectory">
                    @lang('pages.management.create.form.directory')
                </label>
                <input type="text"
                       name="swDirectory"
                       id="swDirectory"
                       class="form-control"
                       minlength="3"
                       maxlength="32"
                       placeholder="{{ trans('pages.management.create.form.placeholder') }}"
                       required
                >
            </div>
        </div>
        <hr>

        <button class="btn btn-primary btn-block btn-submit">
            <i class="fas fa-folder-plus"></i>
            @lang('pages.management.create.create')
        </button>
    </form>
@endsection

@section('plugins.modal.footer')
@endsection

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function Submit(e)
    {
        event.preventDefault();

        let swDirectory = document.getElementById('swDirectory').value;
        let swVersion = document.getElementById('swVersion');
        swVersion = swVersion.options[swVersion.selectedIndex].value;

        axios.post("{{ route('shop.store') }}", {
            swDirectory: swDirectory,
            swVersion2: swVersion,
        })
        .then(res => {
            if (res.status === 200) {
                $('#exampleModal').modal('hide');
                console.log(res.data);
                Toast.fire({
                    title: "Downloading...",
                    icon: "info",
                    timer: 2000,
                })
                .then((result) => {
                    Toast.fire({
                        title: "Download finished!",
                        icon: "success",
                    })
                })
            }
        })
        .catch(err => {
            console.log(err);
            Swal.fire({
                type: 'error',
                title: "Something went wrong ",
                text: '¯\\_(ツ)_/¯'
            });
        })
    }

    function SetDefaultDirectory(e)
    {
        let selectedValue = e.options[e.selectedIndex].value;
        let directoryInput = document.getElementById('swDirectory');

        directoryInput.value = selectedValue;
    }
</script>
