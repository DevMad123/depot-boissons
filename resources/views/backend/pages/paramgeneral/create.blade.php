@extends('backend.layouts.apps')
{{-- 
@section('title')
    {{ __('Admins - Admin Panel') }}
@endsection --}}

@section('styles')
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.jpg') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">

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
            <h4>Nouveau approvisionnement</h4>
            <h6>Créer nouveau approvisionnement</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.approvisionnements.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="produit_id">Produit</label>
                            <select name="produit_id" class="select">
                                <option value=""> Sélectionner un Produit </option>
                                @foreach ($produits as $produits)
                                    <option value="{{ $produits->id }}">
                                        {{ $produits->libelle . ' de ' . $produits->taille->taille . '  ' . $produits->emballage->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="fournisseur_id">Fournisseur </label>
                            <select name="fournisseur_id" class="select">
                                <option value=""> Sélectionner un Fournisseur </option>
                                @foreach ($fournisseurs as $fournisseurs)
                                    <option value="{{ $fournisseurs->id }}">{{ $fournisseurs->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nombre d'emballage </label>
                            <input type="text" name="nbre_emballage" placeholder="Entrer le nombre d'emballage" autofocus
                                value="{{ old('nbre_emballage') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Prix Achat Unitaire (d'un emballage)</label>
                            <input type="text" name="achat_unitaire"
                                placeholder="Entrer le prix achat Unitaire d'emballage" autofocus
                                value="{{ old('achat_unitaire') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Prix Vente Unitaire (d'un emballage)</label>
                            <input type="text" name="vente_unitaire"
                                placeholder="Entrer le prix vente unitaire d'emballage" autofocus
                                value="{{ old('vente_unitaire') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date d'approvisionnement </label>
                            <input type="text" class="datetimepicker"  placeholder="JJ-MM-AAAA" name="date_approvisionnement" autofocus
                                value="{{ old('date_approvisionnement') }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Enregistrer</button>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
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

<script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/script.js') }}"></script>
@endsection
