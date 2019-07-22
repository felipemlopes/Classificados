<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('dashboard.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{ url('assets/img/easyadmin-logo-no-text.png') }}" height="35px" alt="{{ setting('app_name') }}">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ setting('app_name') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">@lang('toggle_navigation')</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if(Auth::check())
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::User()->first_name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <span class="hidden-xs">{{ Auth::User()->name }}</span>
                            <p>
                                <small>Membro desde {{ date('d/m/Y', strtotime(Auth::User()->created_at)) }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <a href="{{ route('dashboard.profile') }}" class="btn btn-default btn-block">
                               <i class="fa fa-user"></i>
                               Meu Perfil
                            </a>


                            <a href="{{ route('logout') }}" class="btn btn-default btn-block"
                               onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                                {{ __('Logout') }}>
                               <i class="fa fa-sign-out"></i>
                               Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
