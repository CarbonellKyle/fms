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
                                <h4>Current Season</h4>
                                <div id="defaultChart" style="height: 300px;"></div>

                                <div class="container" style="border-left: 3px solid #fbc658">
                                    <p style="font-size: 20px">Details</p>
                                    @if($profit==0)
                                        <p>Your revenue is <strong>equal to</strong> your expenses</p>
                                        <p style="margin-top: -15px">You have <strong>no</strong> profit</p>
                                    @else
                                        <p>Your revenue is <strong @if($revenue>$expenses) class="text-success" @else class="text-danger" @endif> {{$revenue>$expenses ? 'greater than' : 'less than'}} </strong> your expenses</p>
                                        <p style="margin-top: -15px">You have <strong @if($profit>0) class="text-success" @else class="text-danger @endif">{{$profit<0 ? $profit*-1 : $profit}}</strong> {{$profit>0 ? 'profit' : 'loss'}}</p>
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
                        <p class="card-category">Current Season</p>
                    </div>
                    <div class="card-body">
                        <div id="currentYield" width="400" height="100"></div>
                    </div>
                    <div class="card-footer">
                        <hr style="margin-top: -25px" />
                        <div class="card-stats">
                             <p>Your current season yield is <strong @if($yield>0) class="text-success" @else style="opacity: 0.7" @endif>{{$yield}}</strong> sacks</p>
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
            el: '#defaultChart', //div id where to render chart
            url: "@chart('current_season_chart')", //chart to get datasets value from
            hooks: new ChartisanHooks()
                .beginAtZero()
                .datasets([
                    {
                        //Expenses
                        type:'bar',
                        fill: false,
                        borderColor: "#f17e5d",
                        backgroundColor: "#f17e5d",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                    },
                    {
                        //Revenue
                        type:'bar',
                        fill: false,
                        borderColor: "#51cbce",
                        backgroundColor: "#51cbce",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                    },
                    {
                        //Profit
                        type:'bar',
                        fill: false,
                        borderColor: "#6bd098",
                        backgroundColor: "#6bd098",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                    }
                ])
        });

        const yieldChart = new Chartisan({
            el: '#currentYield',
            url: "@chart('current_yield')",
            hooks: new ChartisanHooks()
                .beginAtZero()
                .datasets([
                    {
                        //Yields
                        type:'bar',
                        fill: false,
                        borderColor: "#ffc931",
                        backgroundColor: "#ffc931",
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        borderWidth: 3,
                    }
                ])
        });
    </script>
@endpush