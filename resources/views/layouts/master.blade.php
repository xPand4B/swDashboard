<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_partials.master.head')
</head>
<body>
    @include('_partials.master.javascript')

    @section('master.navigation.topnav')
        @include('plugins.topnav')
    @show

    <div class="container">
        @section('master.content')
        @show
    </div>

</body>
</html>
