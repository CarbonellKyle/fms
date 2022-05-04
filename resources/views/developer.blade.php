@extends('layouts.info', [
    'class' => 'login-page'
])

@section('developer')
    <section class="info_section" id="developer">
        <div class="content col-md-12 ml-auto mr-auto">
            <div class="header py-5 pb-7 pt-lg-9">
                <div class="container col-md-10">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card container pb-5" style="margin-top:-50px;" id="dev_card">
                <div class="container">
                    <h5 style="margin-top: -30px; opacity:0.4">{{ __('The') }}</h5>
                    <h3 style="margin-top: -30px; opacity:0.4"><strong>{{ __('Developer') }}</strong></h3>
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="float-right">Hey there!</h2><br>
                            <div class="container ml-5">
                                <h3>Hi, I'm <strong>Kyle Carbonell</strong></h3>
                                <h5>I am a 4th Year BS in Information Technology Student at Central Mindanao University</h5>
                                <!-- <div class="float-right mr-5 mt-5">
                                    <a>
                                        <i class="icon-big nc-icon nc-money-coins text-info"></i>
                                    </a>
                                    <a>
                                        <i class="icon-big nc-icon nc-money-coins text-info"></i>
                                    </a>
                                    <a>
                                        <i class="icon-big nc-icon nc-money-coins text-info"></i>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <img id="dev_pic" src="{{ asset('paper/img/developer.png') }}" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
