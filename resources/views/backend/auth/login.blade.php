@extends('backend.auth.auth_master')
{{-- 
@section('auth_title')
Connexion | Panneau d'administration
@endsection --}}

@section('auth-content')
     
    <div class="login-img">
        <img src="{{ asset('backend/assets/img/login.jpg') }}" alt="img">
    </div>
    <div class="login-content">
        <div class="login-userset">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="login-logo">
                    <img src="{{ asset('backend/assets/img/logo.png') }}" alt="img">
                </div>
                <div class="login-userheading">
                    <h3>Se Connecter</h3>
                    <h4>Bonjour, connectez-vous et commencez à gérer votre panneau d'administration</h4>
                </div>
                @include('backend.layouts.partials.messages')
                <div class="form-login">
                    <label>Adresse e-mail ou nom d'utilisateur</label>
                    <div class="form-addons">
                        <input type="text" id="exampleInputEmail1" name="email"
                            placeholder="Entrez votre adresse e-mail ou nom d\'utilisateur">
                        <img src="{{ asset('backend/assets/img/icons/mail.svg') }}" alt="img">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-login">
                    <label>Mot de passe</label>
                    <div class="pass-group">
                        {{-- <input type="password" class="pass-input" placeholder="Enter your password"> --}}
                        <input type="password" id="exampleInputPassword1" class="pass-input" name="password">
                        <span class="fas toggle-password fa-eye-slash"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" name="remember"
                       >
                    <label class="form-check-label" for="invalidCheck">
                        Souviens-toi de moi
                    </label>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-login">
                    <button class="btn btn-login" type="submit">Se connecter <i class="ti-arrow-right"></i></button>
                </div>

            </form>
        </div>
    </div>

    <!-- login area end -->
@endsection
