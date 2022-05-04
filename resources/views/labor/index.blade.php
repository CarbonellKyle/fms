@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'labor'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Laborers  <i class="icon-big nc-icon nc-single-02 text-info" style="opacity: 0.4"></i></h4>
                        <a class="btn btn-primary text-light" href="{{ route('labor.add') }}">
                            <i class="nc-icon nc-simple-add text-light"></i>
                            <i class="nc-icon nc-single-02 text-light mr-2"></i>
                            Add Laborer
                        </a>

                        @if(Session::has('delete_laborer'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                    <i class="nc-icon nc-simple-remove"></i>
                                </button>
                                <span>
                                    {{Session::get('delete_laborer')}}
                                </span>
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        @if($numRows==0)
                            <div class="alert alert-warning" role="alert">
                                    {{'No Laborers Yet, Go Hire Some!'}}
                            </div>

                            @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                        <th class="text-center">
                                            ID Number
                                        </th>
                                        <th class="text-center">
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Address
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
                                    @foreach ($laborers as $laborer)
                                        <tr>
                                            <td class="text-center">
                                                {{ $laborer->laborer_id }}
                                            </td>
                                            <td class="text-center">
                                                {{ $laborer->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $laborer->address }}
                                            </td>
                                            @if ((Auth::user()->hasRole('administrator'))||(Auth::user()->hasRole('superadministrator')))
                                            <td class="text-center">
                                                {{ $laborer->username }}
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <a class="text-info mr-2" href="/labor/edit/{{ $laborer->laborer_id }}">
                                                    <i class="nc-icon nc-paper text-info"></i>
                                                    Info
                                                </a>
                                                <a class="text-danger" href="/labor/delete/{{ $laborer->laborer_id }}">
                                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right mr-4">{{ $laborers->links("pagination::bootstrap-4") }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection