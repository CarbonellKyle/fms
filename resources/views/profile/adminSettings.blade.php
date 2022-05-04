@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <a class="btn btn-primary text-light mb-4" href="{{ route('profile.edit') }}">
            <i class="nc-icon nc-minimal-left text-light"></i>
                Back
        </a>

        <div class="row">
            <form class="col-md-7 text-center" action="{{ route('farmcode.update') }}" method="POST" enctype="multipart/form-data">

                @if(Session::has('updated'))
                    <div class="alert alert-success text-left alert-dismissible fade show">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                            aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        <span>
                            {{Session::get('updated')}}
                        </span>
                    </div>
                @endif

                @if(Session::has('wrong_pass'))
                    <div class="alert alert-danger text-left alert-dismissible fade show">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                            aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        <span>
                            {{Session::get('wrong_pass')}}
                        </span>
                    </div>
                @endif

                @csrf
                @method('PUT')
                <div class="card pb-2">
                    <div class="card-header">
                        <h5 class="title">{{ __('Edit Farmcode') }}</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $farmcode->appdata_id }}"/>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Farmcode') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="farmcode" class="form-control" placeholder="Farmcode" value="{{ $farmcode->value }}" required>
                                </div>
                                @if ($errors->has('farmcode'))                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('farmcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Admin Password') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">    
                            <a class="btn btn-round btn-primary" href="#">
                                <i class="nc-icon nc-simple-add text-light"></i>
                                <i class="nc-icon nc-single-02 text-light mr-2"></i>
                                <strong>Add User</strong>
                            </a>
                            <a class="btn btn-round btn-warning" href="/laratrust">
                                <i class="icon-big nc-icon nc-single-02 text-light"></i>
                                <strong>Manage Users</strong>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection