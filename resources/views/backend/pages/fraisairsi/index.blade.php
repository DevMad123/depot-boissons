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
            <h4>Liste des Frais AIRSI</h4>
            <h6>Gérez vos  Frais AIRSI</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.fraisairsis.create') }}" class="btn btn-added"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}"
                    alt="img" class="me-1">Nouveau  Frais AIRSI</a>
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
                            <th  class="text-center">
                                N°
                            </th>
                            <th  class="text-center">Taux</th>
                            <th  class="text-center">Status</th>
                            <th  class="text-center">Date Création</th>
                            <th  class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fraisairsis as $fraisairsis)
                            <tr>
                                <td  class="text-center">{{ $loop->index+1 }}</td> 
                                    <td  class="text-center">{{ $fraisairsis->taux.' '.$fraisairsis->symbol }}</td>
                                    <td  class="text-center">
                                        @if ($fraisairsis->status ==1)
                                        <span class="text-green">Activé</span>
                                        @else
                                        <span class="text-red">Désactivé</span>
                                        @endif
                                    </td>
                                    <td  class="text-center">{{ \Carbon\Carbon::parse($fraisairsis->created_at)->format('d-m-Y à H:i') }}</td>
                                <td  class="text-center">
                                    @if ($fraisairsis->status ==1)
                                        Activé
                                        @else
                                        
                                        @if (auth()->user()->can('admin.delete'))
                                        <a class="btn btn-success" style="color: #ffff;"  href="javascript:void(0);"
                                                onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir activer ?')) { document.getElementById('delete-form-{{ $fraisairsis->id }}').submit(); }">
                                                Activer
                                            </a>

                                        <form id="delete-form-{{ $fraisairsis->id }}"
                                            action="{{ route('admin.fraisairsis.destroy', $fraisairsis->id) }}" method="POST"
                                            style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    @endif
                                        
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
