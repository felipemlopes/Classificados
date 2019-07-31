@extends('frontend.layouts.master')


@section('css')
    <style>
        .menu-minhaconta{
            margin-top: 40px;
        }
        .li-menuminhaconta{
            margin-top: 25px;
        }
        .link-myaccount{
            color: #999;
            font-size: 16px;
            text-decoration: none;
            margin-left: 10px;
            margin-right: 10px;
        }
        .link-myaccount:hover{
            color: #2b2f45;
            text-decoration: none;
            border-bottom: 3px solid;
            padding-bottom: 5px;
        }
        .link-myaccount:focus{
            color: #999;
            text-decoration: none;
        }
        .link-myaccount:active{
            color: #999;
            text-decoration: none;
        }
        .link-myaccount.active{
            color: #2b2f45;
            text-decoration: none;
            border-bottom: 3px solid;
            padding-bottom: 5px;
        }
        .minhaconta-titulo{
            font-size: 18px;
        }
        .minhaconta-item{
            font-size: 30px;
            color: #E62159;
        }
        .secao-minhaconta{
            margin-top: 40px;
        }


        .small-box {
            border-radius: 2px;
            position: relative;
            display: block;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            background-color: #F20E4C;
            color: #fff;
        }
        .small-box > .inner {
            padding: 10px;
        }
        .small-box h3, .small-box p {
            z-index: 5;
        }
        .small-box h3 {
            font-size: 38px;
            font-weight: bold;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }
        .small-box h3, .small-box p {
            z-index: 5;
        }
        .small-box p {
            font-size: 15px;
        }
        .small-box .icon {
            -webkit-transition: all .3s linear;
            -o-transition: all .3s linear;
            transition: all .3s linear;
            position: absolute;
            top: -10px;
            right: 10px;
            z-index: 0;
            font-size: 90px;
            color: rgba(0,0,0,0.15);
        }
        .small-box > .small-box-footer {
            position: relative;
            text-align: center;
            padding: 3px 0;
            color: #fff;
            color: rgba(255,255,255,0.8);
            display: block;
            z-index: 10;
            background: rgba(0,0,0,0.1);
            text-decoration: none;
        }




        .nav-tabs-custom > .nav-tabs > li.active > a {
            border-top-color: transparent;
            border-left-color: #f4f4f4;
            border-right-color: #f4f4f4;
        }
        .nav-tabs-custom > .nav-tabs > li.active > a, .nav-tabs-custom > .nav-tabs > li.active:hover > a {
            background-color: #fff;
            color: #444;
        }
        .nav-tabs-custom > .nav-tabs > li > a, .nav-tabs-custom > .nav-tabs > li > a:hover {
            background: transparent;
            background-color: transparent;
            margin: 0;
        }
        .nav-tabs-custom > .nav-tabs > li > a {
            color: #444;
            border-radius: 0;
        }
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-top-color: rgb(221, 221, 221);
            border-right-color: rgb(221, 221, 221);
            border-bottom-color: rgb(221, 221, 221);
            border-left-color: rgb(221, 221, 221);
            border-bottom-color: transparent;
        }
        .nav-tabs > li > a {
            margin-right: 2px;
            line-height: 1.42857143;
            border: 1px solid transparent;
            border-radius: 4px 4px 0 0;
        }
        .nav > li > a {
            position: relative;
            display: block;
            padding: 10px 15px;
        }

        .nav-tabs-custom > .nav-tabs > li:first-of-type {
            margin-left: 0;
        }
        .nav-tabs-custom > .nav-tabs > li.active {
            border-top-color: #F20E4C;
        }
        .nav-tabs-custom > .nav-tabs > li {
            border-top: 3px solid transparent;
            border-top-color: transparent;
            margin-bottom: -2px;
            margin-right: 5px;
        }
        .nav-tabs > li {
            float: left;
            margin-bottom: -1px;
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                <ul class="list-inline text-center">
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.index') }}" class="link-myaccount">
                            <i class="fa fa-home"></i> Minha conta</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.advertisement') }}" class="link-myaccount">
                            <i class="fa fa-home"></i> Anúncios</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.settings') }}" class="link-myaccount active">
                            <i class="fa fa-cog"></i> Configurações</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">

                @include('partials.messages')

                <div class="col-xs-6 col-md-6 col-lg-6">
                    <h3>Detalhes</h3>
                    <div class="panel-body">
                        <form action="{{route('myaccount.settings.update.details')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="first_name">Nome</label>
                                <input type="text" class="form-control" id="first_name"
                                       name="first_name" placeholder="Nome do usuário" value="{{Auth::User()->first_name}}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Sobrenome</label>
                                <input type="text" class="form-control" id="last_name"
                                       name="last_name" placeholder="Sobrenome do usuário" value="{{Auth::User()->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email"
                                       name="email" placeholder="Email do usuário" value="{{Auth::User()->email}}">
                            </div>
                            <button type="submit" class="btn btn-primary" id="update-login-details-btn">
                                <i class="fa fa-refresh"></i>
                                Atualizar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <div class="panel panel-default">
                        <h3>Alterar senha</h3>
                        <div class="panel-body">
                            <form action="{{route('myaccount.settings.update.password')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="password">Nova senha</label>
                                    <input type="password" class="form-control" id="password"
                                           name="password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar nova senha</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" value="">
                                </div>
                                <button type="submit" class="btn btn-primary" id="update-login-details-btn">
                                    <i class="fa fa-refresh"></i>
                                    Atualizar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('footer-pageinfo')
@endsection
