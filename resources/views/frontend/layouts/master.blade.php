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
        <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
        @yield('css')

    </head>
    <body>
        <div id="app">
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
                    </ul>
                    <div>
                        <ul class=" navbar-link footer-nav text-center">

                        </ul>
                    </div>

                </div>
            </div>
        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        @yield('scripts')
    </body>
</html>
