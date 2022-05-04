<div class="wrapper">

    @include('layouts.navbars.readonly') <!-- Sidenav for guest mode -->

    <div class="main-panel">
        @include('layouts.navbars.navs.readonly') <!-- Top navbar for guest mode -->
        @yield('content')
        @include('layouts.footer')
    </div>
</div>