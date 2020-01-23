@section('plugins.navigation.topnav.brand')
    <a href="#"
       class="navbar-brand"
    >
        <img src="{{ asset('img/sw6-logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        {{ config('app.name') }}
    </a>
@show
