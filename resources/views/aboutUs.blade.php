@extends('layouts.info', [
    'class' => 'login-page'
])

@section('about_us')
    <section class="info_section" id="about">
        <div class="content col-md-12 ml-auto mr-auto">
            <div class="header py-5 pb-7 pt-lg-9">
                <div class="container col-md-10">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-12 pt-5">
                                <h1 class="text-white">{{ __('About Us') }}</h1>
                                
                                <p class="text-white text-lead mb-0" style="margin-top:320px">
                                    {{ __('Urbanozo\'s Farm is located at Barangay Dologon, Maramag, Bukidnon. Owned and managed by Mr. Amor Urbanozo and Family. We aim to produce high quality and organic crops with hardwork and patience.') }}
                                </p>

                                <div class="row mt-3">
                                    <div class="col"><i class="nc-icon nc-favourite-28 text-white"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <!-- <section class="info_section" id="about_features">
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
            <div class="card container pb-5" style="margin-top:-50px;" id="feature_card">
                <div class="container">
                    <h5 style="margin-top: -30px; opacity:0.4">{{ __('Farm') }}</h5>
                    <h3 style="margin-top: -30px; opacity:0.4"><strong>{{ __('Features') }}</strong></h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="card card-stats feature-card-sm">
                                <div class="card-body ">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="card card-stats feature-card-sm">
                                <div class="card-body ">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="card card-stats feature-card-sm">
                                <div class="card-body ">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="card card-stats feature-card-sm">
                                <div class="card-body ">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
