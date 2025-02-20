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
@endsection

@section('admin-content')
    <div class="page-header">
        <div class="page-title">
            <h4>Nouveau produit</h4>
            <h6>Créer nouveau produit</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')
                    
            <form action="{{ route('admin.produits.store') }}" method="POST">
                @csrf
            <div class="row">
               

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Libelle</label>
                        <input type="text"  name="libelle" placeholder="Entrer libelle ( Ex : Coca Cola, Heineken)"  autofocus value="{{ old('libelle') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Emballage ( Ex : Casier de 15)</label>
                        <select name="emballage"  class="select" >
                            <option value=""> Sélectionner un type d'emballage </option>
                            @foreach ($emballages as $emballages)
                                <option value="{{ $emballages->id }}">{{ $emballages->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Type de Produit  ( Ex : Alcool)</label>
                                <select name="typeproduit" class="select" >
                                    <option value=""> Sélectionner  type de produit </option>
                                    @foreach ($typeproduits as $typeproduits)
                                        <option value="{{ $typeproduits->id }}">{{ $typeproduits->libelle }}</option>
                                    @endforeach
                                </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Format  ( Ex : 50L)</label>
                                <select name="taille" class="select" >
                                    <option value=""> Sélectionner une Format du produit </option>
                                    @foreach ($formats as $format)
                                        <option value="{{ $format->id }}">{{ $format->format }}</option>
                                    @endforeach
                                </select>
                    </div>
                </div>
                <div class="text-end">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
                    <button type="submit" class="btn btn-submit me-2">Enregistrer</button>

                </div>
            
            </div>
        </form>
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
