@extends('backend.layouts.apps')
{{-- 
@section('title')
    {{ __('Admins - Admin Panel') }}
@endsection --}}

@section('styles')
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.jpg') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/datatable.css') }}">
@endsection

@section('admin-content')
    <div class="page-header">
        <div class="page-title">
            <h4>Liste des Produits</h4>
            <h6>Gérez vos produits</h6>
        </div>
        <div class="page-btn">
            @if (Auth::guard('admin')->user()->can('produit.create'))
            <a href="{{ route('admin.produits.create') }}" class="btn btn-added"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}"
                    alt="img" class="me-1">Nouveau Produit</a>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @include('backend.layouts.composants.messages')
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('backend/assets/img/icons/search-white.svg') }}"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{ asset('backend/assets/img/icons/pdf.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{ asset('backend/assets/img/icons/excel.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{ asset('backend/assets/img/icons/printer.svg') }}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- @include('backend.layouts.partials.messages') --}}
            <div class="table-responsive">
                <table class="table  datanew table-striped" id="example">
                    <thead>
                        <tr>
                            <th>
                                N°
                            </th>
                            <th>Code produit</th>
                            <th>Libelle</th>
                            <th>Type de Produit</th>
                            <th>Emballage </th>
                            <th>Format </th>
                            <th>Date Création</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produit as $produits)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $produits->matriproduit }}</td>
                                <td>{{ $produits->libelle }}</td>
                                <td>{{ $produits->typeproduit->libelle ?? 'Non spécifié' }}</td>
                                <td>{{ $produits->emballage->libelle ?? 'Non spécifié' }}</td>
                                <td>{{ $produits->format->format ?? 'Non spécifié' }}</td>
                                <td>{{ \Carbon\Carbon::parse($produits->created_at)->format('d/m/Y à H:i') }}</td>
                                <td>
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                     @if (Auth::guard('admin')->user()->can('produit.edit'))
                                        <a class="me-3" href="{{ route('admin.admins.edit', $produits->id) }}"><img
                                                src="{{ asset('backend/assets/img/icons/edit.svg') }}" alt="img"></a>
                                    @endif
                                     @if (Auth::guard('admin')->user()->can('produit.delete'))
                                        <a class="confirm-text" href="javascript:void(0);"
                                                onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir supprimer?')) { document.getElementById('delete-form-{{ $produits->id }}').submit(); }">
                                            <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>

                                        <form id="delete-form-{{ $produits->id }}"
                                            action="{{ route('admin.produits.destroy', $produits->id) }}" method="POST"
                                            style="display: none;">
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
@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
@endsection
