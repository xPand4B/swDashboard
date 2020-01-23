@section('plugins.navigation.topnav.left_items')
    @include('plugins.navigation._partials.link', [
        'name' => 'Sample Link (L)',
        'link' => '#',
        'icon' => 'fas fa-home'
    ])

    @include('plugins.navigation._partials.dropdown', [
        'name' => 'Sample Dropdown (L)',

        'items' => [
            [ 'name' => 'Google', 'link' => 'https://google.com', 'icon' => 'fab fa-google' ],
        ]
    ])
@show
