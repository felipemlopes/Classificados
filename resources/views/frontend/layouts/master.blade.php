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
        <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/owl_002.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/owl.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/owlcarousel/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/owlcarousel/owl.theme.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/owlcarousel/owl.transitions.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
        <script>
            paceOptions = {
                elements: true
            };
        </script>
        <script src="{{ URL::asset('assets/js/pace.js') }}"></script>
        @yield('css')

    </head>
    <body class="  pace-done">
        <div class="pace  pace-inactive">
            <div data-progress="99" data-progress-text="100%" style="width: 100%;" class="pace-progress">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div>
        </div>


        <div id="wrapper">
            {{-- include do header --}}
            @include('frontend.includes.header')


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
        <div class="footer" id="footer">
            <div class="container">
                <ul class="pull-left navbar-link footer-nav list-inline">
                    <!--<li>
                        <a href="{{--route('frontend.index')--}}"> Home </a>
                    </li>
                    <li>
                        <a href="{{--route('frontend.index')--}}"> Sobre </a>
                    </li>
                    <li>
                        <a href="{{--route('frontend.index')--}}"> Termos e Condições </a>
                    </li>
                    <li>
                        <a href="{{--route('frontend.index')--}}"> Contato </a>
                    </li>-->
                </ul>
                <div>
                    <ul class=" navbar-link footer-nav text-center">
                        <li> © 2015 {{-- settings('app_name') --}}</li>
                    </ul>
                </div>

            </div>
        </div>
        <script src="{{ URL::asset('assets/js/jquery_002.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{ URL::asset('assets/js/owl.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery_006.js') }}"></script>
        <script src="{{ URL::asset('assets/js/hideMaxListItem.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery_004.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/plugins//owlcarousel/owl.carousel.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery_005.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery_003.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/usastates.js') }}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        @yield('scripts')
    </body>
</html>
