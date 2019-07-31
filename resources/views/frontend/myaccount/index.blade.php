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
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                <ul class="list-inline text-center">
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.index') }}" class="link-myaccount active">
                            <i class="fa fa-home"></i> Minha conta</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.advertisement') }}" class="link-myaccount">
                            <i class="fa fa-home"></i> Anúncios</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                            <i class="fa fa-cog"></i> Configurações</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">
                <p class="minhaconta-titulo text-center">Plano: {{Auth::User()->currentSubscription()->first()->plan->name}}</p>

                <p class="minhaconta-titulo text-center">O plano expira em: {{ date('d/m/Y', strtotime(Auth::User()->currentSubscription()->first()->expires_on))}}</p>

                <div class="col-xs-10 col-md-4 col-lg-4 col-xs-offset-1 col-md-offset-4 col-lg-offset-4">
                    <div class="small-box">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Total de anúncios</p>
                        </div>
                        <div class="icon">
                        </div>
                        <a href="{{ route('myaccount.advertisement') }}" class="small-box-footer">
                            Ver todos anúncios <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer-pageinfo')
@endsection
