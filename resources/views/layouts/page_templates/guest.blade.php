@include('layouts.navbars.navs.guest') <!-- Welcome page navbar: Contains login/register/guestmode -->

<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/bg/farm.jpg") }}">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
