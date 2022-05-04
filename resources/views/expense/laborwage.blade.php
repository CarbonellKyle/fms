@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'laborwage'
])

@section('content')
    <div class="content">
        <!-- Heading -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-9">
                                <h4 class="card-title"> Wage Expenses  <i class="icon-big nc-icon nc-money-coins text-info" style="opacity: 0.4"></i></h4>
                            </div>
                            <div class="col-lg-3">
                                @if(!isset($inactive))
                                <span><strong style="opacity: 0.5">Total Wage: </strong><span class="btn btn-sm btn-info" style="opacity: 0.7"> {{ round($total,2) }} </span></span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('expense.addWage') }}" <?php if(isset($inactive)){ ?> disabled <?php } ?> >
                                    <i class="nc-icon nc-money-coins text-light"></i>
                                    <i class="nc-icon nc-single-02 text-light mr-2"></i>
                                    Record Payment
                                </a>
                            </div>
                            <div class="col-lg-5">
                                @if(isset($inactive))
                                <div class="alert alert-danger alert-dismissible fade show col">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span>
                                        {{$inactive}}
                                    </span>
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">    
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

                    </div>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> This Month</h4>
                        <h5 class="card-category">{{ isset($now) ? date('F', strtotime($now)) : ''}}</h5>
                    </div>
                    <div class="card-body">
                        @if($monthly_count==0)
                            <div class="alert alert-warning" role="alert">
                                    {{'No Records This Month'}}
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                        <th class="text-center">
                                            Date
                                        </th>
                                        <th class="text-center">
                                            Laborer
                                        </th>
                                        <th class="text-center">
                                            Task
                                        </th>
                                        <th class="text-center">
                                            Wage amount
                                        </th>
                                        <th class="text-center">
                                            Recorded By
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($monthly_wages as $wage)
                                        <tr>
                                            <td class="text-center">
                                                {{ date('M d, Y', strtotime($wage->date)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $wage->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $wage->task }}
                                            </td>
                                            <td class="text-center">
                                                {{ round($wage->wage,2) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $wage->username }}
                                            </td>
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/laborwage/edit/{{ $wage->labor_wage_id }}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    Info
                                                </a>
                                                <a class="text-danger" href="/laborwage/delete/{{ $wage->labor_wage_id }}">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $monthly_wages->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- This Season -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> This Season</h4>
                        <h5 class="card-category">{{isset($season_id) ? 'Season ' . $season_id : ''}}</h5>
                    </div>
                    <div class="card-body">
                        @if($numRows==0)
                            <div class="alert alert-warning" role="alert">
                                    {{'No Records This Season'}}
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                        <th class="text-center">
                                            Date
                                        </th>
                                        <th class="text-center">
                                            Laborer
                                        </th>
                                        <th class="text-center">
                                            Task
                                        </th>
                                        <th class="text-center">
                                            Wage amount
                                        </th>
                                        <th class="text-center">
                                            Recorded By
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($wages as $wage)
                                        <tr>
                                            <td class="text-center">
                                                {{ date('M d, Y', strtotime($wage->date)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $wage->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $wage->task }}
                                            </td>
                                            <td class="text-center">
                                                {{ round($wage->wage,2) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $wage->username }}
                                            </td>
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/laborwage/edit/{{ $wage->labor_wage_id }}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    Info
                                                </a>
                                                <a class="text-danger" href="/laborwage/delete/{{ $wage->labor_wage_id }}">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $wages->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection