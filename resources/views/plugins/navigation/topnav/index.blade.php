@section('plugins.navigation.topnav')
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark border-bottom border-primary">
        <div class="container">
            @include('plugins.navigation.topnav.brand')

            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse"
                 id="navbarSupportedContent"
            >

                {{-- Left Items --}}
                <ul class="navbar-nav pl-4 mr-auto">
                    @include('plugins.navigation.topnav.left_items')
                </ul>

                {{-- Right Items --}}
                <ul class="navbar-nav ml-auto">
                    @include('plugins.navigation.topnav.right_items')
                </ul>

            </div>
        </div>
    </nav>
@show
