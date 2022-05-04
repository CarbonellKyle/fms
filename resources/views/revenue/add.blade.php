@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'revenue'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Sales  <i class="icon-big nc-icon nc-money-coins text-info" style="opacity: 0.4"></i></h4>
                    <a class="btn btn-primary text-light" href="{{ route('revenue.index') }}">
                        <i class="nc-icon nc-minimal-left text-light"></i>
                        Back
                    </a>
                </div>

                <form class="col-md-12" action="{{ route('revenue.addSubmit') }}" method="POST"
                    oninput="t.value=parseFloat(p.value)*parseFloat(q.value)*parseInt(k.value)" >
                    @csrf
                    <input type="hidden" name="season_id" value="{{ $season_id }}" />

                    @if(Session::has('record_added'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                {{Session::get('record_added')}}
                            </span>
                        </div>
                    @endif
                    
                    <div class="card-header">
                        <h5 class="title text-center">{{ __('Record Sale') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Quantity') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="q" name="quantity" class="form-control" placeholder="How many have you sold" required>
                                </div>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Unit') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="unit" class="form-control" placeholder="Unit (ex: Sack, Cavan)" required>
                                </div>
                                @if ($errors->has('unit'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Kilo per unit') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="number" id="k" name="kilo_per_unit" class="form-control" placeholder="How many kilos in 1 unit" required>
                                </div>
                                @if ($errors->has('kilo_per_unit'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('kilo_per_unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Price per kilo') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="p" name="price_per_kilo" class="form-control" placeholder="How much per 1 kilo" required>
                                </div>
                                @if ($errors->has('price_per_kilo'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('price_per_kilo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Total Price') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="t" for="p q k" name="total_price" class="form-control" placeholder="Total Price" required>
                                </div>
                                @if ($errors->has('total_price'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('total_price') }}</strong>
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
                                <button type="submit" class="btn btn-success btn-round">{{ __('Record Sale') }}</button>
                            </div>
                        </div>
                    </div>
            </form>
            </div>
        </div>

    </div>
@endsection