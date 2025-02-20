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
            <h4>Nouvelle Devise</h4>
            <h6>Créer nouvelle Devise</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')

            <form action="{{ route('admin.devises.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Libelle</label>
                            <input type="text" name="libelle" placeholder="Entrer le libelle" autofocus
                                value="{{ old('libelle') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Code Devise</label>
                            <input type="text" name="code_devise" placeholder="Entrer le code" autofocus
                                value="{{ old('code_devise') }}">
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

<script src="{{asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/script.js') }}"></script>
@endsection
