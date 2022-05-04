@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'batch'
])

@section('content')
    <div class="content">
        <!-- Heading -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-3">
                                <h4 class="card-title"> Batch  <i class="icon-big nc-icon nc-chart-pie-36 text-info" style="opacity: 0.4"></i></h4> 
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('batch.index') }}" <?php if(isset($inactive)){ ?> disabled <?php } ?> >
                                    <i class="nc-icon nc-minimal-left text-light"></i> 
                                     Back
                                </a>
                            </div>
                            <div class="col-lg-5 offset-4">
                                @if(Session::has('activity_added'))
                                <div class="alert alert-success alert-with-icon alert-dismissible fade show"
                                    data-notify="container">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                    <span data-notify="message">{{Session::get('activity_added')}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <h5 class="text-center">Batch No. {{$batch->id}}</h5>
                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <p><strong>Plant: </strong>{{ $batch->plant_name }}</p>
                                    <p><strong>Current Stage: </strong>{{ $batch->currentStage }}</p>
                                </div>

                                <div class="col-md-4">
                                    <a href="/batch/progress/{{$batch->id}}" class="btn btn-success btn-sm">
                                        Progress
                                    </a>
                                    <a href="/batch/activities/{{$batch->id}}" class="btn btn-warning btn-sm">
                                        Activities
                                    </a>
                                    <a href="/batch/diseases/{{$batch->id}}" class="btn btn-danger btn-sm">
                                        Diseases
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-center">Activities</h5>

                                    <!-- Add More Activity -->
                                    <form class="row" id="pdAdd" style="display:none" action="{{route('batch.addBatchActivity')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="batch_id" value="{{$batch->id}}">
                                        <label class="col-md-1 col-form-label">{{ __('Activity Name') }}</label>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="activity_name" class="form-control" placeholder="Activity Name" required>
                                            </div>
                                            @if ($errors->has('activity_name'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('activity_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-success btn-sm text-light"><i class="nc-icon nc-check-2"></i></button>
                                        </div>
                                    </form><!-- End -->

                                    <div class="row">
                                        <div class="col-md-1">
                                            <a id="pdAddBut" onclick="(pdAdd.style='display: visible', pdAddBut.style='display: none')" class="btn btn-success btn-sm text-light">+ Add Activity</a>
                                        </div>
                                    </div>

                                    @if(count($activities)==0)
                                        <div class="alert alert-warning" role="alert">
                                                {{'You did not set any activity yet!'}}
                                        </div>

                                        @else
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class=" text-info">
                                                    <th class="text-center">
                                                        Activity Name
                                                    </th>
                                                    <th class="text-center">
                                                        Item Used
                                                    </th>
                                                    <th class="text-center">
                                                        Laborers
                                                    </th>
                                                </thead>
                                                <tbody>
                                                @foreach ($activities as $activity)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $activity->activity_name }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-success btn-sm text-light">+</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-success btn-sm text-light">+</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
