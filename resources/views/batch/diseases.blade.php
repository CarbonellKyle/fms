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
                                <a class="btn btn-primary text-light" href="{{ route('batch.index') }}">
                                    <i class="nc-icon nc-minimal-left text-light"></i> 
                                     Back
                                </a>
                            </div>
                            <div class="col-lg-5 offset-4">
                                <!-- Disease Added -->
                                @if(Session::has('disease_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('disease_added')}}</span>
                                </div>
                                @endif
                                <!-- Disease Deleted -->
                                @if(Session::has('disease_deleted'))
                                <div class="alert alert-danger alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('disease_deleted')}}</span>
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

                            <div class="row">
                                <div class="col-md-12" action="#">
                                    <h5 class="text-center">Batch Diseases</h5>
                                    <!--@csrf-->
                                    
                                    @foreach($batch_diseases as $batch_disease)
                                        <div class="row">
                                            <label class="col-md-1 col-form-label">{{ __('Disease Name') }}</label>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select name="disease_id" class="form-control select" required>
                                                        <option value="{{ $batch_disease->id }}" selected="selected" hidden>{{ $batch_disease->disease_name }}</option>
                                                        @foreach( $diseases as $disease )
                                                            <option value="{{ $disease->id }}">{{ $disease->disease_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('disease_id'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('disease_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <label class="col-md-1 col-form-label">{{ __('No. of Plants Affected') }}</label>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="number" name="noOfPlantsAffected" value="{{ $batch_disease->noOfPlantsAffected }}" class="form-control" placeholder="0" required>
                                                </div>
                                                @if ($errors->has('noOfPlantsAffected'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('noOfPlantsAffected') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <label class="col-md-1 col-form-label">{{ __('Status') }}</label>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select name="status" class="form-control select" required>
                                                        <option value="{{ $batch_disease->status }}" selected disabled hidden>{{ $batch_disease->status }}</option>
                                                        <option value="existing">existing</option>
                                                        <option value="cured">cured</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-1">
                                                <a href="/batch/deleteBatchDisease/{{$batch_disease->id}}" class="btn btn-danger btn-sm text-light"><i class="nc-icon nc-simple-remove"></i></a>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Add More Disease -->
                                    <form class="row" id="pdAdd" style="display:none" action="{{ route('batch.addBatchDisease') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="batch_id" value="{{$batch->id}}">
                                        <label class="col-md-1 col-form-label">{{ __('Disease Name') }}</label>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="disease_id" class="form-control select" required>
                                                    <option value="none" selected="selected" hidden>Select Disease --</option>
                                                    @foreach( $diseases as $disease )
                                                        <option value="{{ $disease->id }}">{{ $disease->disease_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('disease_id'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('disease_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <label class="col-md-1 col-form-label">{{ __('No. of Plants Affected') }}</label>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="number" name="noOfPlantsAffected" class="form-control" placeholder="0" required>
                                            </div>
                                            @if ($errors->has('noOfPlantsAffected'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('noOfPlantsAffected') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <label class="col-md-1 col-form-label">{{ __('Status') }}</label>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="status" class="form-control select" required>
                                                    <option value="none" selected disabled hidden>Select Status --</option>
                                                    <option value="existing">existing</option>
                                                    <option value="cured">cured</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-success btn-sm text-light"><i class="nc-icon nc-check-2"></i></button>
                                        </div>
                                    </form><!-- End -->

                                    <div class="row">
                                        <div class="col-md-1">
                                            <a id="pdAddBut" onclick="(pdAdd.style='display: visible', pdAddBut.style='display: none')" class="btn btn-success btn-sm text-light">+</a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-success btn-round">{{ __('Update Diseases') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
