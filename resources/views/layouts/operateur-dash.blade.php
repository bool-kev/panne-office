<x-backend :admin="$admin??false" :title="$admin??false?'admin':'operateur'">
    @php($route = request()->route()->action['as'])

    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-accounfluid">
                    <div class="header-wrap">
                        <form class="form-header" action="" method="POST">
                            <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        <div class="header-button">
                            
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="{{ asset('images/avatar.png')}}" alt="John Doe" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">{{ request()->user()->getFullname()}}</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ asset('images/avatar.png')}}" alt="John Doe" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">{{ request()->user()->getFullname()}}</a>
                                                </h5>
                                                <span class="email">{{ request()->user()->email}}</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('profile.edit')}}">
                                                    <i class="zmdi zmdi-account"></i>Profil</a>
                                            </div>
                                            
                                        </div>
                                        <form class="account-dropdown__footer" method="POST" action="{{ route('logout')}}" id="logout-form">
                                            @csrf
                                            <a href="#" onclick="document.getElementById('logout-form').submit()" class="text-danger">
                                                <i class="zmdi zmdi-power"></i>Deconnexion</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->
        @yield('content2')
    </div>
</x-backend>