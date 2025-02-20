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
            <h4>Liste des Approvisionnements</h4>
            <h6>Gérez vos Approvisionnements</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.approvisionnements.create') }}" class="btn btn-added"><img
                    src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouvelle
                Approvisionnement</a>
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


            <div class="table-responsive">
                <table class="table  datanew table-striped" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">
                                N°
                            </th>
                            <th>Code produit</th>
                            <th>Désignation</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-center">Prix Unitaire</th>
                            <th class="text-center">Total HT</th>
                            <th>Fournisseur</th>
                            <th class="text-center">Date d'approvisionnement</th>
                            <th class="text-center">Date Création</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($approvisionnement as $approvisionnements)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td>{{ $approvisionnements->taritypeproduitfournisseur->produit->matriproduit  ?? 'N/A' }}
                                </td>
                                <td>{{ $approvisionnements->taritypeproduitfournisseur->produit->libelle . ' de ' . $approvisionnements->taritypeproduitfournisseur->produit->format->format . ' ' . $approvisionnements->taritypeproduitfournisseur->produit->emballage->libelle ?? 'N/A' }}
                                </td>
                                <td class="text-center">{{ $approvisionnements->quantite }}</td>
                                <td class="text-center">
                                    {{ number_format($approvisionnements->taritypeproduitfournisseur->tarifliquide, 2, ',', ' ') ?? 'N/A' }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($approvisionnements->quantite * $approvisionnements->taritypeproduitfournisseur->tarifliquide, 2, ',', ' ') ?? 'N/A' }}
                                </td>
                                <td>{{ $approvisionnements->taritypeproduitfournisseur->fournisseur->nom ?? 'N/A' }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($approvisionnements->date_approvisionnement)->format('d-m-Y ') }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($approvisionnements->created_at)->format('d-m-Y à H:i') }}
                                </td>
                                <td>
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                    @if (auth()->user()->can('admin.delete'))
                                        <a class="confirm-text" href="javascript:void(0);"
                                            onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir supprimer?')) { document.getElementById('delete-form-{{ $approvisionnements->id }}').submit(); }">
                                            <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>

                                        <form id="delete-form-{{ $approvisionnements->id }}"
                                            action=""
                                            method="POST" style="display: none;">
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
