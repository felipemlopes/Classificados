
<div class="header">
    <div class="container">
        <nav class="navbar navbar-site navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a href="{{setting('home_url')}}" class="navbar-brand logo logo-title hidden-xs">
                    <span class="logo-icon">
                        <img src="{{asset('assets/images/logo2.png')}}">
                    </span>
                </a>
                <a href="{{setting('home_url')}}" class="navbar-brand logo logo-title visible-xs col-xs-10" style="width: 75%;">
                    <span class="logo-icon">
                        <img src="{{asset('assets/images/logo.png')}}">
                    </span>
                </a>
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li><a href="{{route('artist.index')}}">Artistas</a></li>
                        <li><a href="{{route('professional.index')}}">Profissionais</a></li>
                        <li class="hidden-xs"><a href="{{route('advertisement.index')}}" class="btn btn-primary">Anúnciar</a></li>
                        <li class="visible-xs"><a href="{{route('advertisement.index')}}" class="">Anúnciar grátis</a></li>
                        <li :class="{'hidden-xs': true==true, 'show':dropdownmenu==true}">
                            <a class="" type="button" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" @click.prevent="toggleDropdown()">
                                <i class="fa fa-ellipsis-h"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="myaccount">
                                <li><a href="{{route('myaccount.index')}}">Minha Conta</a></li>
                                <li><a href="{{route('myaccount.advertisement')}}">Meus anúncios</a></li>
                                <li><a href="{{route('message.index')}}">Mensagens</a></li>
                                <li><a href="{{route('myaccount.settings')}}">Configurações</a></li>
                                @hasanyrole('Administrador|Gerente|Proprietário')
                                <li>
                                    <a href="{{route('dashboard.index')}}">Dashboard</a>
                                </li>
                                @endhasanyrole
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route('logout')}}">Sair</a></li>
                            </ul>
                        </li>
                        <li class="visible-xs"><a href="{{route('myaccount.index')}}">Minha Conta</a></li>
                        <li class="visible-xs"><a href="{{route('myaccount.advertisement')}}">Meus anúncios</a></li>
                        <li class="visible-xs"><a href="{{route('message.index')}}">Mensagens</a></li>
                        <li class="visible-xs"><a href="{{route('myaccount.settings')}}">Configurações</a></li>
                        @hasanyrole('Administrador|Gerente|Proprietário')
                        <li class="visible-xs"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        @endhasanyrole
                        <li role="separator" class="divider visible-xs"></li>
                        <li class="visible-xs"><a href="{{route('logout')}}">Sair</a></li>
                    @else
                        <li><a href="{{route('artist.index')}}">Artistas</a></li>
                        <li><a href="{{route('professional.index')}}">Profissionais</a></li>
                        <li class="hidden-xs"><a href="{{route('advertisement.index')}}" class="btn btn-primary">Anúnciar grátis</a></li>
                        <li class="visible-xs"><a href="{{route('advertisement.index')}}" class="">Anúnciar grátis</a></li>
                    @endif

                </ul>
            </div>

        </div>
    </nav>
    </div>
</div>
<!--<div class="sub-nav">
    <div class="container">
        <ul class="list-inline links-menu">
            <li><a href="#" class="link-menu active">Home</a></li>
            <li><a href="#" class="link-menu ">Artistas</a></li>
            <li><a href="#" class="link-menu ">Profissionais</a></li>
            <li><a href="#" class="link-menu ">Anúnciar</a></li>
        </ul>
    </div>
</div>-->
