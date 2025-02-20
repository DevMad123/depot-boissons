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
            <h4>Nouveau Tarif type produit emb. client </h4>
            <h6>Créer nouveau Tarif type produit emb. client</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.tariftypeproduitembclients.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title fs-6 fs-md-2 fs-lg-5">Type Client/Type Produits</h5>
                            </div>
                            <div class="card-body">


                                <div class="form-group">
                                    <label>TYPE CLIENT</label>
                                    <select name="typeclient" id="typeclientId" class="select">
                                        <option value=""> Sélectionner un type de Client </option>
                                        @foreach ($typeclient as $typeclients)
                                            <option value="{{ $typeclients->id }}">{{ $typeclients->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>TYPE PRODUITS</label>
                                    <select name="typeproduit_id" id="typeproduit_id" class="select">
                                        <option value=""> Sélectionner un type de produit </option>
                                        @foreach ($typeproduit as $typeproduits)
                                            <option value="{{ $typeproduits->id }}">{{ $typeproduits->libelle }}</option>
                                        @endforeach
                                    </select>
                                    <!-- URL template avec un placeholder 2 -->
                                    <input type="hidden" id="getUrlTemplate"
                                        value="{{ route('admin.tariftypeproduitembclients.listeproduit', [':id1', ':id2']) }}">

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Liste de Boissons</h5>
                            </div>
                            <div class="card-body overflow-auto" id="listeprod" style="max-height: 500px;">

                            </div>

                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
                        <button type="submit" class="btn btn-submit me-2">Enregistrer</button>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('admin.tariftypeproduitembclients.index') }}" class="btn btn-info">Retour</a>
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
            $('#typeproduit_id, #typeclientId').on('change', function() {
                const typeproduitId = $('#typeproduit_id').val();
                const typeclientId = $('#typeclientId').val();
                const listeProd = $('#listeprod');
                listeProd.empty();

                if (typeproduitId && typeclientId) {
                    const urlTemplate = $('#getUrlTemplate').val();
                    const getUrl = urlTemplate.replace(':id1', typeproduitId).replace(':id2', typeclientId);

                    $.ajax({
                        method: 'GET',
                        url: getUrl,
                        dataType: 'JSON',
                        success: function(response) {
                            console.log("Réponse AJAX :", response);

                            // Convertir listeProduitsNonTarifes en tableau
                            const produitsNonTarifes = response.listeProduitsNonTarifes ?
                                Object.values(response.listeProduitsNonTarifes) :
                                [];

                            const produitsTarifes = Array.isArray(response
                                .listeProduitsTarifes) ?
                                response.listeProduitsTarifes :
                                [];

                            let content = `
                        <div class="row">
                            <div class="col-md-3"><label class="mb-2">CODE PRODUITS</label></div>
                            <div class="col-md-5"><label class="mb-2">PRODUITS</label></div>
                            <div class="col-md-3"><label class="mb-2">TARIFS LIQUIDES</label></div>
                        </div>
                    `;

                            const allProducts = [...produitsNonTarifes, ...produitsTarifes];

                            if (allProducts.length > 0) {
                                $.each(allProducts, function(index, produit) {
                                    let tarif = produit.tarifemballage ? produit
                                        .tarifemballage : '';
                                    let typeemballage = produit.typeemballage || '';




                                    if (typeemballage == 'Casier') {

                                        content += `
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="matriproduit[${produit.id}]" value="${produit.matriproduit}" disabled>
                                            <input type="hidden" name="produit_id[${produit.id}]" value="${produit.id}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="produit_name[${produit.id}]" value="${produit.libelle}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="tarifemballage[${produit.id}]" value="${tarif}" placeholder="Ex: 15 000" ${tarif ? '' : 'required'}>
                                        </div>
                                    </div>
                                </div>
                            `;

                                    } else {



                                        content += `
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="matriproduit[${produit.id}]" value="${produit.matriproduit}" disabled>
                                            <input type="hidden" name="produit_id[${produit.id}]" value="${produit.id}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="produit_name[${produit.id}]" value="${produit.libelle}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="tarifemballage[${produit.id}]" value="0"  readonly>
                                        </div>
                                    </div>
                                </div>
                            `;
                                        // <input type="text" name="tarifemballage[${produit.id}]" value="${tarif}" placeholder="Ex: 15 000" ${tarif ? '' : 'required'} readonly>



                                    } // Fin de if type emballage



                                });
                            } else {
                                content += '<p>Aucun produit disponible.</p>';
                            }

                            listeProd.append(content);
                        },
                        error: function(xhr, status, error) {
                            console.error("Erreur Ajax :", error);
                            // alert("Une erreur est survenue. Veuillez réessayer.");
                            listeProd.append('<p>Aucun produit disponible.</p>');
                        }
                    });
                }
            });
        });
    </script>
@endsection
