<html lang="pt-BR" class="js" itemscope="" itemtype="https://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="alternate" hreflang="pt-br" href="https://contratabanda.com.br/">
        <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">
        <!--<link href="{{-- URL::asset('assets/css/bootstrap.css') --}}" rel="stylesheet">-->
        <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
        <link type="text/css" media="all" href="{{asset('assets/css/autoptimize_88267f2a88436fcef2673ce9ff68668d.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
        @yield('css')
        <title>Contrate música ao vivo - Contrata Banda</title>
        <script id="mfn-dnmc-config-js">
            window.mfn = {
                mobile_init: 1240,
                parallax: "translate3d",
                responsive: 1,
                retina_js: 0
            };
            window.mfn_lightbox = {
                disable: false,
                disableMobile: false,
                title: false,
            };
            window.mfn_sliders = {
                blog: 0,
                clients: 0,
                offer: 0,
                portfolio: 0,
                shop: 0,
                slider: 0,
                testimonials: 0
            };
            //
        </script>
        <meta name="description" content="Conheça artistas de vários estilos musicais, Bandas, DJs, Voz e violão, encontre o artista perfeito para o seu evento.">
        <link rel="canonical" href="https://contratabanda.com.br/">
        <script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
        <link rel="shortlink" href="https://contratabanda.com.br/">
    </head>
    <body class="home page-template-default page page-id-2  color-custom style-default button-default layout-full-width no-content-padding header-classic minimalist-header-no sticky-tb-color ab-hide subheader-both-center menu-line-below menuo-right footer-copy-center mobile-tb-center mobile-side-slide mobile-mini-mr-ll mobile-header-mini be-reg-20974">
    <div id="Wrapper">
        <div id="Header_wrapper">
            <header id="Header">
                <div class="header_placeholder"></div>
                <div id="Top_bar" class="">
                    <div class="container">
                        <div class="column one">
                            <div class="top_bar_left clearfix">
                                <div class="logo">
                                    <a id="logo" href="https://contratabanda.com.br" title="Contrata Banda" data-height="60" data-padding="20">
                                        <img class="logo-main scale-with-grid" src="{{asset('assets/images/logo2.png')}}" data-retina="" data-height="42" alt="logo2">
                                        <img class="logo-sticky scale-with-grid" src="{{asset('assets/images/logo2.png')}}" data-retina="" data-height="42" alt="logo2">
                                        <img class="logo-mobile scale-with-grid" src="{{asset('assets/images/logo3.png')}}" data-retina="" data-height="30" alt="logo3">
                                        <img class="logo-mobile-sticky scale-with-grid" src="{{asset('assets/images/logo2.png')}}" data-retina="" data-height="42" alt="logo2">
                                    </a>
                                </div>
                                <div class="menu_wrapper">
                                    <a class="responsive-menu-toggle " href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="top_bar_right">
                                <div class="top_bar_right_wrapper">
                                    <a href="{{route('advertisement.index')}}" class="action_button">Anúnciar grátis</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        @yield('titulo-interno')
        <div id="Content" class="@yield('ajuste-content')">
            <div class="content_wrapper clearfix">
                <div class="">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('frontend.includes.footer')
    </div>
    <div id="Side_slide" class="right dark enabled" data-width="250">
        <div class="close-wrapper">
            <a href="#" class="close">
                <i class="fa fa-close"></i>
            </a>
        </div>
        <div class="extras">
            <a href="{{route('advertisement.index')}}" class="action_button">Anúnciar grátis</a>
            <div class="extras-wrapper"></div>
        </div>
        <div class="lang-wrapper"></div>
        <div class="menu_wrapper">
            <nav id="menu">
                <ul id="menu-menu1" class="menu menu-main">
                    <li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom last">
                        <a href="{{route('artist.index')}}"><span>Artistas</span></a>
                    </li>
                    <li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom last">
                        <a href="{{route('professional.index')}}"><span>Profissionais</span></a>
                    </li>
                    @if (Auth::check())
                    <li class="menu-item menu-item-type-custom menu-item-object-custom last">
                        <a class="" type="button" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" @click.prevent="toggleDropdown()">
                            Minha conta
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
                            <li><a href="{{route('logout')}}">Sair</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        <ul class="social"></ul>
    </div>
    <div id="body_overlay"></div>
    <script type="text/javascript" defer="" src="{{asset('assets/js/autoptimize_b48e824f7f9c73f4a87db0e34d6d5024.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
    @yield('scripts')
    </body>
</html>
