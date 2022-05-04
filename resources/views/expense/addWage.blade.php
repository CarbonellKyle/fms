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

                <form class="col-md-12" action="{{ route('expense.addWageSubmit') }}" method="POST">
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
                        <h5 class="title text-center">{{ __('Record Wage Payment') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Laborer') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="laborer_id" class="form-control select" required>
                                        <option value="none" selected disabled hidden>Select Laborer --</option>
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
                                    <input type="text" name="task" class="form-control" placeholder="Task">
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
                                    <input type="text" name="wage" class="form-control" placeholder="Amount in Pesos" required>
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
                                <button type="submit" class="btn btn-success btn-round">{{ __('Record Payment') }}</button>
                            </div>
                        </div>
                    </div>
            </form>
            </div>
        </div>

    </div>
@endsection