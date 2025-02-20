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
            <h4>Liste des détails Ventes</h4>
            <h6>Gérez vos  détails  Ventes</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.traitementventeclients.create') }}" class="btn btn-added"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}"
                    alt="img" class="me-1">Nouvelle  Vente</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
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
                            <th class="text-center">Code Vente</th>
                            <th class="text-center">Code Produit</th>
                            <th>Désignation</th>
                            <th class="text-center">Quantité Liquid. </th>
                            <th class="text-center">Prix Unitaire HT Liquid. </th>
                            <th class="text-center">Prix Vente Total Liquid.</th>
                            <th class="text-center">Quantité Emb. </th>
                            <th class="text-center">Prix Unitaire HT Emb. </th>
                            <th class="text-center">Prix Vente Total Emb.</th>
                            <th class="text-center">Date Vente</th>
                            <th >Date Création</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventes as $ventes)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $ventes->code_vente }}</td>
                                <td class="text-center">{{ $ventes->produit->matriproduit }}</td>
                                <td >{{ $ventes->produit->libelle . ' de ' . $ventes->produit->format->format . '  ' . $ventes->produit->emballage->libelle}}</td>
                                <td class="text-center">{{ $ventes->quantite }}</td>
                                <td class="text-center">{{ number_format($ventes->tariftypeproduitclient->tarifliquide ?? 0, 2, ',', ' ')  }}</td>
                                <td class="text-center">{{ number_format($ventes->prix_vente_totalliquide ?? 0, 2, ',', ' ')  }}</td>
                                <td class="text-center">{{ $ventes->quantite - $ventes->quantite_emb_retour }}</td>
                                <td class="text-center">{{ number_format($ventes->tariftypeproduitembclient->tarifemballage ?? 0, 2, ',', ' ')  }}</td>
                                <td class="text-center">{{ number_format($ventes->prix_vente_totalemb ?? 0, 2, ',', ' ') }}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($ventes->date_vente)->format('d-m-Y')  }}</td>
                                <td>{{ \Carbon\Carbon::parse($ventes->created_at)->format('d-m-Y à H:i')  }}</td>
                               
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
