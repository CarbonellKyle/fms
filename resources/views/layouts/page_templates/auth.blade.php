<div class="wrapper">

    @include('layouts.navbars.auth') <!-- Sidenav for auth users -->

    <div class="main-panel">
        @include('layouts.navbars.navs.auth') <!-- Top navbar for auth users -->
        @yield('content')
        @include('layouts.footer')
    </div>
</div>