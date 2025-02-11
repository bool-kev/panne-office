<x-backend title="citoyen">
    @php($route = request()->route()->action['as'])
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar2">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
            </a>
        </div>
        <div class="menu-sidebar2__content js-scrollbar1">
            <div class="account2">
                <div class="image img-cir img-120">
                    <img src="{{ asset('images/avatar.png') }}" alt="user" />
                </div>
                <h4 class="name">{{ request()->user()->getFullname() }}</h4>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn-sm text-danger" title="Me deconnecter">Deconnexion</button>
                </form>
            </div>
            <nav class="navbar-sidebar2">
                <ul class="list-unstyled navbar__list">

                    <li @class([
                        'active' =>
                            Str::startsWith($route, 'citoyen.') &&
                            $route !== 'citoyen.incident.list',
                    ])>
                        <a href="{{ route('citoyen.dashboard') }}">
                            <i class="fas fa-chart-bar"></i>Mes declarations</a>
                        <span class="inbox-num">{{ request()->user()->incidents->count()}}</span>
                    </li>
                    <li @class(['active' => $route === 'citoyen.incident.list'])>
                        <a href="{{ route('citoyen.incident.list') }}">
                            <i class="fas fa-shopping-basket"></i>Archives</a>
                    </li>
                    @if(request()->user()->role_id===2)
                        <li @class(['mt-2'])>
                            <a class="js-arrow" href="{{ route('operateur.dashboard') }}">
                            <>compte operateur</a>
                        </li>
                    @elseif(request()->user()->role_id===3)
                        <li @class(['mt-2'])>
                            <a class="js-arrow" href="{{ route('admin.dashboard') }}">
                            <>compte admin</a>
                        </li>
                    @endif

                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container2">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop2">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap2">
                        <div class="logo d-block d-lg-none">
                            <a href="/">
                                <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
                            </a>
                        </div>
                        <div class="header-button2">
                            <div class="header-button-item js-item-menu">
                                <i class="zmdi zmdi-search"></i>
                                <div class="search-dropdown js-dropdown">
                                    <form action="">
                                        <input class="au-input au-input--full au-input--h65" type="text"
                                            placeholder="Search for datas &amp; reports..." />
                                        <span class="search-dropdown__icon">
                                            <i class="zmdi zmdi-search"></i>
                                        </span>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="header-button-item mr-0 js-sidebar-btn">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                            <div class="setting-menu js-right-sidebar  d-lg-block">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('profile.edit') }}">
                                            <i class="zmdi zmdi-account"></i>Account</a>

                                            <ul class="list-unstyled navbar__list">

                                                <li @class([
                                                    'active' =>
                                                        Str::startsWith($route, 'citoyen.') &&
                                                        $route !== 'citoyen.incident.list',
                                                ])>
                                                    <a href="{{ route('citoyen.dashboard') }}">
                                                        <i class="fas fa-chart-bar"></i>Mes declarations <span class="bg-danger px-1">{{ request()->user()->incidents->count()}}</span></a>
                                                </li>
                                                <li @class(['active' => $route === 'citoyen.incident.list'])>
                                                    <a href="{{ route('citoyen.incident.list') }}">
                                                        <i class="fas fa-shopping-basket"></i>Archives</a>
                                                </li>

                                                @if(request()->user()->role_id===2)
                                                    <li @class(['mt-2'])>
                                                        <a class="js-arrow" href="{{ route('operateur.dashboard') }}">
                                                        <>compte operateur</a>
                                                    </li>
                                                @elseif(request()->user()->role_id===3)
                                                    <li @class(['mt-2'])>
                                                        <a class="js-arrow" href="{{ route('admin.dashboard') }}">
                                                        <>compte admin</a>
                                                    </li>
                                                @endif
                                            </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </header>

        <!-- END HEADER DESKTOP-->

        @yield('content2')
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
</x-backend>
