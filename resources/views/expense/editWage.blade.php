@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'laborwage'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Wage Expenses  <i class="icon-big nc-icon nc-money-coins text-info" style="opacity: 0.4"></i></h4>
                    <a class="btn btn-primary text-light" href="{{ route('expense.laborwage') }}">
                        <i class="nc-icon nc-minimal-left text-light"></i>
                        Back
                    </a>
                </div>

                <form class="col-md-12" action="{{ route('expense.updateWage') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $wage->labor_wage_id }}" />

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
                        <h5 class="title text-center">{{ __('Wage Payment Info') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Laborer') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="laborer_id" class="form-control select" required>
                                        <option value="{{ $wage->laborer_id }}" selected="selected" hidden>{{ $wage->name }}</option>
                                        @foreach( $laborers as $laborer )
                                            <option value="{{ $laborer->laborer_id }}">{{ $laborer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('laborer_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('laborer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Task') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="task" class="form-control" placeholder="Task" value="{{ $wage->task }}">
                                </div>
                                @if ($errors->has('task'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('task') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Wage Amount') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="wage" class="form-control" placeholder="Amount in Pesos" value="{{ $wage->wage }}" required>
                                </div>
                                @if ($errors->has('wage'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('wage') }}</strong>
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