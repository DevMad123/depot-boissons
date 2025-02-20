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
            <h4>Nouveau Client</h4>
            <h6>Enregistrer un nouveau Client</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')
                    
            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf
            <div class="row">
               

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Nom de l'entreprise</label>
                        <input type="text"  name="nom" placeholder="Entrer le nom de l'entreprise"  autofocus value="{{ old('nom') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text"  name="email" placeholder="Entrer l'e-mail"  autofocus value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text"  name="telephone" placeholder="Entrer numéro de téléphone"  autofocus value="{{ old('telephone') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text"  name="adress" placeholder="Entrer une  adress "  autofocus value="{{ old('adress') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Exonéré TVA </label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="validationFormCheckport2" name="fraistva"
                                checked value="1">
                            <label class="form-check-label" for="validationFormCheckport2">Oui</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="radio" class="form-check-input" id="validationFormCheckport3"
                                name="fraistva" value="0">
                            <label class="form-check-label" for="validationFormCheckport3">Non</label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Exonéré AIRSI </label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="validationFormCheckfrais2" name="fraisairsi"
                                checked value="1">
                            <label class="form-check-label" for="validationFormCheckfrais2">Oui</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="radio" class="form-check-input" id="validationFormCheckfrais3"
                                name="fraisairsi" value="0">
                            <label class="form-check-label" for="validationFormCheckfrais3">Non</label>
                        </div>
                        

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Solde</label>
                        <input type="text"  name="solde" placeholder="Entrer le solde"  autofocus value="{{ old('solde') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Type de client</label>
                        <select name="typeclient_id"  class="select" >
                            <option value=""> Sélectionner un type de client </option>
                            @foreach ($typeclients as $typeclient)
                                <option value="{{ $typeclient->id }}">{{ $typeclient->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file"  name="logo"  >
                    </div>
                </div> --}}
                
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
