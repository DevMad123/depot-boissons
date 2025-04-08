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
    <link rel="stylesheet" href="{{ asset('backend/assets/css/datatable.css') }}">
@endsection

@section('admin-content')
    <div class="page-header">
        <div class="page-title">
            <h4>Liste d'opérations </h4>
            <h6>Veuillez choisir une journée</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <div class="row">
                <div class="table-responsive">
                    <div class="form-group">
                        <label>Journée</label>
                        <select name="journee" id="journee_id" class="select">
                            <option value=""> Sélectionner un type de Client </option>
                            @foreach ($journees as $journee)
                                @php
                                    $dateOuverture = \Carbon\Carbon::parse($journee->date_ouverture);
                                    $dateFermeture = isset($journee->date_fermeture) ? \Carbon\Carbon::parse($journee->date_fermeture) : null;

                                    if ($dateFermeture) {
                                        $jName = 'Du ' . $dateOuverture->translatedFormat('d F Y \à H\hi\ms\s') . ' Au ' . $dateFermeture->translatedFormat('d F Y \à H\hi\ms\s');
                                    } else {
                                        $jName = 'Journée en cours débutée le ' . $dateOuverture->translatedFormat('d F Y \à H\hi\ms\s');
                                    }
                                @endphp
                                <option value="{{ $journee->id }}">{{ $jName }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="getUrlTemplate"
                            value="{{ route('admin.operations.operationsParJourneeId', [':id']) }}">
                    </div>
                    <table class="table  datanew table-striped" id="example">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    N°
                                </th>
                                <th>Utilisateur</th>
                                <th>Produit</th>
                                <th>Type</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-center">Montant</th>
                                <th class="text-center">Date Création</th>
                            </tr>
                        </thead>
                        <tbody id="listeOperations">

                        </tbody>
                    </table>
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

    <script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#journee_id').on('change', function () {
                const journeeId = $('#journee_id').val();
                const listeOperations = $('#listeOperations');
                console.log(journeeId);
                listeOperations.empty();

                if (journeeId) {
                    const urlTemplate = $('#getUrlTemplate').val();
                    const getUrl = urlTemplate.replace(':id', journeeId);
                    console.log(getUrl);

                    $.ajax({
                        method: 'GET',
                        url: getUrl,
                        dataType: 'JSON',
                        success: function (response) {
                            console.log("Réponse AJAX :", response);

                            const operations = response.listeOperations || [];

                            let content = '';

                            if (operations.length > 0) {
                                $.each(operations, function (index, operation) {

                                    const montantFormate = operation.montant ? parseFloat(operation.montant).toLocaleString('fr-FR', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }) : 'N/A';

                                    const dateFormatee = operation.created_at ? new Date(operation.created_at).toLocaleDateString('fr-FR', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    }) : 'N/A';

                                    content += `
                                    <tr>
                                        <td class="text-center">${index + 1}</td>
                                        <td>${operation.user || 'N/A'}</td>
                                        <td>${operation.produit || 'N/A'}</td>
                                        <td>${operation.type_operation || 'N/A'}</td>
                                        <td>${operation.quantite || 'N/A'}</td>
                                        <td class="text-center">${montantFormate}</td>
                                        <td class="text-center">${dateFormatee}</td>
                                    </tr>
                                    `;
                                });
                            } else {
                                content = '<tr><td colspan="7" class="text-center">No data available in table</td></tr>';

                            }
                            listeOperations.append(content);
                        },
                        error: function (xhr, status, error) {
                            console.error("Erreur Ajax :", error);
                            listeOperations.append('<tr><td colspan="7" class="text-center">No data available in table</td></tr>');
                        }
                    });
                }
            });
        });
    </script>
@endsection
