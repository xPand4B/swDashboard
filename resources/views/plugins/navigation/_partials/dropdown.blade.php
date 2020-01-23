<li class="nav-item dropdown">
    <a href="#"
       class="nav-link dropdown-toggle"
       id="navbarDropdown"
       role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
    >
        @if (isset($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {!! isset($name) ? $name : '<del>Name not set</del>' !!}
    </a>

    @if (isset($items))
        <div class="dropdown-menu"
             aria-labelledby="navbarDropdown"
        >
            @foreach($items as $item)
                @if (empty($item))
                    <div class="dropdown-divider"></div>
                @else
                    @include('plugins.navigation._partials.link', [
                        'name' => isset($item['name']) ? $item['name'] : 'Missing name',
                        'link' => isset($item['link']) ? $item['link'] : '#',
                        'icon' => isset($item['icon']) ? $item['icon'] : '',
                        'class' => 'dropdown-item'
                    ])
                @endif
            @endforeach
        </div>
    @endif
</li>
