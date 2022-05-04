@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'history'
])

@section('content')
    <div class="content">
        <a class="btn btn-primary text-light" href="{{ route('history.index') }}">
            <i class="nc-icon nc-minimal-left text-light"></i>
                Back
        </a>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper/img/bg/farm7.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="container-fluid mt-4">
                            <h5 class="title" style="opacity: 0.5">{{ 'Season ' . $season->season_id }}
                            </h5>
                            <p class="description">
                                <strong>Date Started: </strong><span class="btn btn-sm btn-success" style="opacity: 0.7">{{ date('M d, Y', strtotime($season->start_date)) }}</span>
                            </p>
                            <p class="description" style="margin-top: -23px">
                                <strong>Date Ended: </strong><span class="btn btn-sm btn-danger" style="opacity: 0.7">{{ date('M d, Y', strtotime($season->end_date)) }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
            
            <!-- Info::Start -->
            <div class="col-md-6 col-sm-6 container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning" style="opacity: 0.4">
                                            <i class="nc-icon nc-cart-simple text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Expenses
                                                <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Amount spent or invested"></i>
                                            </p>
                                            <p class="card-title"> {{ round($totalExpenses,1) }}
                                                <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-info" style="opacity: 0.4">
                                            <i class="nc-icon nc-shop text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Yeilds
                                                <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Amount of products harvested this season"></i>
                                            </p>
                                            <p class="card-title"> {{ round($totalYield,1) }}
                                                <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-primary" style="opacity: 0.4">
                                            <i class="nc-icon nc-money-coins text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Revenue
                                                <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Raw income generated this season"></i>
                                            </p>
                                            <p class="card-title"> {{ round($totalRevenue,1) }}
                                                <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-success" style="opacity: 0.4">
                                            <i class="nc-icon nc-chart-bar-32 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Profit
                                                <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Remaining income after expenses deduction"></i>
                                            </p>
                                            <p class="card-title">
                                                <span @if ($profit<1 ) class="text-danger" @elseif($profit>0) class="text-success" @endif >
                                                    {{ round($profit,1) }}
                                                </span>
                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- BreakdownExpenses::Begin -->
                    <div class="col-lg-6 col-md-12 col-sm-12 h-100">
                        <div class="card card-stats" style="min-height: 180px">
                            <div class="card-header">
                                <h5 class="card-category"><strong>Expenses Breakdown</strong></h5>
                            </div>
                            <div class="card-body">
                                <p style="margin-top: -10px">
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Amount paid to workers"></i>
                                    <strong><span style="opacity: 0.5">Wage: </span>{{round($wage,2)}}</strong>
                                </p>
                                <p style="margin-top: -10px">
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Expenses from materials (e.g insecticides, fertilizers)"></i>
                                    <strong><span style="opacity: 0.5">Purchase: </span>{{round($matExpense,2)}}</strong>
                                </p>
                                <p style="margin-top: -10px">
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Tax paid within the season"></i>
                                    <strong><span style="opacity: 0.5">Tax: </span>{{round($tax,2)}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- BreakdownExpenses::End -->

                    <!-- Loss:Begin -->
                    <div class="col-lg-6 col-md-12 col-sm-12 h-100">
                        <div class="card card-stats" style="min-height: 90px">
                            <div class="card-header">
                                <h5 class="card-category"><strong>Loss</strong>
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Amount to make up from the capital you spent"></i>
                                </h5>
                            </div>
                            <div class="card-body pb-3">
                                <h5 style="margin-top: -15px" @if($loss<0) class="text-danger text-center" @else class="text-success text-center" @endif><strong>{{ $loss < 0 ? round($loss*-1,2) : 'No loss this season' }}</strong></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Loss::End -->
                </div><!-- Row:End -->

            </div><!-- Info::End -->
        </div><!-- Row::End -->
    </div>
@endsection