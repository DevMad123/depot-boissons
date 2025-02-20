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
            <h4>Nouvelle vente</h4>
            <h6>Effectuer nouvelle vente</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.partials.messages')


           

                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio_defini"
                                    checked>
                                <label class="form-check-label" for="validationFormCheck2">Client Prédéfini</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="radio" class="form-check-input" id="validationFormCheck3"
                                    name="radio_nondefini">
                                <label class="form-check-label" for="validationFormCheck3">Client non Défini</label>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.traitementventeclientdefinis.store') }}" method="POST">
                    @csrf
                    @method('POST')
                <div class="row" id="clientdefini">

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Client</label>
                            <select name="client_id" id="client_id" class="select">
                                <option value="">----- Sélectionner un client -----</option>
                                @foreach ($clients as $clients)
                                    <option value="{{ $clients->id }}">{{ $clients->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12" id="fraisport">
                        <div class="form-group">
                            <label>Frais de port</label>
                            <input type="text" name="fraisport" placeholder="Entrer le frais de port">
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
                        <button type="submit" class="btn btn-submit me-2">Ajouter</button>
                    </div>
                </div>

            </form>


            <form action="{{ route('admin.traitementventeclients.store') }}" method="POST">
                @csrf
                    @method('POST')
                
                {{-- Client non défini --}}
                <div class="row" id="clientnondefini">

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nom du client </label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                placeholder="Entrer le nom  " autofocus value="{{ old('nom') }}">

                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>E-mail </label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Entrer l'e-mail " autofocus value="{{ old('email') }}">

                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Téléphone </label>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                placeholder="Entrer le téléphone " autofocus value="{{ old('telephone') }}">

                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Adresse</label>
                            <input type="texte" class="form-control" id="adresse" name="adresse"
                                placeholder="Entrer le adresse" autofocus value="{{ old('adresse') }}">

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
                            <label>Type client</label>
                            <select name="typeclient_id" id="typeclient_id" class="select">
                                <option value="">----- Sélectionner le type client -----</option>
                                @foreach ($typeclients as $typeclients)
                                    <option value="{{ $typeclients->id }}">{{ $typeclients->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Frais de port </label>
                            <input type="text" class="form-control" id="fraisport" name="fraisport"
                                placeholder="Entrer le frais de port " autofocus value="{{ old('fraisport') }}">

                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
                        <button type="submit" class="btn btn-submit me-2">Ajouter</button>
                    </div>
                </div>
            </form>
            {{-- @endif --}}
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

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script>
        $(document).ready(function() {

            // $('#clientdefini').hide();
            $('#clientnondefini').hide();
            // Ajouter un événement au clic sur les boutons radio
            $('#validationFormCheck2').on('click', function() {
                // Si "Client Prédéfini" est sélectionné, afficher l'input
                $('#validationFormCheck3').prop('checked', false);
                $(this).prop('checked', true);
                $('#clientnondefini').hide();
                $('#clientdefini').show();
            });
            // Ajouter un événement au clic sur les boutons radio
            $('#validationFormCheck3').on('click', function() {
                // Si "Client Prédéfini" est sélectionné, afficher l'input
                $('#validationFormCheck2').prop('checked', false);
                $(this).prop('checked', true);
                $('#clientdefini').hide();
                $('#clientnondefini').show();
            });





        });
    </script>
@endsection
