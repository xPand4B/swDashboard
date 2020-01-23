@extends('plugins.navigation.topnav.index')

@section('plugins.navigation.topnav.left_items')
@endsection

@section('plugins.navigation.topnav.right_items')
    @include('plugins.navigation._partials.link', [
        'name' => trans('navigation.topnav.add_new'),
        'icon' => 'fas fa-folder-plus',
        'attributes' => 'data-toggle="modal" data-target="#exampleModal"',
    ])

    @include('plugins.navigation._partials.dropdown', [
        'name' => 'Version',
        'icon' => 'fab fa-php',

        'items' => [
            [ 'name' => '7.4', 'link' => '#' ],
            [ 'name' => '7.3', 'link' => '#' ],
            [ 'name' => '7.2', 'link' => '#' ],
            [ 'name' => '7.0', 'link' => '#' ],
            [],
            [ 'name' => '5.6', 'link' => '#' ],
        ]
    ])
@endsection

@include('pages.management.create')
