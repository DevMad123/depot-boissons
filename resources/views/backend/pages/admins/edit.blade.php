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
            <h4>Modification infos Administrateur</h4>
            <h6>Modifier  info {{ $admin->name }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @include('backend.layouts.partials.messages')
                    
            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                @method('PUT')
                @csrf
            <div class="row">
               

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Nom de l'administrateur</label>
                        <input type="text"  id="name" name="name" placeholder="Enter Name" value="{{ $admin->name }}" required autofocus>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text"  id="email" name="email" placeholder="Enter Email" value="{{ $admin->email }}" required>
                    </div>
                </div>
               
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Assigner un Rôle</label>
                        <select name="roles[]" id="roles" class="select" multiple required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Identifiant</label>
                        <input type="text"  id="username" name="username" placeholder="Enter Username" required value="{{ $admin->username }}">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Mote de passe (Optionel)</label>
                        <input type="password"  id="password" name="password" placeholder="Entrer Mot de passe">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Confirmer Mot de passe (Optionel)</label>
                        <input type="password"  id="password_confirmation" name="password_confirmation" placeholder="Confirmer">
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

    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select').select();
        })
    </script>
    
@endsection
