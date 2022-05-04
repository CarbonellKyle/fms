<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="/about_us" target="_blank">{{ __('About Us') }}</a>
                    </li>
                    <li>
                        <a href="/developer" target="_blank">{{ __('Developer') }}</a>
                    </li>
                    <li>
                        <a href="/contact_us" target="_blank">{{ __('Contact Us') }}</a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(', made with ') }}<i class="fa fa-heart heart"></i>{{ __(' by ') }}<a class="@if(Auth::guest()) text-info @endif" href="/developer" target="_blank">{{ __('Kyle R. Carbonell') }}</a>{{ __(' for ') }}{{ __('Capstone Project') }}
                </span>
            </div>
        </div>
    </div>
</footer>