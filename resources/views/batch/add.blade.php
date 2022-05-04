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
                            <div class="col-lg-9">
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
                        <div class="container text-center">
                            <h5>Add Batch</h5>
                            <form class="col-md-12" action="{{ route('batch.addSubmit') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ __('Plant') }}</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="plant_id" class="form-control select" required>
                                                <option value="none" selected disabled hidden>Select Plant --</option>
                                                @foreach( $plants as $plant )
                                                    <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('plant_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('plant_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <label class="col-md-2 col-form-label">{{ __('Start of Farm') }}</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" name="startOfFarm" class="form-control" required>
                                        </div>
                                        @if ($errors->has('startOfFarm'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('startOfFarm') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ __('Quantity') }}</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                                        </div>
                                        @if ($errors->has('quantity'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('quantity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <label class="col-md-2 col-form-label">{{ __('Measurement') }}</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="measurement" class="form-control" placeholder="Measurement" required>
                                        </div>
                                        @if ($errors->has('measurement'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('measurement') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label">{{ __('Expected Harvest Period') }}</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" name="expectedHarvestPeriodFrom" class="form-control" required>
                                        </div>
                                        @if ($errors->has('expectedHarvestPeriodFrom'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('expectedHarvestPeriodFrom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <label class="col-md-2 col-form-label">{{ __('To') }}</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" name="expectedHarvestPeriodTo" class="form-control" required>
                                        </div>
                                        @if ($errors->has('expectedHarvestPeriodTo'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('expectedHarvestPeriodTo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-round">{{ __('Add Batch') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
