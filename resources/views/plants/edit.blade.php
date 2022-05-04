@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'plants'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Plants</h4>
                        <a class="btn btn-primary text-light" href="{{ route('plants.index') }}">
                            <i class="nc-icon nc-minimal-left text-light"></i>
                            Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="container text-center">
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
                            <h5>Plant Info</h5>
                            <form class="col-md-12" action="#" method="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $plant->id }}">
                                
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="plant_name" class="form-control" value="{{ $plant->plant_name }}" placeholder="Plant Name" required>
                                        </div>
                                        @if ($errors->has('plant_name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('plant_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Scientific Name') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="scientific_name" class="form-control" value="{{ $plant->scientific_name }}" placeholder="Scientific Name">
                                        </div>
                                        @if ($errors->has('scientific_name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('scientific_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Category') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="category_id" class="form-control select" required>
                                                <option value="{{ $plant->category_id }}" selected="selected" hidden>{{ $plant->plant_category_name }}</option>
                                                @foreach( $plant_categories as $plant_category )
                                                    <option value="{{ $plant_category->id }}">{{ $plant_category->plant_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Plant Type') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="type_id" class="form-control select" required>
                                                <option value="{{ $plant->type_id }}" selected="selected" hidden>{{ $plant->plant_type_name }}</option>
                                                @foreach( $plant_types as $plant_type )
                                                    <option value="{{ $plant_type->id }}">{{ $plant_type->plant_type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('type_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('type_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Variety') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="variety" class="form-control" value="{{ $plant->variety }}" placeholder="Variety">
                                        </div>
                                        @if ($errors->has('variety'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('variety') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('No. of Month Harvestable') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" name="noOfMonthsHarvestable" class="form-control" value="{{ $plant->noOfMonthsHarvestable }}" placeholder="No. of Month Harvestable" required>
                                        </div>
                                        @if ($errors->has('noOfMonthsHarvestable'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('noOfMonthsHarvestable') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="description" class="form-control" value="{{ $plant->description }}" placeholder="Description">
                                        </div>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-round">{{ __('Update Plant') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilities -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Utilities<h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('utilities') }}" class="btn btn-warning btn-sm text-light" style="margin-top: -10px">Soil Type</a>
                        <a href="{{ route('utilities') }}" class="btn btn-success btn-sm text-light" style="margin-top: -5px">Plant Categories</a>
                        <a href="{{ route('utilities') }}" class="btn btn-success btn-sm text-light" style="margin-top: -5px">Plant Types</a>
                        <a href="{{ route('utilities') }}" class="btn btn-danger btn-sm text-light" style="margin-top: -5px">Plant Diseases</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

