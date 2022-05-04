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
                                @if(Session::has('progress_updated'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('progress_updated')}}</span>
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
                                <form class="col-md-10 offset-1" action="{{route('batch.updateBatchProgress')}}" method="POST">
                                    <h5 class="text-center">Progress Update</h5>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$batch->id}}">
                                    
                                    <div class="row">
                                        <label class="col-md-2 col-form-label">{{ __('Current Stage') }}</label>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="currentStage" value="{{$batch->currentStage}}" class="form-control" placeholder="e.g. Flower, Small Tree">
                                            </div>
                                            @if ($errors->has('currentStage'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('currentStage') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <label class="col-md-2 col-form-label">{{ __('Price') }}</label>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="number" name="price" value="{{$batch->price}}" class="form-control" placeholder="Price in Peso">
                                            </div>
                                            @if ($errors->has('price'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 col-form-label">{{ __('Remarks') }}</label>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="remarks" value="{{$batch->remarks}}" class="form-control" placeholder="Remarks">
                                            </div>
                                            @if ($errors->has('remarks'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('remarks') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <label class="col-md-2 col-form-label">{{ __('Quantity Loss') }}</label>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="number" name="quantityLoss" value="{{$batch->quantityLoss}}" class="form-control" placeholder="0" required>
                                            </div>
                                            @if ($errors->has('quantityLoss'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('quantityLoss') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-success btn-round">{{ __('Update Batch Info') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
