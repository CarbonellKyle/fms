@extends('layouts.guestStyle', [
    'class' => '',
    'elementActive' => 'history'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> History  <i class="icon-big nc-icon nc-watch-time text-info" style="opacity: 0.4"></i></h4>
                        <br><h6>Season List<i class="icon-big nc-icon nc-sun-fog-29 text-warning"></i></h6>
                    </div>
                    <div class="card-body">
                        @if($numRows==0)
                            <div class="alert alert-warning" role="alert">
                                    {{'No Records Yet'}}
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th class="text-center">
                                            Season Number
                                        </th>
                                        <th class="text-center">
                                            Date Started
                                        </th>
                                        <th class="text-center">
                                            Date Ended
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($seasons as $season)
                                        <tr>
                                            <td class="text-center">
                                                {{ $season->season_id }}
                                            </td>
                                            <td class="text-center">
                                                {{ date('M d, Y', strtotime($season->start_date)) }}
                                            </td>
                                            <td @if ($season->end_date == null) class="text-center text-success"  @else class="text-center" @endif>
                                                {{ $season->end_date == null ? 'Current Season' : date('M d, Y', strtotime($season->end_date)) }}
                                            </td>
                                            <td class="text-center">
                                                <a class="text-info mr-2" @if ($season->end_date == null ) href="{{ route('guest.currentSeason') }}" @else href="/guest/viewSeason/{{ $season->season_id}}" @endif>
                                                    <i class="nc-icon nc-zoom-split text-info"></i>
                                                    View Info
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $seasons->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
