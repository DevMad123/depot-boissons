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

    <style>
        .infosclient {
            width: auto;
            height: auto;
            border: 1px solid silver !important;
            border-radius: 15px;
            padding: 10px;
        }

        .tablebas {
            width: auto !important;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .tablebas .thtexte {
            background-color: #e7e6e6;
        }

        .tablebas,
        .tablebas th,
        .tablebas td {
            width: 450px !important;
            border: 1px solid silver;
            text-align: center;
            padding: 10px;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
@endsection

@section('admin-content')
    <div class="page-header">
        <div class="page-title">
            <h4>Facture</h4>
            <h6>Imprimer Facture</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="facture">
            @include('backend.layouts.partials.messages')


            <div class="row">
                <div class="table-responsive">

                    <div class="col-lg-3 col-sm-6 col-12 mb-4 ">

                        {{-- INFOS FACTURE NUM --}}
                        <table>

                            <tr>
                                <td><strong>FACTURE N° : </strong> </td>
                                <td> {{ $factures->facture_num ?? 'N/A' }}</td>
                            </tr>
                        </table>
                        {{--  END FACTURE NUM --}}
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 mb-4 ms-auto ">
                        <div class="infosclient">
                            {{-- INFOS CLIENT --}}
                            <table>

                                <tr>
                                    <td><strong>Nom du client : </strong> </td>
                                    <td> {{ $factures->client->first()->nom ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>E-mail :</strong> </td>
                                    <td>{{ $factures->client->first()->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Téléphone : </strong> </td>
                                    <td> {{ $factures->client->first()->telephone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Adresse : </strong> </td>
                                    <td> {{ $factures->client->first()->adresse ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Exonéré TVA : </strong> </td>
                                    <td>
                                        @if ($clientsinfos[0]->exonerertva ?? 0 == 1)
                                            Oui
                                        @else
                                            Non
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Exonéré AIRSI : </strong> </td>
                                    <td>
                                        @if ($clientsinfos[0]->exonererairsi ?? 0 == 1)
                                            Oui
                                        @else
                                            Non
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            {{--  END INFOS CLIENT --}}
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="thhead">
                                <th class="text-center">N°</th>
                                <th>Désignation</th>
                                <th class="text-center">Quantité Liquide</th>
                                <th class="text-center">P.U HT (XOF)</th>
                                <th class="text-center">Prix HT (XOF)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facture_produits as $facture_produits)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="productimgname">
                                        {{ $facture_produits->produit->libelle . ' de ' . $facture_produits->produit->format->format . '  ' . $facture_produits->produit->emballage->libelle }}
                                    </td>
                                    <td class="text-center">{{ $facture_produits->quantite ?? 'N/A' }}</td>
                                    <td class="text-center">{{ number_format($facture_produits->tariftypeproduitclient->tarifliquide ?? 0, 2, ',', ' ') }}
                                    </td>
                                    <td class="text-center">{{ number_format($facture_produits->prix_vente_totalliquide, 0, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

















                    <form action="{{ route('admin.ventevaliders.store') }}" method="POST">
                        @csrf
                        <div class="row ">
                            <div class="col-lg-12 float-md-right">
                                <div class="total-order">


                                    @if (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                        {{-- <ul>
                                            <li>
                                                <h4>Total HT</h4>
                                                <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li>
                                                <h4>TVA ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                                <h5>0 XOF</h5>
                                            </li>
                                            <li>
                                                <h4>AIRSI ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                                <h5> 0 XOF</h5>
                                            </li>
                                            <li>
                                                <h4>Frais de Port</h4>
                                                <h5> {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total TTC</h4>
                                                <h5>{{ number_format($totalht, 2, ',', ' ') }}
                                                    XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total Facture</h4>
                                                <h5>
                                                    {{ number_format($factures->fraisport + $totalht, 2, ',', ' ') }}
                                                    XOF</h5>
                                                <input type="hidden" id="totalfacture" name="totalfacture"
                                                    value="{{ number_format($factures->fraisport + $totalht, 0, ',', ' ') }}">
                                            </li>
                                        </ul> --}}
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <table class="tablebas">
                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total HT</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht, 0, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>TVA ({{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        0 XOF
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>AIRSI ({{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        0 XOF
                                                    </td>
                                                </tr> --}}

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Frais de Port</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total TTC</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht, 2, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total Facture</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport + $totalht, 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($factures->fraisport + $totalht, 0, ',', ' ') }}">
                                        </div>
                                    @elseif (($clientsinfos[0]->exonerertva ?? 0) == 1 && ($clientsinfos[0]->exonererairsi ?? 0) == 0)
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <table class="tablebas">

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total HT </strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht, 0, ',', ' ') }} XOF
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="tdcalcfact thtexte">
                                                       <strong>TVA ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}
                                                                )</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        0 XOF
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>AIRSI (
                                                            {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})
                                                        </strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total TTC </strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Frais de Port</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total Facture </strong>
                                                    </td>
                                                    <td>
                                                        {{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}">

                                            {{--  END INFOS CLIENT --}}
                                        </div>



                                        {{-- <ul>
                                            <li>
                                                <h4>Total HT</h4>
                                                <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li>
                                                <h4>TVA ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                                <h5>0 XOF</h5>
                                            </li>
                                            <li>
                                                <h4>AIRSI ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                                <h5> {{ number_format($totalht * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                    XOF
                                                </h5>
                                            </li>
                                            <li>
                                                <h4>Frais de Port</h4>
                                                <h5> {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total TTC</h4>
                                                <h5>{{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}
                                                    XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total Facture</h4>
                                                <h5>{{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}
                                                    XOF</h5>
                                                <input type="hidden" id="totalfacture" name="totalfacture"
                                                    value="{{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht, 2, ',', ' ') }}">

                                            </li>
                                        </ul> --}}
                                    @elseif (($clientsinfos[0]->exonerertva ?? 0) == 0 && ($clientsinfos[0]->exonererairsi ?? 0) == 1)
                                        {{-- <ul>
                                            <li>
                                                <h4>Total HT</h4>
                                                <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li>
                                                <h4>TVA ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                                <h5>{{ number_format($totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }} XOF
                                                </h5>
                                            </li>
                                            <li>
                                                <h4>AIRSI ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                                <h5>0 XOF</h5>
                                            </li>
                                            <li>
                                                <h4>Frais de Port</h4>
                                                <h5> {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total TTC</h4>
                                                <h5>{{ number_format($totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                    XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total Facture</h4>
                                                <h5>{{ number_format($factures->fraisport + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                    XOF</h5>
                                                <input type="hidden" id="totalfacture" name="totalfacture"
                                                    value="{{ number_format($factures->fraisport + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}">

                                            </li>
                                        </ul> --}}
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <table class="tablebas">
                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total HT</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht, 0, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>TVA
                                                            ({{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>AIRSI ({{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        0 XOF
                                                    </td>
                                                </tr> --}}

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Frais de Port</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total TTC</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total Facture</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($factures->fraisport + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}">
                                        </div>
                                    @else
                                        {{-- <ul>
                                            <li>
                                                <h4>Total HT</h4>
                                                <h5>{{ number_format($totalht, 0, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li>
                                                <h4>TVA ( {{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }} )</h4>
                                                <h5>{{ number_format($totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }} XOF
                                                </h5>
                                            </li>
                                            <li>
                                                <h4>AIRSI ( {{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }}) </h4>
                                                <h5> {{ number_format($totalht * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                    XOF
                                                </h5>
                                            </li>
                                            <li>
                                                <h4>Frais de Port</h4>
                                                <h5> {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total TTC</h4>
                                                <h5>{{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                    XOF</h5>
                                            </li>
                                            <li class="total">
                                                <h4>Total Facture</h4>
                                                <h5>
                                                    {{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                    XOF</h5>
                                                <input type="hidden" id="totalfacture" name="totalfacture"
                                                    value="{{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}">

                                            </li>
                                        </ul> --}}
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <table class="tablebas">
                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total HT</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht, 0, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>TVA
                                                            ({{ $tvas[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>AIRSI
                                                            ({{ $fraisairsis[0]->taux . '' . $tvas[0]->symbol ?? 'N/A' }})</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht * ($fraisairsis[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Frais de Port</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport ?? 0, 2, ',', ' ') }} XOF
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total TTC</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td class="tdcalcfact thtexte">
                                                        <strong>Total Facture</strong>
                                                    </td>
                                                    <td class="tdcalcfact">
                                                        {{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}
                                                        XOF
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" id="totalfacture" name="totalfacture"
                                                value="{{ number_format($factures->fraisport + $totalht * ($fraisairsis[0]->taux / 100) + $totalht + $totalht * ($tvas[0]->taux / 100), 2, ',', ' ') }}">
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-3 col-sm-6 col-12 mb-4 ms-auto signature">
                        <h4><strong><u>Signature</u></strong></h4>
                    </div>





















                </div>
            </div>



            {{-- @endif --}}
        </div>
        <div class="text-end">
            <button onclick="imprimerFacture()" class="btn btn-info me-2">🖨️ Imprimer la facture</button>
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

            // Initialisation de DataTables
            $('.table').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                initComplete: function() {
                    const table = $('.table');

                    // Application d'une bordure extérieure pour simuler une facture
                    table.css({
                        "border": "1px solid silver",
                        "border-collapse": "collapse",
                        "width": "100%"
                    });

                    // Application des bordures de colonne uniquement (pas de bordure de ligne)
                    table.find('td, th').css({
                        "border-left": "1px solid silver",
                        "border-right": "1px solid silver",
                        "border-top": "none",
                        "border-bottom": "none",
                        "padding": "10px",
                        "text-align": "left",
                        "vertical-align": "middle"
                    });

                    // Ajoute une bordure en bas de la dernière ligne pour simuler une facture
                    table.find('tr:last-child td').css("border-bottom", "1px solid silver");

                    // Ajoute une bordure en bas de l'en-tête
                    table.find('thead tr th').css("border", "1px solid silver");

                    table.find('thead tr').css("background-color", " #e7e6e6");

                    // Ajuste la hauteur des cellules pour un effet de facture
                    table.find('td, th').css("height", "50px");
                }
            });

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

                        $('#especerecu').hide();
                        $('#especerecu').show();

                    } else if (categorie_paiemnt === 'Paiements mobiles') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#especerecu').hide();
                        $('#numtransaction').empty();

                        $('#reference').show();
                        $('#numtransaction').append('Num. Transaction ');
                        $('#numtransact').show();

                    } else if (categorie_paiemnt === 'Paiements électroniques et en ligne') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#especerecu').hide();
                        $('#numtransaction').empty();

                        // $('#reference').show();
                        $('#numtransaction').append('Num. Transaction ');
                        $('#numtransact').show();

                    } else if (categorie_paiemnt === 'Paiements bancaires') {

                        $('#reference').hide();
                        $('#numtransact').hide();
                        $('#especerecu').hide();
                        $('#numtransaction').empty();

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
                alert(valeur + ' ' + totalfacture);
                if (valeur > 0 && totalfacture > 0) {
                    let reste = totalfacture - valeur; // Calcul du reste (total facture - reçu)
                    let resteTexte = reste >= 0 ?
                        `<strong>Reste à payer :</strong> ${reste.toLocaleString('fr-FR')} FCFA` :
                        `<strong>Rendu : </strong> ${Math.abs(reste).toLocaleString('fr-FR')} FCFA`; // Rendu si le montant reçu dépasse le total

                    $('#reste').html(`<div class="form-group"><label>${resteTexte}</label></div>`);
                } else {
                    $('#reste').text('Veuillez entrer une valeur valide pour le montant reçu.');
                }
            });




        });



        function genererFacture() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.setFont("helvetica", "bold");
            doc.text("Facture", 90, 20);

            doc.setFont("helvetica", "normal");
            doc.text("Nom du client : Jean Dupont", 20, 40);
            doc.text("Date : 30/01/2025", 20, 50);

            let y = 70;
            doc.text("Article", 20, y);
            doc.text("Quantité", 70, y);
            doc.text("Prix Unitaire (€)", 110, y);
            doc.text("Total (€)", 160, y);

            let data = [
                ["Ordinateur", "1", "800", "800"],
                ["Souris", "2", "20", "40"]
            ];

            y += 10;
            doc.setFont("helvetica", "normal");
            data.forEach(item => {
                doc.text(item[0], 20, y);
                doc.text(item[1], 75, y);
                doc.text(item[2], 120, y);
                doc.text(item[3], 170, y);
                y += 10;
            });

            doc.text("Total à payer : 840 €", 20, y + 10);

            doc.save("facture.pdf");
        }

        // imprimer

        function imprimerFacture() {
            let contenu = document.getElementById('facture').innerHTML;
            let fenetreImpression = window.open('', '', 'width=800,height=600');
            fenetreImpression.document.write('<html><head><title>Facture</title>');

            fenetreImpression.document.write(
                '<link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.jpg') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/css/animate.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">' +
                '<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">' +
                '<style>' +
                'body { font-family: Arial, sans-serif;margin-top: 150px; }' +
                '.table { width: 100%; border-collapse: collapse; margin-top: 10px; }' +
                '.table, .table th, .table td { border: 1px solid black; text-align: center; padding: 10px; }' +
                '.tablebas { float:right;margin-top:50px;width: auto!important; border-collapse: collapse; margin-top: 10px; }' +
                '.tablebas .thtexte { background-color: #e7e6e6; }' +
                '.signature {margin-top: 300px;margin-left:470px; }' +
                '.tablebas, .tablebas th, .tablebas td { width: 450px!important; border: 1px solid silver; text-align: center; padding: 10px; }' +
                '.infosclient {float:right;margin-bottom:35px; width: auto; height: auto; border: 1px solid silver!important; border-radius: 15px; padding: 10px; }' +
                '</style>'
            );

            fenetreImpression.document.write('</head><body>');
            fenetreImpression.document.write(contenu);
            fenetreImpression.document.write('</body></html>');
            fenetreImpression.document.close();
            fenetreImpression.print();
        }
    </script>
@endsection
