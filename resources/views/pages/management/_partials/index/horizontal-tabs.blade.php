@if (isset($versions) && isset($major))
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach($versions as $key => $path)
                @php
                    $dirName = explode(DIRECTORY_SEPARATOR, $path);
                    $dirName = $dirName[sizeof($dirName ) - 1];
                @endphp
                <a class="nav-item nav-link {{ $key == 0 ? 'active' : '' }}"
                   id="nav-{{ str_replace('.', '-', $major) }}-{{ $key }}-tab"
                   data-toggle="tab"
                   href="#nav-{{ str_replace('.', '-', $major) }}-{{ $key }}"
                   role="tab"
                   aria-controls="nav-{{ str_replace('.', '-', $major) }}-{{ $key }}"
                   aria-selected="{{ $key == 0 ? 'true' : 'false' }}"
                >{{ $dirName }}</a>
            @endforeach
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        @foreach($versions as $key => $path)
            @php
                $dirName = explode(DIRECTORY_SEPARATOR, $path);
                $dirName = $dirName[sizeof($dirName ) - 1];
            @endphp
            <div class="tab-pane mt-4 {{ $key == 0 ? 'show active' : '' }}"
                 id="nav-{{ str_replace('.', '-', $major) }}-{{ $key }}"
                 role="tabpanel"
                 aria-labelledby="nav-{{ str_replace('.', '-', $major) }}-{{ $key }}-tab"
            >
                <div class="row">
                    <div class="col-md-9">
                        <dl class="row">
                            <dt class="col-sm-2">@lang('pages.management.index.meta.major')</dt>
                            <dd class="col-sm-10">{{ $major }}</dd>

                            <dt class="col-sm-2">@lang('pages.management.index.meta.directory')</dt>
                            <dd class="col-sm-10">{{ $dirName }}</dd>
                        </dl>
                    </div>

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md">
                                <button class="btn btn-sm btn-outline-danger btn-block">
                                    @lang('pages.management.index.buttons.delete')
                                </button>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md">
                                <button class="btn btn-sm btn-outline-success btn-block">
                                    @lang('pages.management.index.buttons.reinstall')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <dl class="row mt-2">
                    <dt class="col-sm-1">@lang('pages.management.index.meta.path')</dt>
                    <dd class="col-sm-11">{{ $path }}</dd>
                </dl>

                <div class="row">
                    <div class="col-md-6">
                        <a href="#"
                           class="btn btn-outline-primary btn-block btn-lg btn-rounded"
                        >{{ $major == '6.x' ? trans('pages.management.index.buttons.storefront') : trans('pages.management.index.buttons.frontend') }}</a>
                    </div>

                    <div class="col-md-6">
                        <a href="#"
                           class="btn btn-outline-secondary btn-block btn-lg btn-rounded"
                        >{{ $major == '6.x' ? trans('pages.management.index.buttons.admin') : trans('pages.management.index.buttons.backend') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
