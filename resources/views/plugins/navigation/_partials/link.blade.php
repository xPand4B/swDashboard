@if (isset($name))
    <a class="{{ isset($class) ? $class : 'nav-link' }} px-3"
       style="cursor: pointer"
       {{ isset($link) ? 'href="'.$link.'"' : null }}"
       {!! isset($attributes) ? $attributes : null !!}
    >
        @if (isset($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {!! $name !!}
    </a>
@endif
