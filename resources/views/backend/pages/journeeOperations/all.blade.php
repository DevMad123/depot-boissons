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
            <h4>Opérations</h4>
            {{-- <h6>Fermer la Journée du : {{ $journee->date_ouverture }}</h6> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <div class="container mt-5">
                <h1>Sélectionnez une journée</h1>
                <form id="selectionForm">
                    <div class="form-group">
                        <label for="journee_id">Journée :</label>
                        <select name="journee_id" id="journee_id" class="form-control" required>
                            <option value="">Choisir une journée</option>
                            @foreach ($journees as $journee)
                                <option value="{{ $journee->id }}">{{ $journee->nom }} ({{ $journee->date }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Voir les opérations</button>
                </form>

                <div id="listeOperations" class="mt-5">
                    <!-- Les résultats des opérations seront affichés ici -->
                </div>
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
    <script>
        $(document).ready(function () {
            $('#journee_id').on('change', function () {
                const journeeId = $('#journee_id').val();
                const listeOperations = $('#listeOperations');
                listeOperations.empty();

                if (journeeId) {
                    const urlTemplate = $('#getUrlTemplate').val();
                    const getUrl = urlTemplate.replace(':id', journeeId);

                    $.ajax({
                        method: 'GET',
                        url: getUrl,
                        dataType: 'JSON',
                        success: function (response) {
                            console.log("Réponse AJAX :", response);

                            const operations = response.listeOperations || [];

                            let content = `
                                <div class="row">
                                    <div class="col-md-3"><label class="mb-2">USERS</label></div>
                                    <div class="col-md-5"><label class="mb-2">PRODUITS</label></div>
                                    <div class="col-md-3"><label class="mb-2">TYPES OPERATIONS</label></div>
                                    <div class="col-md-3"><label class="mb-2">QUANTITES</label></div>
                                    <div class="col-md-3"><label class="mb-2">MONTANTS</label></div>
                                    <div class="col-md-3"><label class="mb-2">CREE LE</label></div>
                                </div>
                            `;

                            if (operations.length > 0) {
                                $.each(operations, function (index, operation) {

                                    content += `
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" value="${operation.user}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" value="${operation.produit}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" value="${operation.type_operation}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" value="${operation.quantite}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" value="${operation.montant}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" value="${operation.created_at}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                });
                            } else {
                                content += '<p>Aucune opération disponible.</p>';
                            }

                            listeOperations.append(content);
                        },
                        error: function (xhr, status, error) {
                            console.error("Erreur Ajax :", error);
                            listeOperations.append('<p>Aucune opération disponible.</p>');
                        }
                    });
                }
            });
        });
    </script>
@endsection
