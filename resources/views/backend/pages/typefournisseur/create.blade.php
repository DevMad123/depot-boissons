
@extends('backend.layouts.master')

@section('title')
Admin Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Enregistrer Clients</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                    <li><a href="{{ route('admin.admins.index') }}">Tous les Clients</a></li>
                    <li><span>Enregistrer Client</span></li>
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
                    <h4 class="header-title">Enregistrer Clients</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="nom">Nom </label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom  "  autofocus value="{{ old('nom') }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="prenom">Prénom(s) </label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le prénom(s) " autofocus value="{{ old('prenom') }}">
                            </div>
                        </div><div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">E-mail </label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Entrer l'e-mail "  autofocus value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="telephone">Téléphone </label>
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Entrer le téléphone " autofocus value="{{ old('telephone') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="adresse">Adresse</label>
                                <input type="texte" class="form-control" id="adresse" name="adresse" placeholder="Entrer le adresse" autofocus  value="{{ old('adresse') }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="solde">Solde</label>
                                <input type="texte" class="form-control" id="solde" name="solde" placeholder="Entrer le solde" autofocus  value="{{ old('solde') }}">
                            </div>
                        </div>

                        <div class="form-row">
                           
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-4 pr-4 pl-4">Enregistrer</button>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-danger mt-4 pr-4 pl-4">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection