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
            <h4>Verification de l'Inventaire Physique</h4>
            <h6>Forcer la Fermeture de la Journée du : {{ \Carbon\Carbon::parse($journee->date_ouverture)->translatedFormat('d F Y \à H\hi\ms\s') }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.journees.close', ['id' => $journee->id, 'force' => true]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-2"><label class="mb-2">CODE PRODUITS</label></div>
                    <div class="col-md-4"><label class="mb-2">PRODUITS</label></div>
                    @if ($journee->statut !== 'ouverte')
                    <div class="col-md-2"><label class="mb-2">QTES OUVERTURE</label></div>
                    <div class="col-md-2"><label class="mb-2">QTES FERMETURE</label></div>
                    <div class="col-md-2"><label class="mb-2">QTES DIFF</label></div>
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" value="{{ $inventaire->quantite_ouverture }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="quantite[{{ $inventaire->id }}]" value="{{ $inventaire->quantite_fermeture }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" value="{{ $inventaire->quantite_fermeture - $inventaire->quantite_ouverture }}" readonly>
                        </div>
                    </div>
                </div>

                @endforeach
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="observation">Observation</label>
                        <textarea name="observation" id="observation" class="form-control" placeholder="Ajouter une observation">{{ old('observation', $journee->observation) }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.journees.index') }}" class="btn btn-cancel">Annuler</a>
                    <button type="submit" class="btn btn-submit me-2">Forcer la Fermeture de la Journée</button>
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
