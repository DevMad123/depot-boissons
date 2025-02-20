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

            <form action="{{ route('admin.traitementventes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="produit_id">Produit</label>
                            <select name="produit_id" id="produitSelect" class="select">
                                <option value="">----- Sélectionner un Produit -----</option>
                                @foreach ($produits as $produits)
                                    <option value="{{ $produits->id }}">
                                        {{ $produits->libelle . ' de ' . $produits->format->format . '  ' . $produits->emballage->libelle }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- URL template avec un placeholder -->
                            <input type="hidden" id="getUrlTemplate"
                                value="{{ route('admin.traitementventes.gettarifproduitclient', ':id') }}">
                            <!-- URL template avec un placeholder 2 -->
                            <input type="hidden" id="getUrlTemplate2"
                                value="{{ route('admin.traitementventes.produitcasier', ':id') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Prix de vente Unitaire Liquide </label>
                            <select name="tariftypeproduitclient_id" id="prixventeunitliq" class="select">
                            </select>
                        </div>
                    </div>
                    {{-- AU CAS OU EMBALLAGE PLASTIQUE OU AUTRE AFFICHER CA --}}
                    <div class="col-lg-3 col-sm-6 col-12" id="embautre">
                        <div class="form-group">
                            <label>Quantité Boisson Achetée</label>
                            <input type="text" name="quantiteachete" id="embautreinput"
                                placeholder="Entrer la quantité boisson " autofocus value="{{ old('quantiteachete') }}">
                        </div>
                    </div>
                    {{-- AU CAS OU EMBALLAGE CASIER AFFICHER CA --}}
                    <div class="col-lg-3 col-sm-6 col-12" id="divquantiteachete">
                        <div class="form-group">
                            <label>Quantité Boisson Achetée</label>
                            <input type="text" name="quantiteachete" id="quantiteachete"
                                placeholder="Entrer la quantité d'emballage " autofocus
                                value="{{ old('quantiteachete') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12" id="divquantiteretourne">
                        <div class="form-group">
                            <label>Quantité Casier Retournée </label>
                            <input type="text" name="quantiteretourne" id="quantiteretourne"
                                placeholder="Entrer la quantité d'emballage " autofocus
                                value="{{ old('quantiteretourne') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12" id="divprixventeunitemb">
                        <div class="form-group">
                            <label for="quantite_vendu">Prix de vente Unitaire Emballage </label>
                            <select name="prixventeunitemb" id="prixventeunitemb" class="select">
                            </select>
                            <!-- URL template avec un placeholder 2 -->
                            <input type="hidden" id="getUrlTemplate3"
                                value="{{ route('admin.traitementventes.prixventeembcasier', ':id') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="date_vente">Date Vente</label>
                            <input type="text" class="datetimepicker" name="date_vente" placeholder="JJ-MM-AAAA"
                                autofocus value="{{ old('date_vente') }}">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-submit me-2 mb-2">Ajouter</button>
                    </div>
                </div>
            </form>
            @if (count($traitementventes) > 0)
                <div class="row">
                    <div class="table-responsive">

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label><strong>Nom du client :</strong> {{ $clientsinfos[0]->nom ?? 'N/A' }} </label>
                                <label><strong>E-mail :</strong> {{ $clientsinfos[0]->email ?? 'N/A' }} </label>
                                <label><strong>Téléphone :</strong> {{ $clientsinfos[0]->telephone ?? 'N/A' }} </label>
                                <label>
                                    <strong>Exonéré TVA :</strong>
                                    @if ($clientsinfos[0]->exonerertva ?? 0 == 1)
                                        Oui
                                    @else
                                        Non
                                    @endif
                                </label>

                                <label for="quantite_vendu">
                                    <strong>Exonéré AIRSI :</strong>
                                    @if ($clientsinfos[0]->exonererairsi ?? 0 == 1)
                                        Oui
                                    @else
                                        Non
                                    @endif
                                </label>

                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Désignation</th>
                                    <th>Quantité Liquid.</th>
                                    <th>P.U HT Liquid. (XOF)</th>
                                    <th>Total HT Liquid. (XOF)</th>
                                    <th>Quantité Emb.</th>
                                    <th>P.U HT (XOF)</th>
                                    <th>Total HT Emb. (XOF)</th>
                                    <th>Date Vente </th>
                                    <th>Date Création</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($traitementventes as $traitementventes)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="productimgname">
                                            {{ $traitementventes->produit->libelle . ' de ' . $traitementventes->produit->format->format . '  ' . $traitementventes->produit->emballage->libelle }}
                                        </td>
                                        {{-- $produits->approvisionnements->first()->vente_unitaire --}}
                                        <td>{{ $traitementventes->quantite }}</td>
                                        <td>{{ number_format($traitementventes->tariftypeproduitclient->tarifliquide ?? 0, 2, ',', ' ') }}
                                        </td>
                                        <td>{{ number_format($traitementventes->prix_vente_totalliquide, 0, ',', ' ') }}
                                        </td>
                                        <td>{{ number_format($traitementventes->quantite - $traitementventes->quantite_emb_retour ?? 0, 0, ',', ' ') }}
                                        </td>
                                        <td>{{ number_format($traitementventes->tariftypeproduitembclient->tarifemballage ?? 0, 2, ',', ' ') }}
                                        </td>
                                        <td>{{ number_format($traitementventes->prix_vente_totalemb, 0, ',', ' ') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($traitementventes->date_vente)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($traitementventes->created_at)->format('d-m-Y à H:i') }}
                                        </td>
                                        <td>
                                            @if (auth()->user()->can('admin.delete'))
                                                <a href="javascript:void(0);"
                                                    onclick="event.preventDefault(); if(confirm('Êtes vous sûr de vouloir supprimer?')) { document.getElementById('delete-form-{{ $traitementventes->id }}').submit(); }"
                                                    class="delete-set"><img
                                                        src="{{ asset('backend/assets/img/icons/delete.svg') }}"
                                                        alt="svg"></a>
                                                <form id="delete-form-{{ $traitementventes->id }}"
                                                    action="{{ route('admin.traitementventes.destroy', $traitementventes->id) }}"
                                                    method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{ route('admin.ventevaliders.store') }}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="col-lg-4 float-md-left">
                            <div class="total-order">


                                @if (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                    <ul>
                                        <li>
                                            <h4>Total HT Liquide</h4>
                                            <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Liquide ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                            <h5>0 XOF</h5>
                                        </li>
                                        <li>
                                            <h4>AIRSI Liquide (
                                                {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5> 0 XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total TTC Liquide</h4>
                                            <h5>{{ number_format($totalht, 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Liquide</h4>
                                            <h5>
                                                {{ number_format($totalht, 2, ',', ' ') }}
                                                XOF</h5>
                                            {{-- <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format( $totalht, 0, ',', ' ') }}"> --}}
                                        </li>
                                    </ul>
                                @elseif (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 0)
                                    <ul>
                                        <li>
                                            <h4>Total HT Liquide</h4>
                                            <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Liquide ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                            <h5>0 XOF</h5>
                                        </li>
                                        <li>
                                            <h4>AIRSI Liquide (
                                                {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5> {{ number_format($totalht * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                XOF
                                            </h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total TTC Liquide</h4>
                                            <h5>{{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Liquide</h4>
                                            <h5>{{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}
                                                XOF</h5>
                                            {{-- <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht, 0, ',', ' ') }}"> --}}

                                        </li>
                                    </ul>
                                @elseif (($clientsinfos[0]->exonerertva ?? 0) == 0 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                    <ul>
                                        <li>
                                            <h4>Total HT Liquide</h4>
                                            <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Liquide ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                            <h5>{{ number_format($totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }} XOF
                                            </h5>
                                        </li>
                                        <li>
                                            <h4>AIRSI Liquide (
                                                {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5>0 XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total TTC Liquide</h4>
                                            <h5>{{ number_format($totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Liquide</h4>
                                            <h5>{{ number_format($totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                            {{-- <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format( $totalht + $totalht * ($tvas[0]->taux / 100), 0, ',', ' ') }}"> --}}

                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        <li>
                                            <h4>Total HT Liquide</h4>
                                            <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Liquide ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                            <h5>{{ number_format($totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }} XOF
                                            </h5>
                                        </li>
                                        <li>
                                            <h4>AIRSI Liquide (
                                                {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5> {{ number_format($totalht * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                XOF
                                            </h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total TTC Liquide</h4>
                                            <h5>{{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Liquide</h4>
                                            <h5>
                                                {{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                            {{-- <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format( $totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 0, ',', ' ') }}"> --}}

                                        </li>
                                    </ul>
                                @endif

                            </div>
                        </div>

                        <div class="col-lg-8 float-md-right">
                            <div class="total-order">


                                @if (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                    <ul>
                                        <li>
                                            <h4>Total HT Emballage</h4>
                                            <h5>{{ number_format($totalhtemb, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Emballage ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )
                                            </h4>
                                            <h5>0 XOF</h5>
                                        </li>
                                        <li>
                                            <h4>AIRSI Emballage (
                                                {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5> 0 XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total TTC Emballage</h4>
                                            <h5>{{ number_format($totalhtemb, 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Emballage</h4>
                                            <h5>
                                                {{ number_format($totalhtemb, 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                    </ul>
                                @elseif (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 0)
                                    <ul>
                                        <li>
                                            <h4>Total HT Emballage</h4>
                                            <h5>{{ number_format($totalhtemb, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Emballage ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )
                                            </h4>
                                            <h5>0 XOF</h5>
                                        </li>
                                        {{-- <li>
                                            <h4>AIRSI Emballage ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5> {{ number_format($totalhtemb * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                XOF
                                            </h5>
                                        </li> --}}
                                        <li class="total">
                                            <h4>Total TTC Emballages</h4>
                                            <h5>{{ number_format($totalhtemb, 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Emballage</h4>
                                            <h5>{{ number_format($totalhtemb, 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                    </ul>
                                @elseif (($clientsinfos[0]->exonerertva ?? 0) == 0 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                    <ul>
                                        <li>
                                            <h4>Total HT Emballage</h4>
                                            <h5>{{ number_format($totalhtemb, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Emballage ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )
                                            </h4>
                                            <h5>{{ number_format($totalhtemb * ($tvas[0]->taux / 100), 2, ',', ' ') }} XOF
                                            </h5>
                                        </li>
                                        {{-- <li>
                                            <h4>AIRSI Emballage ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5>0 XOF</h5>
                                        </li> --}}
                                        <li class="total">
                                            <h4>Total TTC Emballage</h4>
                                            <h5>{{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Emballage</h4>
                                            <h5>{{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                            {{-- <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100), 0, ',', ' ') }}"> --}}

                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        <li>
                                            <h4>Total HT Emballage</h4>
                                            <h5>{{ number_format($totalhtemb, 0, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li>
                                            <h4>TVA Emballage ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )
                                            </h4>
                                            <h5>{{ number_format($totalhtemb * ($tvas[0]->taux / 100), 2, ',', ' ') }} XOF
                                            </h5>
                                        </li>
                                        {{-- <li>
                                            <h4>AIRSI Emballage ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                            <h5> {{ number_format($totalhtemb * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                XOF
                                            </h5>
                                        </li> --}}
                                        <li class="total">
                                            <h4>Total TTC Emballage</h4>
                                            <h5>{{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Total Facture Emballage</h4>
                                            <h5>
                                                {{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                XOF</h5>
                                            {{-- <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($totalhtemb * ($fraisairsis[0]->taux / 100) + $totalhtemb + $totalhtemb * ($tvas[0]->taux / 100), 0, ',', ' ') }}"> --}}

                                        </li>
                                    </ul>
                                @endif

                            </div>
                        </div>
                    </div>
                    {{-- TOTAUX DES FACTURES --}}
                    <div class="row ">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">


                                @if (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                    <ul>
                                        <li class="total">
                                            <h4>Totaux Fact. (Liq. et Emb.)</h4>
                                            <h5>{{ number_format($totalhtemb + $totalht, 2, ',', ' ') }}XOF</h5>

                                        </li>
                                        <li class="total">
                                            <h4>Frais de Port</h4>
                                            <h5> {{ number_format($fraisports->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>TOTAUX AVEC FRAIS DE PORT</h4>
                                            <h5>{{ number_format($fraisports->fraisport + ($totalhtemb + $totalht), 2, ',', ' ') }}XOF
                                            </h5>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($fraisports->fraisport + ($totalhtemb + $totalht), 2, ',', ' ') }}">

                                        </li>
                                    </ul>
                                @elseif (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 0)
                                    <ul>
                                        <li class="total">
                                            <h4>Totaux Fact. (Liq. et Emb.)</h4>
                                            <h5>{{ number_format($totalhtemb + ($totalht * ($fraisairsis[0]->taux / 100) + $totalht), 2, ',', ' ') }}XOF
                                            </h5>

                                        </li>
                                        <li class="total">
                                            <h4>Frais de Port</h4>
                                            <h5> {{ number_format($fraisports->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>TOTAUX AVEC FRAIS DE PORT</h4>
                                            <h5>{{ number_format($fraisports->fraisport + $totalhtemb + ($totalht * ($fraisairsis[0]->taux / 100) + $totalht), 2, ',', ' ') }}XOF
                                            </h5>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($fraisports->fraisport + $totalhtemb + ($totalht * ($fraisairsis[0]->taux / 100) + $totalht), 2, ',', ' ') }}">

                                        </li>
                                    </ul>
                                @elseif (($clientsinfos[0]->exonerertva ?? 0) == 0 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                    <ul>
                                        <li class="total">
                                            <h4>Totaux Fact. (Liq. et Emb.)</h4>
                                            <h5>{{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100) + ($totalht + $totalht * ($tvas[0]->taux / 100)), 2, ',', ' ') }}
                                                XOF</h5>

                                        </li>
                                        <li class="total">
                                            <h4>Frais de Port</h4>
                                            <h5> {{ number_format($fraisports->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>TOTAUX AVEC FRAIS DE PORT</h4>
                                            <h5>{{ number_format($fraisports->fraisport + ($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100)) + ($totalht + $totalht * ($tvas[0]->taux / 100)), 2, ',', ' ') }}
                                                XOF</h5>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($fraisports->fraisport + ($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100)) + ($totalht + $totalht * ($tvas[0]->taux / 100)), 2, ',', ' ') }}">

                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        <li class="total">
                                            <h4>Totaux Fact. (Liq. et Emb.)</h4>
                                            <h5>{{ number_format($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100) + ($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100)), 2, ',', ' ') }}XOF
                                            </h5>

                                        </li>

                                        <li class="total">
                                            <h4>Frais de Port</h4>
                                            <h5> {{ number_format($fraisports->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                        </li>
                                        <li class="total">
                                            <h4>TOTAUX AVEC FRAIS DE PORT</h4>
                                            <h5>{{ number_format($fraisports->fraisport + ($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100)) + ($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100)), 2, ',', ' ') }}XOF
                                            </h5>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($fraisports->fraisport + ($totalhtemb + $totalhtemb * ($tvas[0]->taux / 100)) + ($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100)), 0, ',', ' ') }}">

                                        </li>
                                    </ul>
                                @endif

                            </div>
                        </div>


                    </div>
                    {{-- FIN TOTAUX DES FACTURES --}}

                    <div class="row" id="clientdefini">

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Mode de paiement</label>
                                <select name="mode_paiement_id" id="mode_paiement_id" class="select">
                                    <option value="">Sélectionner un mode</option>
                                    @foreach ($parammodepaiements as $parammodepaiements)
                                        <option
                                            value="{{ $parammodepaiements->categorie . ',' . $parammodepaiements->id }}">
                                            {{ $parammodepaiements->mode_paiement }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12" id="numtransact">
                            <div class="form-group">
                                <label id="numtransaction"></label>
                                <input type="text" placeholder="Entrer le numéro de transaction"
                                    name="numtransaction">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12" id="reference">
                            <div class="form-group">
                                <label>Code Référence Transaction</label>
                                <input type="text" name="reference" placeholder="Entrer le code de transaction">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12" id="especerecu">
                            <div class="form-group">
                                <label>Espèce réçu</label>
                                <input type="text" id="recuespece" name="recuespece"
                                    placeholder="Entrer l'espèce réçu">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12" id="reste">

                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="Description"></textarea>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
                            <button type="submit" class="btn btn-submit me-2">Valider vente</button>
                        </div>
                    </div>

                </form>
            @endif
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
                $('#clientnondefini').hide();
                $('#clientdefini').show();
            });
            // Ajouter un événement au clic sur les boutons radio
            $('#validationFormCheck3').on('click', function() {
                // Si "Client Prédéfini" est sélectionné, afficher l'input
                $('#clientdefini').hide();
                $('#clientnondefini').show();
            });

            $('#reference').hide();
            $('#numtransact').hide();
            $('#especerecu').hide();
            $('#reste').hide();

            $('#divquantiteretourne').hide();
            $('#divquantiteachete').hide();
            $('#embautre').hide();
            $('#divprixventeunitemb').hide();

            // Configurer l'événement onchange
            $('#mode_paiement_id').on('change', function() {
                event.preventDefault();
                const categorie_paiemnts = $(this).val(); // Récupérer la valeur sélectionnée


                // Diviser la chaîne en tableau
                let array = categorie_paiemnts.split(',');

                const categorie_paiemnt = array[0]; // Récupérer la valeur sélectionnée

                if (categorie_paiemnt) {



                    if (categorie_paiemnt === 'Paiements en espèces') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#reste').hide();

                        $('#especerecu').hide();
                        $('#especerecu').show();

                    } else if (categorie_paiemnt === 'Paiements mobiles') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#especerecu').hide();
                        $('#numtransaction').empty();
                        $('#reste').hide();

                        $('#reference').show();
                        $('#numtransaction').append('Num. Transaction ');
                        $('#numtransact').show();

                    } else if (categorie_paiemnt === 'Paiements électroniques et en ligne') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#especerecu').hide();
                        $('#numtransaction').empty();
                        $('#reste').hide();

                        // $('#reference').show();
                        $('#numtransaction').append('Num. Transaction ');
                        $('#numtransact').show();

                    } else if (categorie_paiemnt === 'Paiements bancaires') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#especerecu').hide();
                        $('#numtransaction').empty();
                        $('#reste').hide();


                        // $('#reference').show();
                        $('#numtransaction').append('Num. Transaction ');
                        $('#numtransact').show();

                    } else if (categorie_paiemnt === 'Paiements différés ou à crédit') {

                    }



                    //alert(categorie_paiemnt);

                } else {
                    // Réinitialiser la vue si aucune sélection
                    // alert('reinst');
                    //$('#clientInfo').html('<p>Sélectionnez un client pour voir les détails.</p>');
                }
            });


            $('#recuespece').on('blur', function() {
                let valeur = parseFloat($(this).val()) ||
                    0; // Récupère et convertit la valeur saisie en nombre
                let totalfacture = parseFloat($('#totalfacture').val().replace(/\s/g, '')) ||
                    0; // Récupère la valeur, supprime les espaces, et la convertit en nombre
                //alert(valeur + ' ' + totalfacture);
                if (valeur > 0 && totalfacture > 0) {

                    $('#reste').show();

                    let reste = totalfacture - valeur; // Calcul du reste (total facture - reçu)
                    let resteTexte = reste >= 0 ?
                        `<strong>Reste à payer :</strong> ${reste.toLocaleString('fr-FR')} FCFA` :
                        `<strong>Rendu : </strong> ${Math.abs(reste).toLocaleString('fr-FR')} FCFA`; // Rendu si le montant reçu dépasse le total

                    $('#reste').html(`<div class="form-group"><label>${resteTexte}</label></div>`);
                } else {
                    $('#reste').text('Veuillez entrer une valeur valide pour le montant reçu.');
                }
            });


            // Selection avec onchange pour afficher les prix de vente unitaire

            $('#produitSelect').on('change', function() {
                const produitId = $(this).val();
                // Réinitialiser le select des fournisseurs
                $('#prixventeunitliq').empty().append(
                    '<option value="">-- Sélectionner un prix de vente --</option>').prop('disabled',
                    true);
                if (produitId) {
                    // Récupérer l'URL dynamique depuis l'attribut caché
                    const urlTemplate = $('#getUrlTemplate').val();
                    // Remplacer :id par l'ID du produit sélectionné
                    const getUrl = urlTemplate.replace(':id', produitId);
                    // Requête Ajax pour obtenir les fournisseurs
                    $.ajax({
                        method: 'GET',
                        url: getUrl,
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success) {
                                // Remplir le select avec les fournisseurs
                                $.each(response.typeclients, function(index,
                                    typeclient) {
                                    $('#prixventeunitliq').append('<option value="' +
                                        typeclient.id + '">' +
                                        typeclient.tarif + ' XOF</option>');
                                });
                                $('#prixventeunitliq').prop('disabled',
                                    false); // Activer le select
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            //alert('ERREUR');
                            $('#prixventeunitliq').prop('disabled', false); // Activer le select
                        }
                    });
                } else {
                    $('#suppliersList').empty();
                }
            });


            //Selection avec onchange pour afficher le prix de vente unitaire d'emballage

            $('#produitSelect').on('change', function() {
                const produitId = $(this).val();


                if (produitId) {
                    // alert( produitId );

                    // Récupérer l'URL dynamique depuis l'attribut caché
                    const urlTemplate2 = $('#getUrlTemplate2').val();

                    // Remplacer :id par l'ID du produit sélectionné
                    const getUrl2 = urlTemplate2.replace(':id', produitId);
                    // Requête Ajax pour obtenir les fournisseurs
                    $.ajax({
                        method: 'GET',
                        url: getUrl2,
                        dataType: 'JSON',
                        success: function(response) {

                            if (response.success) {
                                // Vérifier si l'emballage est "Casier"
                                if (response.typeclients.length > 0 && response.typeclients[0]
                                    .emballage === 'Casier') {
                                    $('#divquantiteretourne')
                                        .show(); // Afficher le div pour quantité retournée
                                    $('#embautre').hide();
                                    $("#embautreinput").removeAttr("name");
                                    $('#divquantiteachete').show();
                                    $("#quantiteachete").removeAttr("name");
                                    $("#quantiteachete").attr("name", "quantiteachete");
                                } else {
                                    $('#divquantiteretourne')
                                        .hide(); // Cacher le div si ce n'est pas un "Casier"
                                    $('#divquantiteachete').hide();
                                    $("#quantiteachete").removeAttr("name");
                                    $('#embautre').show();
                                    $("#embautreinput").removeAttr("name");
                                    $("#embautreinput").attr("name", "quantiteachete");

                                }
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            //alert('ERREUR');
                            $('#tariftypeproduitfournisseur').prop('disabled',
                                false); // Activer le select
                        }
                    });
                } else {
                    $('#suppliersList').empty();
                }
            });

            // Déclencher l'événement lors de la modification des deux champs de texte
            $('input[id="quantiteachete"], input[id="quantiteretourne"]').on('blur', function() {
                // Récupérer les valeurs des champs
                let quantiteAchete = parseInt($('input[id="quantiteachete"]').val()) || 0;
                let quantiteRetourne = parseInt($('input[id="quantiteretourne"]').val()) || 0;


                // Effacer les options précédentes
                $('#prixventeunitemb').empty();
                // alert( quantiteRetourne );
                // Si les deux valeurs sont des entiers valides
                if ((quantiteAchete > 0) && (quantiteRetourne >= 0)) {

                    // Si les deux valeurs sont des entiers valides
                    if (quantiteAchete > quantiteRetourne) {

                        $('#divprixventeunitemb')
                            .show(); // Afficher le div pour prix unitaire
                        // alert(quantiteAchete + ' ' + quantiteRetourne);
                        // Réinitialiser le select des fournisseurs
                        $('#prixventeunitemb').empty().append(
                            '<option value="">-- Sélectionner un prix de vente Emb --</option>').prop(
                            'disabled',
                            true);
                        const produitId = $('#produitSelect').val();
                        // Récupérer l'URL dynamique depuis l'attribut caché
                        const urlTemplate3 = $('#getUrlTemplate3').val();
                        // Remplacer :id par l'ID du produit sélectionné
                        const getUrl3 = urlTemplate3.replace(':id', produitId);
                        //alert(getUrl3);
                        $.ajax({
                            method: 'GET',
                            url: getUrl3,
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.success) {
                                    // Remplir le select avec les fournisseurs
                                    $.each(response.tarifembclients, function(index,
                                        tarifembclient) {
                                        $('#prixventeunitemb').append(
                                            '<option value="' +
                                            tarifembclient.id + '">' +
                                            tarifembclient.tarif + ' XOF</option>');
                                    });
                                    $('#prixventeunitemb').prop('disabled',
                                        false); // Activer le select
                                } else {
                                    alert(response.message);
                                }

                            },
                            error: function() {
                                //alert('ERREUR');
                                $('#tariftypeproduitfournisseur').prop('disabled',
                                    false); // Activer le select
                            }
                        });


                    } else {
                        $('#divprixventeunitemb').hide();
                    } // end if valeur non comparaisons 



                } // end if valeur non nul
            });



        });
    </script>
@endsection
