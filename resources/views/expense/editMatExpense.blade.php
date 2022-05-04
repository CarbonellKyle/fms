@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'materials'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Purchase Expenses  <i class="icon-big nc-icon nc-cart-simple text-info" style="opacity: 0.4"></i></h4>
                    <a class="btn btn-primary text-light" href="{{ route('expense.materials') }}">
                        <i class="nc-icon nc-minimal-left text-light"></i>
                        Back
                    </a>
                </div>

                <form class="col-md-12" action="{{ route('expense.updateMatExpense') }}"
                    oninput="t.value=parseFloat(p.value)*parseFloat(q.value)"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $expense->material_expense_id }}" />

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
                        <h5 class="title text-center">{{ __('Material Purchase Info') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Purchased Material') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Purchased Material Name" value="{{ $expense->name }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Quantity') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="q" name="quantity" class="form-control" placeholder="Quantity" value="{{ $expense->quantity }}" required>
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
                                    <input type="text" name="unit" class="form-control" placeholder="Unit" value="{{ $expense->unit }}" >
                                </div>
                                @if ($errors->has('unit'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Price per unit') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="p" name="price_per_unit" class="form-control" placeholder="How much each" value="{{ $expense->price_per_unit }}" required>
                                </div>
                                @if ($errors->has('price_per_unit'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('price_per_unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Total Cost') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" id="t" for="p q" name="cost" class="form-control" placeholder="Total cost of purchase" value="{{ $expense->cost }}" required>
                                </div>
                                @if ($errors->has('cost'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('cost') }}</strong>
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