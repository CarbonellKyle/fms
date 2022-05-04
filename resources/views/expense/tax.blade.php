@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tax'
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
                                <h4 class="card-title"> Tax <i class="icon-big nc-icon nc-bank text-info" style="opacity: 0.4"></i></h4>  
                            </div>
                            <div class="col-lg-3">
                                @if(!isset($inactive))
                                <span><strong style="opacity: 0.5">Total Tax: </strong><span class="btn btn-sm btn-info" style="opacity: 0.7"> {{ round($total,2) }} </span></span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('expense.addTaxExpense') }}" <?php if(isset($inactive)){ ?> disabled <?php } ?> >
                                    <i class="nc-icon nc-bank text-light mr-2"></i>
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
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Amount
                                        </th>
                                        @if ((Auth::user()->hasRole('administrator'))||(Auth::user()->hasRole('superadministrator')))
                                        <th class="text-center">
                                            Recorded By
                                        </th>
                                        @endif
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($monthly_taxes as $tax)
                                        <tr>
                                            <td class="text-center">
                                                {{ date('M d, Y', strtotime($tax->date)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tax->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ round($tax->amount,2) }}
                                            </td>
                                            @if ((Auth::user()->hasRole('administrator'))||(Auth::user()->hasRole('superadministrator')))
                                            <td class="text-center">
                                                {{ $tax->username }}
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/tax/edit/{{ $tax->tax_id }}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    Info
                                                </a>
                                                <a class="text-danger" href="/tax/delete/{{ $tax->tax_id }}">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $monthly_taxes->links("pagination::bootstrap-4") }}</div>
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
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Amount
                                        </th>
                                        @if ((Auth::user()->hasRole('administrator'))||(Auth::user()->hasRole('superadministrator')))
                                        <th class="text-center">
                                            Recorded By
                                        </th>
                                        @endif
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($taxes as $tax)
                                        <tr>
                                            <td class="text-center">
                                                {{ date('M d, Y', strtotime($tax->date)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tax->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ round($tax->amount,2) }}
                                            </td>
                                            @if ((Auth::user()->hasRole('administrator'))||(Auth::user()->hasRole('superadministrator')))
                                            <td class="text-center">
                                                {{ $tax->username }}
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/tax/edit/{{ $tax->tax_id }}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    Info
                                                </a>
                                                <a class="text-danger" href="/tax/delete/{{ $tax->tax_id }}">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $taxes->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection