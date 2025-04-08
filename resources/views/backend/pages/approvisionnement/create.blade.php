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
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="row">

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="produit_id">Produit</label>
                            <select name="produit_id" id="produitSelect" class="select">
                                <option value=""> Sélectionner un Produit </option>
                                @foreach ($produits as $produits)
                                    <option value="{{ $produits->id }}">
                                        {{ $produits->libelle . ' de ' . $produits->format->format . '  ' . $produits->emballage->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- URL template avec un placeholder -->
                        <input type="hidden" id="getUrlTemplate"
                            value="{{ route('admin.approvisionnements.gettypefournisseur', ':id') }}">
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Fournisseur prix </label>

                            <select name="tariftypeproduitfournisseur_id" id="tariftypeproduitfournisseur" class="select">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Quantité </label>
                            <input type="text" name="quantite" placeholder="Entrer la quantité" autofocus
                                value="{{ old('quantite') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date d'approvisionnement </label>
                            <input type="text" class="datetimepicker" placeholder="JJ-MM-AAAA"
                                name="date_approvisionnement" autofocus value="{{ old('date_approvisionnement') }}">
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

    <script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#produitSelect').on('change', function() {
                const produitId = $(this).val();

                // Réinitialiser le select des fournisseurs
                $('#tariftypeproduitfournisseur').empty().append(
                    '<option value="">-- Sélectionner un fournisseur --</option>').prop('disabled',
                    true);


                if (produitId) {
                    // alert( produitId );

                    // Récupérer l'URL dynamique depuis l'attribut caché
                    const urlTemplate = $('#getUrlTemplate').val();

                    // Remplacer :id par l'ID du produit sélectionné
                    const getUrl = urlTemplate.replace(':id', produitId);
                    //alert( getUrl );
                    // Requête Ajax pour obtenir les fournisseurs
                    $.ajax({
                        method: 'GET',
                        url: getUrl,
                        dataType: 'JSON',
                        success: function(response) {

                            if (response.success) {
                                // Remplir le select avec les fournisseurs
                                $.each(response.fournisseurs, function(index,
                                    fournisseur) {
                                    //alert(tariftypeproduitfournisseur.typefournisseur_id);

                                    $('#tariftypeproduitfournisseur').append('<option value="' +
                                        fournisseur.id + '">' +
                                        fournisseur.nom +
                                        ' - Prix Unitaire : ' +
                                        fournisseur.tarif +' XOF</option>');
                                });

                                $('#tariftypeproduitfournisseur').prop('disabled',
                                false); // Activer le select
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            //alert('ERREUR');
                            $('#tariftypeproduitfournisseur').prop('disabled', false); // Activer le select
                        }
                    });
                } else {
                    $('#suppliersList').empty();
                }
            });


        });
    </script>
@endsection
