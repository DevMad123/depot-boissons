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
            <h4>Journée du {{ \Carbon\Carbon::parse($journee->date_ouverture)->translatedFormat('d F Y \à H\hi\ms\s') }}</h4>
            <h6>Gérez vos Opérations</h6>
        </div>
        {{-- <div class="page-btn">
            <a href="{{ route('admin.journees.create') }}" class="btn btn-added"><img
                    src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouvelle Journée</a>
        </div> --}}
    </div>

    <div class="card">
        <div class="card-body">
            @include('backend.layouts.composants.messages')
            @if(isset($emptyMessage))
                <div class="alert alert-danger">
                    {{ $emptyMessage }}
                </div>
            @endif
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
                            <th>Utilisateur</th>
                            <th>Journee</th>
                            <th>Produit</th>
                            <th>Type</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">Date Création</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($operations as $operation)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td>{{ $operation->user_id  ?? 'N/A' }}</td>
                                <td>{{ $operation->journee_id ?? 'N/A' }}</td>
                                <td>{{ $operation->produit_id ?? 'N/A' }}</td>
                                <td>{{ $operation->type_operation ?? 'N/A' }}</td>
                                <td>{{ $operation->quantite ?? 'N/A' }}</td>
                                <td class="text-center">
                                    {{ number_format($operation->montant, 2, ',', ' ') ?? 'N/A' }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($operation->created_at)->format('d-m-Y à H:i') }}
                                </td>
                                <td>
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{ asset('backend/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                    @if (Auth::guard('admin')->user()->can('journees.edit'))
                                        <a class="me-3" href="{{ route('admin.inventaires.form', $operation->id) }}"><img src="{{ asset('backend/assets/img/icons/edit.svg') }}" alt="img"></a>
                                    @endif
                                    @if (auth()->user()->can('admin.delete'))
                                        <a class="confirm-text" href="javascript:void(0);"
                                            onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir supprimer?')) { document.getElementById('delete-form-{{ $operation->id }}').submit(); }">
                                            <img src="{{ asset('backend/assets/img/icons/delete.svg') }}" alt="img">
                                        </a>

                                        <form id="delete-form-{{ $operation->id }}"
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
