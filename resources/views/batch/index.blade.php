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
                            <div class="col-lg-5 offset-4">
                                <!-- Batch Added -->
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
                                <!-- Batch Deleted -->
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
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <a class="btn btn-primary text-light" href="{{ route('batch.add') }}" <?php if(isset($inactive)){ ?> disabled <?php } ?> >
                                    <i class="nc-icon nc-simple-add text-light"></i>
                                    <i class="nc-icon nc-chart-pie-36 text-light"></i>
                                     Add Batch
                                </a>
                            </div>
                            <div class="col-lg-5 offset-4">
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
                        @if(count($batches)==0)
                            <div class="alert alert-warning" role="alert">
                                    {{'No Batches Added Yet!'}}
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                        <th class="text-center">
                                            Batch No.
                                        </th>
                                        <th class="text-center">
                                            Plant Planted
                                        </th>
                                        <th class="text-center">
                                            Current Stage
                                        </th>    
                                        <th class="text-center">
                                            Est. Time Left
                                        </th>
                                        <th class="text-center">
                                            Survival Rate
                                        </th>
                                        <th class="text-center">
                                            Current Count
                                        </th>
                                        <th class="text-center">
                                            Remarks
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($batches as $batch)
                                        <tr>
                                            <td class="text-center">
                                                {{ $batch->id }}
                                            </td>
                                            <td class="text-center">
                                                {{ $batch->plant_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $batch->currentStage }}
                                            </td>
                                            <td class="text-center">
                                                {{ '--' }}
                                            </td>
                                            <td class="text-center">
                                                {{ round(((($batch->quantity-$batch->quantityLoss)/$batch->quantity)*100),2) . '%' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $batch->quantity-$batch->quantityLoss }}
                                            </td>
                                            <td class="text-center">
                                                {{ $batch->remarks }}
                                            </td>
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/batch/view/{{$batch->id}}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    View
                                                </a><br>
                                                <a class="text-danger" href="#">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $batches->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
