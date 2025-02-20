@extends('backend.layouts.master')

@section('title')
    {{ __('Admins - Admin Panel') }}
@endsection

@section('styles')
    <!-- Start datatable css -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">


@endsection

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{ __('Clôtures') }}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Tableau de bord') }}</a></li>
                    <li><span>{{ __('Liste des Clôtures') }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">{{ __('Clôtures') }}</h4>
                    <p class="float-right mb-2">
                        @if (auth()->user()->can('admin.edit'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.admins.create') }}">
                                {{ __('Ajouter Clôtures') }}
                            </a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th >{{ __('N°') }}</th>
                                    <th >{{ __('Date Clôture') }}</th>
                                    <th >{{ __('Total vente') }}</th>
                                    <th >{{ __('Total achat') }}</th>
                                    <th >{{ __('Observations') }}</th>
                                    <th >{{ __('Date Création') }}</th>
                                    <th colspan="2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($clotures as $clotures)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td> 
                                    <td >{{ \Carbon\Carbon::parse($clotures->date_cloture)->format('d/m/Y à H:i') 	 }}</td>
                                    <td >{{ $clotures->total_vente	 }}</td>
                                    <td >{{ $clotures->total_achat	 }}</td>
                                    <td >{{ $clotures->observation   }}</td>
                                    <td>{{ \Carbon\Carbon::parse($clotures->created_at)->format('d/m/Y à H:i') }}</td>
                                    <td>
                                        @if (auth()->user()->can('admin.edit'))
                                            <a class="btn btn-success text-white" href="{{ route('admin.admins.edit', $clotures->id) }}">Modifier</a>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if (auth()->user()->can('admin.delete'))
                                        <a class="btn btn-danger text-white" href="javascript:void(0);"
                                        onclick="event.preventDefault(); if(confirm('Êtes vous sur de vouloir supprimer?')) { document.getElementById('delete-form-{{ $clotures->id }}').submit(); }">
                                            {{ __('Supprimer') }}
                                        </a>

                                        <form id="delete-form-{{ $clotures->id }}" action="{{ route('admin.admins.destroy', $clotures->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection

@section('scripts')
     <!-- Start datatable js -->
     {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> --}}
     <script src="https://cdn.datatables.net/2.1.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.jqueryui.min.js"></script>

     
     <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
     </script>
@endsection