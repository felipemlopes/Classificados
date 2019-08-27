<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>

        <title>Contrata Banda - </title>

        <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">


        <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
        @yield('css')

    </head>
    <body>
        <div id="app">
            <div id="wrapper">
                {{-- include do header --}}
                @include('frontend.includes.header')
                {{--<div id="Header_wrapper">
                    <header id="Header">
                        <div id="Top_bar" class="">
                            <div class="container">
                                <div class="column one">
                                    <div class="top_bar_left clearfix" style="width: 709px;">
                                        <div class="logo">
                                            <a id="logo" href="https://contratabanda.com.br" title="Contrata Banda" data-height="60" data-padding="20">
                                                <img class="logo-main scale-with-grid" src="https://contratabanda.com.br/wp-content/uploads/2019/07/logo2.png" data-retina="" data-height="42" alt="logo2">
                                                <img class="logo-sticky scale-with-grid" src="https://contratabanda.com.br/wp-content/uploads/2019/07/logo2.png" data-retina="" data-height="42" alt="logo2">
                                                <img class="logo-mobile scale-with-grid" src="https://contratabanda.com.br/wp-content/uploads/2019/07/logo3.png" data-retina="" data-height="30" alt="logo3">
                                                <img class="logo-mobile-sticky scale-with-grid" src="https://contratabanda.com.br/wp-content/uploads/2019/07/logo2.png" data-retina="" data-height="42" alt="logo2">
                                            </a>
                                        </div>
                                        <div class="menu_wrapper">
                                            <a class="responsive-menu-toggle " href="#">
                                                <i class="icon-menu-fine"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="top_bar_right">
                                        <div class="top_bar_right_wrapper">
                                            <a href="#" class="action_button">Anúnciar grátis</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                </div>--}


                {{-- talvez um include com a parte embaixo do header com o fundo e um yeild de conteudo --}}
                @yield('intro')



                <div class="main-container">
                    <div class="container">

                        {{-- aqui um yield de content para adicionar os conteudo --}}
                        @yield('content')

                    </div>
                </div>

                {{-- aqui não precisa de include da page-info hasOverly vai ir tudo no include content--}}
                @yield('footer-pageinfo')

                {{-- aqui não precisa do include da page botton info  vai ir tudo no include content--}}


            </div>
            {{--<div class="footer" id="footer">
                <div class="container">
                    <ul class="pull-left navbar-link footer-nav list-inline">
                    </ul>
                    <div>
                        <ul class=" navbar-link footer-nav text-center">

                        </ul>
                    </div>

                </div>
            </div>--}}
            <footer id="Footer" class="clearfix">
                <div class="footer_copy">
                    <div class="container">
                        <div class="column one">
                            <a id="back_to_top" class="button button_js" onclick="topFunction()">
                                <i class="icon-up-open-big"></i>
                            </a>
                            <div class="copyright"> © 2019 Contrata Banda. Todos os direitos reservados.
                                <a target="_blank" rel="nofollow" href="https://agenciaunit.com">Agência Unit</a>
                            </div>
                            <ul class="social">

                            </ul>
                        </div>
                    </div>
                </div>
            </footer>


        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script>
            function topFunction() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
        </script>
        @yield('scripts')
    </body>
</html>
