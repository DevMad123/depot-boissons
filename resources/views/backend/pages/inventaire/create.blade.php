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
            <h4>Nouvel Inventaire Physique</h4>
            <h6>Fermer la Journée du : {{ \Carbon\Carbon::parse($journee->date_ouverture)->translatedFormat('d F Y \à H\hi\ms\s') }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.journees.close', $journee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-2"><label class="mb-2">CODE PRODUITS</label></div>
                    <div class="col-md-4"><label class="mb-2">PRODUITS</label></div>
                    @if ($journee->statut !== 'ouverte')
                    <div class="col-md-3"><label class="mb-2">QUANTITES OUVERTURE</label></div>
                    <div class="col-md-3"><label class="mb-2">QUANTITES FERMETURE</label></div>
                    @else
                    <div class="col-md-6"><label class="mb-2">QUANTITES</label></div>
                    @endif
                </div>
                @if($inventaires->isEmpty())
                    <div class="row bg-gray">
                        <div class="col-md-12">
                            <p>Aucun produit associé à cette journée</p>
                        </div>
                    </div>
                @endif

                @foreach ($inventaires as $inventaire)

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" value="{{ $inventaire->produit->matriproduit }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" value="{{ $inventaire->produit->libelle . ' de ' . $inventaire->produit->format->format . '  ' . $inventaire->produit->emballage->libelle }}" disabled>
                        </div>
                    </div>
                    @if ($journee->statut !== 'ouverte')
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="{{ $inventaire->quantite_ouverture }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" value="{{ $inventaire->quantite_fermeture }}" disabled>
                            </div>
                        </div>
                    @else
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="quantite[{{ $inventaire->id }}]" value="{{ $inventaire->quantite_fermeture }}" placeholder="Ex: 100" required>
                        </div>
                    </div>
                    @endif
                </div>

                @endforeach

                <div class="text-end">
                    <a href="{{ route('admin.journees.index') }}" class="btn btn-cancel">Annuler</a>
                    <button type="submit" class="btn btn-submit me-2">Fermer la journée</button>
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
