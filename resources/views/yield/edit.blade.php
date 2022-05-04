@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'yields'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Harvest  <i class="icon-big nc-icon nc-shop text-info" style="opacity: 0.4"></i></h4>
                    <a class="btn btn-primary text-light" href="{{ route('yield.index') }}">
                        <i class="nc-icon nc-minimal-left text-light"></i>
                        Back
                    </a>
                </div>

                <form class="col-md-12" action="{{ route('yield.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $yield->yield_id }}" />

                    @if(Session::has('record_updated'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                {{Session::get('record_updated')}}
                            </span>
                        </div>
                    @endif
                    
                    <div class="card-header">
                        <h5 class="title text-center">{{ __('Harvest Record Info') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Quantity') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="quantity" class="form-control" placeholder="How many sacks" value="{{ $yield->quantity }}" required>
                                </div>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Date') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success btn-round">{{ __('Update Info') }}</button>
                            </div>
                        </div>
                    </div>
            </form>
            </div>
        </div>

    </div>
@endsection