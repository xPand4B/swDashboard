@section('plugins.navigation.topnav.right_items')
    @include('plugins.navigation._partials.link', [
        'name' => 'Sample Link (R)',
        'link' => '#',
    ])

    @include('plugins.navigation._partials.dropdown', [
        'name' => 'Sample Dropdown (R)',

        'items' => [
            [ 'name' => 'Google', 'link' => 'https://google.com', 'icon' => 'fab fa-google' ],
        ]
    ])
@show
