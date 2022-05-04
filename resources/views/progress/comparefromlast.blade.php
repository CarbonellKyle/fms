@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'progress'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Progress Chart</h5>
                        <p class="card-category">Graphical representation of season information</p>
                    </div>
                    <div class="card-body" style="min-height:400px">
                        @if ($noOfSeasons==0)
                        <div class="container"><h1 class="text-center">No Seasons Yet</h1></div>

                            @else
                            <div class="float-right" style="margin: -10px 20px 30px 0">
                                <ul class="navbar-nav">
                                    <li class="nav-item btn-rotate dropdown">
                                        <a class="form-control text-secondary dropdown-toggle" id="navbarDropdownMenuLink2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer">
                                            Options-- </i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="{{ route('progress.index') }}">Current Season</a>
                                                @if($noOfSeasons>1)
                                                    <a class="dropdown-item" href="{{ route('progress.comparefromlast') }}">Compare from Last Season</a>
                                                @endif
                                                @if($noOfSeasons>4)
                                                    <a class="dropdown-item" href="{{ route('progress.lastfive') }}">Last 5 Seasons</a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="container">
                                <h4>Compare Last 2 Seasons</h4>
                                <div id="compareChart" style="height: 300px;"></div>

                                <div class="container" style="border-left: 3px solid #fbc658">
                                    <p style="font-size: 20px">Details</p>
                                    <p style="opacity: 0.7"><i><strong>From the previous season;</strong></i></p>

                                    <!--Expenses-->
                                    @if($expenses[0]==$expenses[1])
                                        <p style="margin-top: -15px">There are <strong>no</strong> changes in your expenses</p>
                                    @else
                                        <p style="margin-top: -15px">Your expenses has <strong @if($expenses[1]>$expenses[0]) class="text-success" @else class="text-danger" @endif>{{$expenses[0]>$expenses[1] ? 'increased' : 'decreased'}}</strong> by <strong style="opacity: 0.7">{{$expenses[0]>$expenses[1] ? $expenses[0]-$expenses[1] : $expenses[1]-$expenses[0]}}</strong></p>
                                    @endif

                                    <!--Revenue-->
                                    @if($revenue[0]==$revenue[1])
                                        <p style="margin-top: -15px">There are <strong>no</strong> changes in your revenue</p>
                                    @else
                                        <p style="margin-top: -15px">Your revenue has <strong @if($revenue[0]>$revenue[1]) class="text-success" @else class="text-danger" @endif>{{$revenue[0]>$revenue[1] ? 'increased' : 'decreased'}}</strong> by <strong style="opacity: 0.7">{{$revenue[0]>$revenue[1] ? $revenue[0]-$revenue[1] : $revenue[1]-$revenue[0]}}</strong></p>
                                    @endif

                                    <!--Profit-->
                                    @if($profit[0]==$profit[1])
                                        <p style="margin-top: -15px">There are <strong>no</strong> changes in your profit</p>
                                    @else
                                        <p style="margin-top: -15px">Your profit has <strong @if($profit[0]>$profit[1]) class="text-success" @else class="text-danger" @endif>{{$profit[0]>$profit[1] ? 'increased' : 'decreased'}}</strong> by <strong style="opacity: 0.7">{{$profit[0]>$profit[1] ? $profit[0]-$profit[1] : $profit[1]-$profit[0]}}</strong></p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">Yields</h5>
                        <p class="card-category">Compare Last 2 Seasons</p>
                    </div>
                    <div class="card-body">
                        <div id="compareFromLastYield" width="400" height="100"></div>
                    </div>
                    <div class="card-footer">
                        <hr style="margin-top: -25px" />
                        <div class="card-stats">
                            <!--Yields-->
                            @if($yield[0]==$yield[1])
                                <p>There are <strong>no</strong> changes in your yield</p>
                            @else
                                <p>Your yield has <strong @if($yield[0]>$yield[1]) class="text-success" @else class="text-danger" @endif>{{$yield[0]>$yield[1] ? 'increased' : 'decreased'}}</strong> by <strong style="opacity: 0.7">{{$yield[0]>$yield[1] ? $yield[0]-$yield[1] : $yield[1]-$yield[0]}}</strong> sacks</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection

@push('scripts')
    <script>
        const chart = new Chartisan({
            el: '#compareChart', //div id where to render chart
            url: "@chart('compare_from_last_chart')", //chart to get datasets value from
            hooks: new ChartisanHooks()
                .beginAtZero()
                .datasets([
                    {
                        //Expenses
                        type:'line',
                        lineTension: 0,
                        fill: false,
                        borderColor: "#f17e5d",
                        backgroundColor: "#f17e5d",
                        pointBorderColor: '#f17e5d',
                        pointBorderWidth: 4,
                        pointRadius: 2,
                        pointHoverRadius: 4,  
                        borderWidth: 3, 
                    },
                    {
                        //Revenue
                        type:'line',
                        lineTension: 0,
                        fill: false,
                        borderColor: "#51cbce",
                        backgroundColor: "#51cbce",
                        pointBorderColor: '#51cbce',
                        pointBorderWidth: 4,
                        pointRadius: 2,
                        pointHoverRadius: 4,  
                        borderWidth: 3,
                    },
                    {
                        //Profit
                        type:'line',
                        lineTension: 0,
                        fill: false,
                        borderColor: "#6bd098",
                        backgroundColor: "#6bd098",
                        pointBorderColor: '#6bd098',
                        pointBorderWidth: 4,
                        pointRadius: 2,
                        pointHoverRadius: 4,  
                        borderWidth: 3,
                    }
                ])
        });

        const yieldChart = new Chartisan({
            el: '#compareFromLastYield',
            url: "@chart('compare_from_last_yield')",
            hooks: new ChartisanHooks()
                .beginAtZero()
                .datasets([
                    {
                        //Yields
                        type:'line',
                        lineTension: 0,
                        fill: false,
                        borderColor: "#ffc931",
                        backgroundColor: "#ffc931",
                        pointBorderColor: '#ffc931',
                        pointBorderWidth: 4,
                        pointRadius: 2,
                        pointHoverRadius: 4,  
                        borderWidth: 3, 
                    }
                ])
        });
    </script>
@endpush