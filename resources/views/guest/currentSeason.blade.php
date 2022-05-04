@extends('layouts.guestStyle', [
    'class' => '',
    'elementActive' => 'currentSeason'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
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
                                    <p class="card-title"> {{ $isCurrent == true ? round($totalExpenses,1) : '-- --' }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
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
                                    <p class="card-title"> {{ $isCurrent == true ? round($totalYield,1) : '-- --' }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
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
                                    <p class="card-title"> {{ $isCurrent == true ? round($totalRevenue,1) : '-- --' }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
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
                                        <span @if ($profit<1) class="text-danger" @elseif($profit>0) class="text-success" @endif >
                                            {{ $isCurrent == true ? round($profit,1) : '-- --' }}
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
            <div class="col-lg-3 col-md-6 col-sm-6s h-100">
                <div class="card card-stats" style="min-height: 180px">
                    <div class="card-header">
                        <h5 class="card-category"><strong>Expenses Breakdown</strong></h5>
                    </div>
                    <div class="card-body">
                        <p style="margin-top: -10px">
                            <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Amount paid to workers"></i>
                            <strong><span style="opacity: 0.5">Wage: </span>{{ $isCurrent == true ? round($wage,2) : '-- --' }}</strong>
                        </p>
                        <p style="margin-top: -10px">
                            <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Expenses from materials (e.g insecticides, fertilizers)"></i>
                            <strong><span style="opacity: 0.5">Purchase: </span>{{ $isCurrent == true ? round($matExpense,2) : '-- --' }}</strong>
                        </p>
                        <p style="margin-top: -10px">
                            <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Total tax paid within the season"></i>
                            <strong><span style="opacity: 0.5">Tax: </span>{{ $isCurrent == true ? round($tax,2) : '-- --' }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            <!-- BreakdownExpenses::End -->

            <!-- SeasonInfo::Begin -->
            <div class="col-md-6 col-sm-6">
                <div class="card card-stats" style="min-height: 180px">
                    <div class="card-header">
                        <p class="description"><strong>Current Season: {{ $isCurrent == true ? 'Season ' . $lastSeason->season_id  : 'Season hasn\'t started yet' }}</strong>
                            <span class="float-right" href="#">
                                <i @if ( $isCurrent==true ) class="icon-big nc-icon nc-sun-fog-29 text-warning" @else class="icon-big nc-icon nc-sun-fog-29" @endif></i>
                            </span>
                        </p>
                        <p class="description" style="margin-top: -23px"><strong>Date Started: </strong><span class="btn btn-sm btn-success" style="opacity: 0.7">{{ $isCurrent == true ?  date('M d, Y', strtotime($lastSeason->start_date)) : '--:--' }}</span></p>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <!-- SeasonInfo::End -->

            <div class="col-lg-3 col-md-6 col-sm-6">
                
                <div class="row">
                    <!-- Loss::Begin -->
                    <div class="col-lg-12 col-md-12 col-sm-12 h-100">
                        <div class="card card-stats" style="min-height: 90px">
                            <div class="card-header">
                                <h5 class="card-category"><strong>Loss</strong>
                                    <i class="nc-icon nc-alert-circle-i text-info" style="cursor: pointer" title="Amount to make up from the capital you spent"></i>
                                </h5>
                            </div>
                            <div class="card-body pb-3">
                                <h5 style="margin-top: -15px" @if($loss<0) class="text-danger text-center" @else class="text-success text-center" @endif><strong>{{ $loss < 0 ? round($loss*-1,2) : 'You have no loss' }}</strong></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Loss::End -->
                </div>

                <div class="row">
                    <!-- Calendar::Begin -->
                    <div class="col-lg-12 col-md-12 col-sm-12 h-100">
                        <div class="card card-stats" style="min-height: 90px">
                            <div class="card-header">
                                <h5 class="card-category"><strong>Calendar</strong>
                                    <input type="date" class="form-control" style="
                                        background: transparent;
                                        color: transparent;
                                        border: transparent;
                                        cursor: pointer;
                                        position: absolute;
                                        width: auto;
                                    ">
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Calendar::End -->
                </div>
                
            </div>
            
        </div>
    </div>
@endsection