@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'batch'
])

@section('content')
    <div class="content">
        <!-- Heading -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-3">
                                <h4 class="card-title"> Batch  <i class="icon-big nc-icon nc-chart-pie-36 text-info" style="opacity: 0.4"></i></h4> 
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('batch.index') }}" <?php if(isset($inactive)){ ?> disabled <?php } ?> >
                                    <i class="nc-icon nc-minimal-left text-light"></i> 
                                     Back
                                </a>
                            </div>
                            <div class="col-lg-5 offset-4">
                                @if(Session::has('record_deleted'))
                                <div class="alert alert-danger alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('record_deleted')}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <h5 class="text-center">Batch No. {{$batch->id}}</h5>
                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <p><strong>Plant: </strong>{{ $batch->plant_name }}</p>
                                    <p><strong>Current Stage: </strong>{{ $batch->currentStage }}</p>
                                </div>

                                <div class="col-md-4">
                                    <a href="/batch/progress/{{$batch->id}}" class="btn btn-success btn-sm">
                                        Progress
                                    </a>
                                    <a href="/batch/activities/{{$batch->id}}" class="btn btn-warning btn-sm">
                                        Activities
                                    </a>
                                    <a href="/batch/diseases/{{$batch->id}}" class="btn btn-danger btn-sm">
                                        Diseases
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
