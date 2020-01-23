<meta charset="utf-8" />

<meta name="author" content="Eric Heinzl">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport" />

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- CSS -->
@section('master.stylesheet')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
@show

<title>
    {{ config('app.name') }}

    @hasSection ('master.title')
        | @yield('master.title')
    @endif
</title>
