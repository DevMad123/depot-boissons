<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Gestion de dépôt de boisson">
    <meta name="keywords" content="Dépôt, Boisson, Cave, Gestion">
    <meta name="author" content="SIMPLE THREE - OUEDRAOGO ABDOUL AZIZE">
    <meta name="robots" content="noindex, nofollow">
    <title>Gestion de Dépôt de Boisson</title>

    @yield('styles')

</head>


<body>

    <!-- Chargement de la plateforme -->
    {{-- <div id="global-loader">
<div class="whirly-loader"> </div>
</div> --}}

    <!-- Main-wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <div class="header-left active">
                <a href="index.html" class="logo">
                    <img src="{{ asset('backend/assets/img/logo.png') }}" alt="">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="{{ asset('backend/assets/img/logo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                {{-- <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <img src="{{ asset('backend/assets/img/icons/notification-bing.svg') }}" alt="img"> <span
                            class="badge rounded-pill">4</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('backend/assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('backend/assets/img/profiles/avatar-03.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name <span class="noti-title">Appointment booking
                                                        with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('backend/assets/img/profiles/avatar-06.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('backend/assets/img/profiles/avatar-17.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('backend/assets/img/profiles/avatar-13.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Bernardo
                                                        Galaviz</span> added new task <span class="noti-title">Private
                                                        chat module</span></p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li> --}}

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="{{ asset('backend/assets/img/profiles/avator1.jpg') }}"
                                alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img
                                        src="{{ asset('backend/assets/img/profiles/avator1.jpg') }}" alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::guard('admin')->user()->name }}</h6>
                                    {{-- <h5>Admin</h5> --}}
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i>
                                Mon profile</a>
                            <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                                    data-feather="settings"></i>Paramètre</a>
                            <hr class="m-0">
                            @include('backend.layouts.composants.logout')
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">Mon profile</a>
                    <a class="dropdown-item" href="generalsettings.html">Paramètre</a>
                    @include('backend.layouts.composants.logout')
                </div>
            </div>

        </div>
        <!-- End header -->

        @include('backend.layouts.composants.sidebar')

        <div class="page-wrapper">

            <div class="content">

                @yield('admin-content')

            </div>

        </div>
    </div>

    {{-- @include('backend.layouts.composants.scripts') --}}
    @yield('scripts')

</body>

</html>
