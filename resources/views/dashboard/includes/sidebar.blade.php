<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                @if(Auth::check())
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @can('Visualizar usuários')
            <li class="">
                <a href="{{ route('dashboard.user.list') }}">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                </a>
            </li>
            @endcan
            @can('Visualizar anúncios')
                <li class="">
                    <a href="{{ route('dashboard.advertisement.list') }}">
                        <i class="fa fa-file"></i> <span>Anúncios</span>
                    </a>
                </li>
            @endcan
            @can('Visualizar categorias')
                <li class="">
                    <a href="{{ route('dashboard.category.list') }}">
                        <i class="fa fa-tags"></i> <span>Categorias</span>
                    </a>
                </li>
            @endcan
            @can('Visualizar estilos musicais')
                <li class="">
                    <a href="{{ route('dashboard.musicstyle.list') }}">
                        <i class="fa fa-music"></i> <span>Estilos musicais</span>
                    </a>
                </li>
            @endcan
            @can('Visualizar papéis')
            <li class="">
                <a href="{{ route('dashboard.role.index') }}">
                    <i class="fa fa-user"></i> <span>Papéis</span>
                </a>
            </li>
            @endcan
            @can('Visualizar permissões')
            <li class="">
                <a href="{{ route('dashboard.permission.index') }}">
                    <i class="fa fa-lock"></i> <span>Permissões</span>
                </a>
            </li>
            @endcan
            @can('Gerenciar configurações')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Configurações</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('dashboard.settings.general') }}">
                            <i class="fa fa-circle-o"></i>
                            Gerais
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('dashboard.settings.auth') }}">
                            <i class="fa fa-circle-o"></i>
                            Autenticação e registro
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('dashboard.settings.plans') }}">
                            <i class="fa fa-circle-o"></i>
                            Planos
                        </a>
                    </li>
                </ul>
            </li>
            @endcan









        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
