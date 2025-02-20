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
            <h4>Liste des Ventes</h4>
            <h6>Gérez vos Ventes</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.traitementventeclients.create') }}" class="btn btn-added"><img
                    src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouvelle Ventes</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    {{-- <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('backend/assets/img/icons/filter.svg') }}" alt="img">
                            <span><img src="{{ asset('backend/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div> --}}
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

            {{-- <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choisir facture</option>
                                            <option>Macbook pro</option>
                                            <option>Orange</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choisir Catégorie</option>
                                            <option>Computers</option>
                                            <option>Fruits</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Sub Category</option>
                                            <option>Computer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Brand</option>
                                            <option>N/D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12 ">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Price</option>
                                            <option>150.00</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img
                                                src="{{ asset('backend/assets/img/icons/search-whites.svg') }}"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="table-responsive">
                <table class="table  datanew table-striped" id="example">
                    <thead>
                        <tr>
                            <th>
                                N°
                            </th>
                            <th>Code Vente</th>
                            <th>Client</th>
                            <th>Total HT liquide</th>
                            <th>TVA liquide</th>
                            <th>Frais Airsi liquide</th>
                            <th>Total HT emballage</th>
                            <th>Frais de port</th>
                            <th>Totaux Vente</th>
                            <th>Montant versé</th>
                            <th>Monnaie Rendue</th>
                            <th>Status vente</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listevente as $listeventes)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $listeventes->code_vente }}</td>
                                <td>{{ $listeventes->client->nom }}</td>
                                <td><strong>{{ number_format($listeventes->montant_totalhtliquide, 2, ',', ' ') }}</strong>
                                </td>
                                @if ($listeventes->client->exonerertva == 0)
                                    <td> {{ number_format($listeventes->montant_totalhtliquide * ($listeventes->tva->taux / 100), 2, ',', ' ') }}
                                    </td>
                                @else
                                    <td> {{ number_format($listeventes->montant_totalhtliquide * 0, 2, ',', ' ') }}
                                    </td>
                                @endif

                                @if ($listeventes->client->exonererairsi == 0)
                                    <td> {{ number_format($listeventes->montant_totalhtliquide * ($listeventes->fraisairsi->taux / 100), 2, ',', ' ') }}
                                    </td>
                                @else
                                    <td> {{ number_format($listeventes->montant_totalhtliquide * 0, 2, ',', ' ') }}</td>
                                @endif


                                <td><strong>{{ number_format($listeventes->montant_totalhtemballage, 2, ',', ' ') }}</strong>
                                </td>
                                <td>{{ number_format($listeventes->fraisport, 2, ',', ' ') }}</td>
                                @if ($listeventes->client->exonerertva == 0 && $listeventes->client->exonererairsi == 0)
                                    <td><strong>
                                            {{ number_format(
                                                $listeventes->montant_totalhtliquide +
                                                    $listeventes->montant_totalhtemballage +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->fraisairsi->taux / 100) +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->tva->taux / 100) +
                                                    $listeventes->fraisport,
                                                2,
                                                ',',
                                                ' ',
                                            ) }}
                                        </strong>
                                    </td>
                                @elseif ($listeventes->client->exonerertva == 0 && $listeventes->client->exonererairsi == 1)
                                    <td><strong>
                                            {{ number_format(
                                                $listeventes->montant_totalhtliquide +
                                                    $listeventes->montant_totalhtemballage +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->tva->taux / 100) +
                                                    $listeventes->fraisport,
                                                2,
                                                ',',
                                                ' ',
                                            ) }}
                                        </strong>
                                    </td>
                                @elseif ($listeventes->client->exonerertva == 1 && $listeventes->client->exonererairsi == 0)
                                    <td><strong>
                                            {{ number_format(
                                                $listeventes->montant_totalhtliquide +
                                                    $listeventes->montant_totalhtemballage +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->fraisairsi->taux / 100) +
                                                    $listeventes->fraisport,
                                                2,
                                                ',',
                                                ' ',
                                            ) }}
                                        </strong>
                                    </td>
                                @else
                                    <td><strong>
                                            {{ number_format($listeventes->montant_totalhtliquide + $listeventes->montant_totalhtemballage + $listeventes->fraisport, 2, ',', ' ') }}
                                        </strong>
                                    </td>
                                @endif

                                {{-- <td>{{ $listeventes->espece_receptionne === null ? number_format($listeventes->montant_totalhtliquide + $listeventes->montant_totalhtemballage + $listeventes->fraisport, 2, ',', ' ') : number_format($listeventes->espece_receptionne, 2, ',', ' ') }}</td>
                                 --}}
                                 <td>
                                    {{ $listeventes->espece_receptionne === null 
                                        ? number_format((float) (($listeventes->montant_totalhtliquide ?? 0) + ($listeventes->montant_totalhtemballage ?? 0) + ($listeventes->fraisport ?? 0)), 2, ',', ' ') 
                                        : number_format((float) $listeventes->espece_receptionne, 2, ',', ' ') 
                                    }}
                                </td>
                                

                                @if ($listeventes->client->exonerertva == 0 && $listeventes->client->exonererairsi == 0)
                                    <td>
                                        {{ number_format((float)
                                            $listeventes->espece_receptionne -
                                                ($listeventes->montant_totalhtliquide +
                                                    $listeventes->montant_totalhtemballage +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->fraisairsi->taux / 100) +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->tva->taux / 100) +
                                                    $listeventes->fraisport),
                                            2,
                                            ',',
                                            ' ',
                                        ) }}
                                    </td>
                                @elseif ($listeventes->client->exonerertva == 0 && $listeventes->client->exonererairsi == 1)
                                    <td>
                                        {{ number_format(
                                            $listeventes->espece_receptionne -
                                                ($listeventes->montant_totalhtliquide +
                                                    $listeventes->montant_totalhtemballage +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->tva->taux / 100) +
                                                    $listeventes->fraisport),
                                            2,
                                            ',',
                                            ' ',
                                        ) }}
                                    </td>
                                @elseif ($listeventes->client->exonerertva == 1 && $listeventes->client->exonererairsi == 0)
                                    <td>
                                        {{ number_format(
                                            $listeventes->espece_receptionne -
                                                ($listeventes->montant_totalhtliquide +
                                                    $listeventes->montant_totalhtemballage +
                                                    $listeventes->montant_totalhtliquide * ($listeventes->fraisairsi->taux / 100) +
                                                    $listeventes->fraisport),
                                            2,
                                            ',',
                                            ' ',
                                        ) }}
                                    </td>
                                @else
                                    <td>
                                        {{ number_format($listeventes->espece_receptionne - ($listeventes->montant_totalhtliquide + $listeventes->montant_totalhtemballage + $listeventes->fraisport), 2, ',', ' ') }}
                                    </td>
                                @endif

                                @if ($listeventes->validervente == 'valider')
                                    <td><strong class="alert alert-success"> Vente validée</strong> </td>
                                @elseif ($listeventes->validervente == 'encours')
                                    <td> <strong class="alert alert-primary">Vente en cours </strong></td>
                                @else
                                    <td> <strong class="alert alert-danger">Vente annulée</strong></td>
                                @endif
                                <td>


                                    @if ($listeventes->validervente == 'valider')
                                        <a class="me-3" href="#">
                                            <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                        </a>
                                    @elseif ($listeventes->validervente == 'encours')
                                        <a class="me-3" href="#">
                                            <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                        </a>
                                        <a class="btn btn-success" style="color: #ffff;" href="javascript:void(0);"
                                            onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir valider cette vente ?')) { document.getElementById('validate-form-{{ $listeventes->id }}').submit(); }">
                                            Valider
                                        </a>

                                        <form id="validate-form-{{ $listeventes->id }}"
                                            action="{{ route('admin.listeventes.listevalidervente', $listeventes->code_vente) }}"
                                            method="GET" style="display: none;">
                                            @method('GET')
                                            @csrf
                                        </form>
                                        <a class="btn btn-danger" style="color: #ffff;" href="javascript:void(0);"
                                            onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir annuler cette vente ?')) { document.getElementById('annuler-form-{{ $listeventes->id }}').submit(); }">
                                            Annuler
                                        </a>

                                        <form id="annuler-form-{{ $listeventes->id }}"
                                            action="{{ route('admin.listeventes.annulervente', $listeventes->code_vente) }}" method="GET"
                                            style="display: none;">
                                            @method('GET')
                                            @csrf
                                        </form>
                                    @else
                                        <a class="me-3" href="#">
                                            <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                        </a>
                                    @endif

                                </td>
                                <td>

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
