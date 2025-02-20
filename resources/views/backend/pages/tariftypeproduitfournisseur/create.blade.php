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
            <h4>Nouveau Tarif type produit fournisseur </h4>
            <h6>Créer nouveau Tarif type produit fournisseur</h6>
        </div>
    </div>

{{--    
    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.tariftypeproduitfournisseurs.store') }}" method="POST">
                @csrf


                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title fs-6 fs-md-2 fs-lg-5">Fournisseur/Type Produits</h5>
                            </div>
                            <div class="card-body">


                                <div class="form-group">
                                    <label>FOURNISSEUR</label>
                                    <select name="fournisseur_id" id="forunisseurId"  class="select" >
                                        <option value=""> Sélectionner un fournisseur </option>
                                        @foreach ($fournisseur as $fournisseurs)
                                            <option value="{{ $fournisseurs->id }}">{{ $fournisseurs->nom }}</option>
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
                                        value="{{ route('admin.tariftypeproduitfournisseurs.listeproduit', [':id1', ':id2']) }}">

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
                </div>
            </form>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.tariftypeproduitfournisseurs.store') }}" method="POST">
                @csrf


                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title fs-6 fs-md-2 fs-lg-5">Fournisseur/Type Produits</h5>
                            </div>
                            <div class="card-body">


                                <div class="form-group">
                                    <label>FOURNISSEUR</label>
                                    <select name="fournisseur_id" id="forunisseurId"  class="select" >
                                        <option value=""> Sélectionner un fournisseur </option>
                                        @foreach ($fournisseur as $fournisseurs)
                                            <option value="{{ $fournisseurs->id }}">{{ $fournisseurs->nom }}</option>
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
                                        value="{{ route('admin.tariftypeproduitfournisseurs.listeproduit', [':id1', ':id2']) }}">

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
                        <a href="{{ route('admin.tariftypeproduitfournisseurs.index') }}" class="btn btn-info">Retour</a>
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
<script>
    // $(document).ready(function() {

    //     $('#typeproduit_id, #forunisseurId').on('change', function() {
    //         const typeproduitId = $('#typeproduit_id').val();
    //         const forunisseurId = $('#forunisseurId').val();
    //         $('#listeprod').empty(); // Réinitialiser la liste des produits

    //         if (typeproduitId && forunisseurId) {
    //             const urlTemplate = $('#getUrlTemplate').val();
    //             const getUrl = urlTemplate.replace(':id1', typeproduitId).replace(':id2', forunisseurId);

    //             //console.log("URL générée :", getUrl); // Vérifier si l'URL est correcte
    //             $.ajax({
    //                 method: 'GET',
    //                 url: getUrl,
    //                 dataType: 'JSON',
    //                 success: function(response) {
    //                     console.log("Réponse reçue :",
    //                     response); // Vérifier la structure de la réponse
    //                     if (response.success) { // && response.listefinalproduits.length > 0
    //                         let content = `
    //                 <div class="row">
    //                     <div class="col-md-3">
    //                         <label class="mb-2">CODE PRODUITS</label>
    //                     </div>
    //                     <div class="col-md-5">
    //                         <label class="mb-2">PRODUITS</label>
    //                     </div>
    //                     <div class="col-md-3">
    //                         <label class="mb-2">TARIFS LIQUIDES</label>
    //                     </div>
    //                 </div>
    //             `;

    //                         $.each(response.listefinalproduits, function(index,
    //                             listeproduit) {
    //                             let format = listeproduit.format || '';
    //                             let emballage = listeproduit.emballage || '';
    //                             let produitName =
    //                                 `${listeproduit.libelle} ${format ? 'de ' + format : ''} ${emballage}`;

    //                             content += `
    //                     <div class="row">
    //                         <div class="col-md-3">
    //                             <div class="form-group">
    //                                 <input type="text" name="matriproduit[${listeproduit.id}]" value="${listeproduit.matriproduit}" disabled>
    //                                 <input type="hidden" name="produit_id[${listeproduit.id}]" value="${listeproduit.id}">
    //                             </div>
    //                         </div>
    //                         <div class="col-md-5">
    //                             <div class="form-group">
    //                                 <input type="text" name="produit_name[${listeproduit.id}]" value="${produitName.trim()}" disabled>
    //                             </div>
    //                         </div>
    //                         <div class="col-md-3">
    //                             <div class="form-group">
    //                                 <input type="text" name="tarifliquide[${listeproduit.id}]" placeholder="Ex: 15 000" required>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 `;
    //                         });

    //                         $('#listeprod').append(content);
    //                     } else {
    //                         $('#listeprod').append(
    //                             '<p>Aucun produit disponible pour ce type.</p>');
    //                     }
    //                 },
    //                 error: function(xhr, status, error) {
    //                     //console.error("Erreur Ajax :", error);
    //                     //$('#listeprod').append('<p>Une erreur est survenue.</p>');
    //                     $('#listeprod').append(
    //                         '<p>Aucun produit disponible pour ce type.</p>');
    //                 }
    //             });
    //         }
    //     });






    // })


         
$(document).ready(function () {
    $('#typeproduit_id, #forunisseurId').on('change', function () {
        // const typeproduitId = $('#typeproduit_id').val();
        // const typeclientId = $('#typeclientId').val();
        const typeproduitId = $('#typeproduit_id').val();
        const forunisseurId = $('#forunisseurId').val();
        const listeProd = $('#listeprod');
        listeProd.empty();

        if (typeproduitId && forunisseurId) {
            const urlTemplate = $('#getUrlTemplate').val();
            const getUrl = urlTemplate.replace(':id1', typeproduitId).replace(':id2', forunisseurId);
          
//alert(getUrl);
            $.ajax({
                method: 'GET',
                url: getUrl,
                dataType: 'JSON',
                success: function (response) {
                    console.log("Réponse AJAX :", response);

                    // Convertir listeProduitsNonTarifes en tableau
                    const produitsNonTarifes = response.listeProduitsNonTarifes 
                        ? Object.values(response.listeProduitsNonTarifes) 
                        : [];

                    const produitsTarifes = Array.isArray(response.listeProduitsTarifes) 
                        ? response.listeProduitsTarifes 
                        : [];

                    let content = `
                        <div class="row">
                            <div class="col-md-3"><label class="mb-2">CODE PRODUITS</label></div>
                            <div class="col-md-5"><label class="mb-2">PRODUITS</label></div>
                            <div class="col-md-3"><label class="mb-2">TARIFS LIQUIDES</label></div>
                        </div>
                    `;

                    const allProducts = [...produitsNonTarifes, ...produitsTarifes];

                    if (allProducts.length > 0) {
                        $.each(allProducts, function (index, produit) {
                            let tarif = produit.tarifliquide ? produit.tarifliquide : '';

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
                                            <input type="text" name="tarifliquide[${produit.id}]" value="${tarif}" placeholder="Ex: 15 000" ${tarif ? '' : 'required'}>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        content += '<p>Aucun produit disponible.</p>';
                    }

                    listeProd.append(content);
                },
                error: function (xhr, status, error) {
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
