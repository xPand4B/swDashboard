@if (isset($swDirectories))
    <div class="col-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @foreach($swDirectories as $major => $versions)
                <a class="nav-link h5 text-center {{ $major == $defaultMajorVersion ? 'active' : '' }}"
                   id="v-pills-{{ str_replace('.', '-', $major) }}-tab"
                   data-toggle="pill"
                   href="#v-pills-{{ str_replace('.', '-', $major) }}"
                   role="tab"
                   aria-controls="v-pills-{{ str_replace('.', '-', $major) }}"
                   aria-selected="{{ $major == $defaultMajorVersion ? 'true' : 'false' }}"
                >{{ $major }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-10 p-0">
        <div class="tab-content" id="v-pills-tabContent">
            @foreach($swDirectories as $major => $versions)
                <div class="tab-pane fade {{ $major == $defaultMajorVersion ? 'show active' : '' }}"
                     id="v-pills-{{ str_replace('.', '-', $major) }}"
                     role="tabpanel"
                     aria-labelledby="v-pills-{{ str_replace('.', '-', $major) }}-tab"
                >
                    @if (empty($versions))
                        @include('pages.management._partials.index.empty')
                    @else
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{ asset($major == '6.x' ? 'img/sw6-logo.png' : 'img/sw5-logo.png' ) }}"
                                     width="64"
                                     height="64"
                                     class="d-inline-block align-top"
                                >
                            </div>
                            <div class="col-md-11">
                                @include('pages.management._partials.index.horizontal-tabs')
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
