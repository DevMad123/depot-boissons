@extends('backend.layouts.master')

@section('title')
    {{ __('Admins - Admin Panel') }}
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{ __('Ventes') }}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li><span>{{ __('Toutes les Ventes') }}</span></li>
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
                    <h4 class="header-title float-left">{{ __('Admins') }}</h4>
                    <p class="float-right mb-2">
                        @if (auth()->user()->can('admin.edit'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.ventes.create') }}">
                                {{ __('Enregistrer vente') }}
                            </a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th >{{ __('N°') }}</th>
                                    <th >{{ __('Libelle') }}</th>
                                    <th >{{ __('Quantite Vendu') }}</th>
                                    <th >{{ __('Prix Vente Total') }}</th>
                                    <th >{{ __('Date Vente') }}</th>
                                    <th >{{ __('Date Création') }}</th>
                                    <th colspan="2">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($ventes as $ventes)
                               <tr>
                                     <td>{{ $loop->index+1 }}</td>
                                    <td >{{ $ventes->produit->libelle }}</td>
                                    <td >{{ $ventes->quantite_vendu }}</td>
                                    <td >{{ $ventes->prix_vente_total  }}</td>
                                    <td>{{\Carbon\Carbon::parse($ventes->date_vente)->format('d/m/Y à H:i')  }}</td>
                                    <td>{{ \Carbon\Carbon::parse($ventes->created_at)->format('d/m/Y à H:i')  }}</td>
                                    <td>
                                        @if (auth()->user()->can('admin.edit'))
                                            <a class="btn btn-success text-white" href="{{ route('admin.ventes.edit', $ventes->id) }}">Modifier</a>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if (auth()->user()->can('admin.delete'))
                                        <a class="btn btn-danger text-white" href="javascript:void(0);"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{ $ventes->id }}').submit(); }">
                                            {{ __('Supprimer') }}
                                        </a>

                                        <form id="delete-form-{{ $ventes->id }}" action="{{ route('admin.ventes.destroy', $ventes->id) }}" method="POST" style="display: none;">
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
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     
     <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
     </script>
@endsection