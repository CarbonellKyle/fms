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
                        <div class="row">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('plants.add') }}">
                                    <i class="nc-icon nc-simple-add text-light"></i>
                                    <i class="nc-icon nc-atom text-light mr-2"></i>
                                    Add Plant
                                </a>
                            </div>
                            <div class="col-lg-6 offset-3">
                                <!-- Record Added -->
                                @if(Session::has('record_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('record_added')}}</span>
                                </div>
                                @endif
                                <!-- Record Deleted -->
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
                        @if(count($plants)==0)
                            <div class="alert alert-warning" role="alert">
                                    {{'No Plants Added Yet!'}}
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                        <th class="text-center">
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Variety
                                        </th>
                                        <th class="text-center">
                                            Plant Type
                                        </th>    
                                        <th class="text-center">
                                            Est. Months<br>to Harvest
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($plants as $plant)
                                        <tr>
                                            <td class="text-center">
                                                {{ $plant->plant_name }}<br><em style="opacity:0.5">{{ $plant->scientific_name }}</em>
                                            </td>
                                            <td class="text-center">
                                                {{ $plant->variety }}
                                            </td>
                                            <td class="text-center">
                                                {{ $plant->plant_type_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $plant->noOfMonthsHarvestable . ' months' }}
                                            </td>
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/plants/edit/{{$plant->id}}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    View
                                                </a>
                                                <a class="text-danger" href="/plants/delete/{{$plant->id}}">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $plants->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
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

