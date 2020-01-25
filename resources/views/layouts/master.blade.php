<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_partials.master.head')
    <title>{{ config('app.name') }}</title>
</head>
<body>
    @section('master.content')
        <div id="app">
            @section('master.content.app')
                <App></App>
            @show
        </div>
    @show

    @include('_partials.master.javascript')
</body>
</html>
