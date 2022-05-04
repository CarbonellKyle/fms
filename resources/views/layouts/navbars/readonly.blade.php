<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/wheat.png">
            </div>
        </a>
        <a class="simple-text logo-normal">
            {{ __('Farm Finance') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'currentSeason' ? 'active' : '' }}">
                <a href="{{ route('guest.currentSeason') }}">
                    <i class="nc-icon nc-calendar-60"></i>
                    <p>{{ __('Current Season') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'history' ? 'active' : '' }}">
                <a href="{{ route('guest.history') }}">
                    <i class="nc-icon nc-watch-time"></i>
                    <p>{{ __('History') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'progress' ? 'active' : '' }}">
                <a href="{{ route('guest.progress') }}">
                    <i class="nc-icon nc-sound-wave"></i>
                    <p>{{ __('Progress') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
