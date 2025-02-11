@props([
    'backend' => true,
    'title' => 'operateur',
    'admin' => false,
])
@php($route = request()->route()->action['as'])
@extends('layouts.base')
@section('title', $title)
@section('styles')
    <!-- Fontfaces CSS-->
    <link href="{{ asset('backend/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('backend/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('backend/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('backend/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backend/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('backend/css/theme.css') }}" rel="stylesheet" media="all">
@endsection
@section('content')

    <body class="animsition">
        <div class="page-wrapper">
            @if ($backend)
                <!-- HEADER MOBILE-->
                <header class="header-mobile d-block d-lg-none">
                    <div class="header-mobile__bar">
                        <div class="container-fluid">
                            <div class="header-mobile-inner">
                                <a class="logo" href="index.html">
                                    <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
                                </a>
                                <button class="hamburger hamburger--slider" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar-mobile">
                        <div class="container-fluid">
                            <ul class="navbar-mobile__list list-unstyled">

                                <li @class(['active' => $route === 'operateur.dashboard'])>
                                    <a class="js-arrow" href="{{ route('operateur.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                </li>
                                <li @class(['active' => $route === 'operateur.incident.list'])>
                                    <a href="{{ route('operateur.incident.list') }}">
                                        <i class="fas fa-chart-bar"></i>En traitement</a>
                                </li>
                                <li @class(['active' => $route === 'operateur.incident.archive'])>
                                    <a href="{{ route('operateur.incident.archive') }}">
                                        <i class="fas fa-table"></i>Archives</a>
                                </li>
                                <li @class(['active' => $route === 'operateur.incident.statistique'])>
                                    <a href="{{ route('operateur.incident.archive') }}">
                                        <i class="fas fa-table"></i>Statistiques</a>
                                </li>

                                <li @class(['active' => $route === 'citoyen','mt-2'])>
                                        <a class="js-arrow" href="{{ route('citoyen.dashboard') }}">
                                            <>compte citoyen</a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- END HEADER MOBILE-->

                @if ($admin)
                    <!-- MENU SIDEBAR-->
                    <aside class="menu-sidebar d-none d-lg-block">
                        <div class="logo">
                            <a href="#">
                                <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
                            </a>
                        </div>
                        <div class="menu-sidebar__content js-scrollbar1">
                            <nav class="navbar-sidebar">
                                <ul class="list-unstyled navbar__list">
                                    <li @class(['active' => $route === 'admin.dashboard'])>
                                        <a class="js-arrow" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                    </li>
                                    @foreach (App\Models\Service::all() as $service2)
                                        {{-- @dump(session('service'),$) --}}
                                        <li @class(['active' => session('service') === $service2->id])>
                                            <a class="js-arrow" href="{{ route('admin.service.edit',$service2) }}">
                                                <i class="fas fa-tachometer-alt"></i>{{ $service2->nom }}</a>
                                        </li>
                                    @endforeach
                                    <li @class(['active' => $route === 'citoyen','mt-2'])>
                                        <a class="js-arrow" href="{{ route('citoyen.dashboard') }}">
                                            <>compte citoyen</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </aside>
                    <!-- END MENU SIDEBAR-->
                @else
                    <!-- MENU SIDEBAR-->
                    <aside class="menu-sidebar d-none d-lg-block">
                        <div class="logo">
                            <a href="#">
                                <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
                            </a>
                        </div>
                        <div class="menu-sidebar__content js-scrollbar1">
                            <nav class="navbar-sidebar">
                                <ul class="list-unstyled navbar__list">
                                    <li @class(['active' => $route === 'operateur.dashboard'])>
                                        <a class="js-arrow" href="{{ route('operateur.dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                    </li>
                                    <li @class(['active' => $route === 'operateur.incident.list'])>
                                        <a href="{{ route('operateur.incident.list') }}">
                                            <i class="fas fa-chart-bar"></i>En traitement</a>
                                    </li>
                                    <li @class(['active' => $route === 'operateur.incident.archive'])>
                                        <a href="{{ route('operateur.incident.archive') }}">
                                            <i class="fas fa-table"></i>Archives</a>
                                    </li>
                                    <li @class(['active' => $route === 'operateur.user.statistique'])>
                                        <a href="{{ route('operateur.user.statistique') }}">
                                            <i class="fas fa-table"></i>Statistiques</a>
                                    </li>
                                    <li @class(['active' => $route === 'citoyen','mt-2'])>
                                        <a class="js-arrow" href="{{ route('citoyen.dashboard') }}">
                                            <>compte citoyen</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </aside>
                    <!-- END MENU SIDEBAR-->
                @endif
            @endif

            <!-- PAGE CONTAINER-->
            {{ $slot }}


        </div>



    </body>
@endsection

@section('scripts')
    <!-- Jquery JS-->
    <script src="{{ asset('backend/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('backend/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('backend/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('backend/js/main.js') }}"></script>
@endsection
