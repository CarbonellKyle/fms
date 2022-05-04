@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'labor'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header ">
                    <h4 class="card-title"> Laborers  <i class="icon-big nc-icon nc-single-02 text-info" style="opacity: 0.4"></i></h4>
                    <a class="btn btn-primary text-light" href="{{ route('labor.index') }}">
                        <i class="nc-icon nc-minimal-left text-light"></i>
                        Back
                    </a>
                </div>

                <form class="col-md-12" action="{{ route('labor.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $laborer->laborer_id }}" />

                    @if(Session::has('laborer_updated'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                {{Session::get('laborer_updated')}}
                            </span>
                        </div>
                    @endif
                    
                    <div class="card-header">
                        <h5 class="title text-center">{{ __('Laborer Info') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $laborer->name }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Address') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $laborer->address }}" required>
                                </div>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
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