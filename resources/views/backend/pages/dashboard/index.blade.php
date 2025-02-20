@extends('backend.layouts.apps')
{{-- 
@section('title')
    {{ __('Admins - Admin Panel') }}
@endsection --}}

@section('styles')
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.jpg') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/animate.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/datatable.css') }}">
@endsection

@section('admin-content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="{{ asset('backend/assets/img/icons/dash1.svg') }}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="10000000">1 000 000</span> XOF</h5>
                        <h6>Total achat à éffectuer</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="{{ asset('backend/assets/img/icons/dash2.svg') }}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="10000000">10000000</span> XOF</h5>
                        <h6>Total vente à éffectuer</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="{{ asset('backend/assets/img/icons/dash3.svg') }}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="10000000">10000000 </span> XOF</h5>
                        <h6>Total vente éffectué</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="{{ asset('backend/assets/img/icons/dash4.svg') }}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="10000000">10000000 </span> XOF</h5>
                        <h6>Total Achat éffectué</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{ $total_clients }}</h4>
                        <h5>Clients</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{ $total_fournisseurs }}</h4>
                        <h5>Fournisseurs</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>100</h4>
                        <h5>Facture Vente</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>105</h4>
                        <h5>Facture Achat</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>105</h4>
                        <h5>Sales Invoice</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>{{ $total_roles }}</h4>
                        <h5>Roles</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="shield"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das4">
                    <div class="dash-counts">
                        <h4>{{ $total_permissions }}</h4>
                        <h5>Permissions</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="lock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{ $total_admins }}</h4>
                        <h5>Administrateurs</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>


        </div>
        <!-- Dashboard vue -->
        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Achats & Ventes</h5>
                        <div class="graph-sets">
                            <ul>
                                <li>
                                    <span>Ventes</span>
                                </li>
                                <li>
                                    <span>Achats</span>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    2024 <img src="{{ asset('backend/assets/img/icons/dropdown.svg') }}" alt="img" class="ms-2">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2026</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2025</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2024</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Alerte Stocks <span style="font-size: 1.2rem;">&#9888;&#65039;</span></h4>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="{{ route('admin.stocks.index') }}" class="dropdown-item">Liste des Stocks</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.approvisionnements.create') }}" class="dropdown-item">Approvisionner </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dataview">
                            <table class="table datatable ">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Produits</th>
                                        <th>Quantié restante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alertstock as $stock)
                                     <!-- État du stock par rapport au seuil critique -->
                                     @php
                                     // Trouver le seuil critique pour ce produit
                                     $seuilCritique = $seuilcritiques->firstWhere('produit_id', $stock->produit_id);
                                    @endphp
                                    @if ($seuilCritique && $stock->quantite_disponible <= $seuilCritique->seuil_critique)
                                    {{-- <div class="alert alert-danger">
                                        Alert : Vous êtes en manque de ce produit
                                    </div> --}}

                                    <tr>
                                         <!-- Numéro de ligne -->
                                         <td class="text-center">{{ $loop->index + 1 }}</td>
        
                                         <!-- Produit avec format et emballage -->
                                         <td>
                                             {{ ( $stock->produit->libelle ?? 'Non spécifié') . ' de ' . ( $stock->produit->format->format ?? 'Non spécifié'). ' ' . ($stock->produit->emballage->libelle ?? 'Non spécifié') }}
                                         </td>
         
                                         <!-- Quantité disponible -->
                                         <td class="text-center text-danger" >{{ $stock->quantite_disponible }} <span style="font-size: 1.2rem;">&#9888;&#65039;</span>
                                         </td>
         
                                    </tr>
                                @else
                                    
                                @endif

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card datatable -->
        <div class="card mb-0">
            <div class="card-body">
                <h4 class="card-title">Approvisionnements récemment éffectué</h4>
                <div class="table-responsive dataview">
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End card datatable -->
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('backend/assets/plugins/apexchart/apexcharts.min.js') }}"></script>

<script src="{{ asset('backend/assets/plugins/apexchart/chart-data.js') }}"></script>

<script src="{{ asset('backend/assets/js/script.js') }}"></script>
@endsection
