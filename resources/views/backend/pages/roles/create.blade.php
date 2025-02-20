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
            <h4>Nouveau Rôle & permissions</h4>
            <h6>Enregistrer un Rôle & permissions</h6>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                    <label>Nom du rôle</label>
                    <input type="text" id="name" name="name" placeholder="Entrer le nom du rôle" required autofocus value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="text-end">
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-cancel">Fermer</a>
                    <button type="submit" class="btn btn-submit me-2">Enregistrer</button>

                 </div>
            </div> 
            <div class="col-12 mb-3">
                <div class="input-checkset">
                    <ul>
                        <li>
                            <label class="inputcheck">Tous sélectionner 
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @php $i = 1; @endphp
        @foreach ($permission_groups as $group)
        <div class="row">
            <div class="col-12">
                <div class="productdetails product-respon">
                    <ul>
                        <li>
                            <h4>{{ $group->name }}</h4>
                            <div class="input-checkset">
                                <ul class="role-{{ $i }}-management-checkbox"">
                                    <li>
                                        <label class="inputcheck">Sélectionner tous
                                            <input type="checkbox"  id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>@php
                                    $permissions = App\User::getpermissionsByGroupName($group->name);
                                    $j = 1;
                                @endphp
                                @foreach ($permissions as $permission)

                                    <li>
                                        <label class="inputcheck">{{ $permission->name }}
                                            <input type="checkbox" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    
                                    @php  $j++; @endphp
                                    @endforeach


                                </ul>
                            </div>
                        </li>
                       

                    </ul>
                </div>
            </div>
        </div>


        @php  $i++; @endphp
        @endforeach
    </form>

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
    @include('backend.pages.roles.partials.scripts')

@endsection
