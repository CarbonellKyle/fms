@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'plants'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Utilities</h4>
                        <div class="row">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('plants.index') }}">
                                    <i class="nc-icon nc-minimal-left text-light"></i>
                                    Back
                                </a>
                            </div>
                            <div class="col-lg-5 offset-4">
                                <!-- Soil Type Added -->
                                @if(Session::has('soil_type_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('soil_type_added')}}</span>
                                </div>
                                @endif
                                <!-- Soil Type Deleted -->
                                @if(Session::has('soil_type_deleted'))
                                <div class="alert alert-danger alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('soil_type_deleted')}}</span>
                                </div>
                                @endif
                                <!-- Plant Category Added -->
                                @if(Session::has('plant_category_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('plant_category_added')}}</span>
                                </div>
                                @endif
                                <!-- Plant Category Deleted -->
                                @if(Session::has('plant_category_deleted'))
                                <div class="alert alert-danger alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('plant_category_deleted')}}</span>
                                </div>
                                @endif
                                <!-- Plant Type Added -->
                                @if(Session::has('plant_type_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('plant_type_added')}}</span>
                                </div>
                                @endif
                                <!-- Plant Type Deleted -->
                                @if(Session::has('plant_type_deleted'))
                                <div class="alert alert-danger alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('plant_type_deleted')}}</span>
                                </div>
                                @endif
                                <!-- Disease Added -->
                                @if(Session::has('disease_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('disease_added')}}</span>
                                </div>
                                @endif
                                <!-- Disease Deleted -->
                                @if(Session::has('disease_deleted'))
                                <div class="alert alert-danger alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('disease_deleted')}}</span>
                                </div>
                                @endif
        
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Soil Types</h4>
                    </div>
                    <div class="card-body">
                        @if(!empty($soil_types))
                            @foreach($soil_types as $soil_type)
                            <ul style="margin-top:-15px">
                                <li>{{$soil_type->soil_type_name}}
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="{{ $soil_type->description }}"></i>
                                    <a href="/utilities/deleteSoilType/{{$soil_type->id}}"><i class="nc-icon nc-simple-remove text-danger" style="cursor: pointer" title="Delete"></i></a>
                                </li>
                            </ul>
                            @endforeach
                        @endif
                        <a id="stAddBut" onclick="(stAdd.style='display: inline-block', stAddBut.style='display: none')" class="btn btn-success btn-sm text-light">+</a>
                        <form action="{{ route('addSoilType') }}" method="POST" id="stAdd" style="display: none">
                            @csrf
                            <input type="text" name="soil_type_name" class="form-control" placeholder="Name" />
                            <input type="text" name="description" class="form-control" placeholder="Description" />
                            <button type="submit" class="btn btn-primary btn-sm text-light" style="margin-top: 1px">Add</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Plant Categories</h4>
                    </div>
                    <div class="card-body">
                        @if(!empty($plant_categories))
                            @foreach($plant_categories as $plant_category)
                            <ul style="margin-top:-15px">
                                <li>{{$plant_category->plant_category_name}}
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="{{ $plant_category->description }}"></i>
                                    <a href="/utilities/deletePlantCategory/{{$plant_category->id}}"><i class="nc-icon nc-simple-remove text-danger" style="cursor: pointer" title="Delete"></i></a>
                                </li>
                            </ul>
                            @endforeach
                        @endif
                        <a id="pcAddBut" onclick="(pcAdd.style='display: inline-block', pcAddBut.style='display: none')" class="btn btn-success btn-sm text-light">+</a>
                        <form action="{{ route('addPlantCategory') }}" method="POST" id="pcAdd" style="display: none">
                            @csrf
                            <input type="text" name="plant_category_name" class="form-control" placeholder="Name" />
                            <input type="text" name="description" class="form-control" placeholder="Description" />
                            <button type="submit" class="btn btn-primary btn-sm text-light" style="margin-top: 1px">Add</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Plant Types</h4>
                    </div>
                    <div class="card-body">
                        @if(!empty($plant_types))
                            @foreach($plant_types as $plant_type)
                            <ul style="margin-top:-15px">
                                <li>{{$plant_type->plant_type_name}}
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="{{ $plant_type->description }}"></i>
                                    <a href="/utilities/deletePlantType/{{$plant_type->id}}"><i class="nc-icon nc-simple-remove text-danger" style="cursor: pointer" title="Delete"></i></a>
                                </li>
                            </ul>
                            @endforeach
                        @endif
                        <a id="ptAddBut" onclick="(ptAdd.style='display: inline-block', ptAddBut.style='display: none')" class="btn btn-success btn-sm text-light">+</a>
                        <form action="{{ route('addPlantType') }}" method="POST" id="ptAdd" style="display: none">
                            @csrf
                            <input type="text" name="plant_type_name" class="form-control" placeholder="Name" />
                            <input type="text" name="description" class="form-control" placeholder="Description" />
                            <button type="submit" class="btn btn-primary btn-sm text-light" style="margin-top: 1px">Add</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Plant Diseases</h4>
                    </div>
                    <div class="card-body">
                        @if(!empty($diseases))
                            @foreach($diseases as $disease)
                            <ul style="margin-top:-15px">
                                <li>{{$disease->disease_name}}
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="{{ $disease->description }}"></i>
                                    <a href="/utilities/deleteDisease/{{$disease->id}}"><i class="nc-icon nc-simple-remove text-danger" style="cursor: pointer" title="Delete"></i></a>
                                </li>
                            </ul>
                            @endforeach
                        @endif
                        <a id="pdAddBut" onclick="(pdAdd.style='display: inline-block', pdAddBut.style='display: none')" class="btn btn-success btn-sm text-light">+</a>
                        <form action="{{ route('addDisease') }}" method="POST" id="pdAdd" style="display: none">
                            @csrf
                            <input type="text" name="disease_name" class="form-control" placeholder="Name" />
                            <input type="text" name="description" class="form-control" placeholder="Description" />
                            <button type="submit" class="btn btn-primary btn-sm text-light" style="margin-top: 1px">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

