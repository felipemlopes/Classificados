@extends('frontend.layouts.masterteste')


@section('css')
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
                            <i class="fa fa-tags"></i> Anúncios</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.plan') }}" class="link-myaccount">
                            <i class="fa fa-credit-card"></i> Plano</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                            <i class="fa fa-cog"></i> Configurações</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">
                <div class="col-xs-12 col-md-12 col-lg-12 secao">
                    {{--@if(Auth::User()->hasActiveSubscription())
                        <p class="minhaconta-titulo text-center">Plano: {{ Auth::User()->currentSubscription()->first()->plan->name }}</p>
                        <p class="minhaconta-titulo text-center">O plano expira em: {{ date('d/m/Y', strtotime(Auth::User()->currentSubscription()->first()->expires_on)) }}</p>
                    @else
                        <p class="minhaconta-titulo text-center">Plano: Gratuito</p>

                    @endif--}}
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
                        <div class="small-box">
                            <div class="inner text-center">
                                <h3>{{$advertisements}}</h3>
                                <p>Anúncios</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="{{ route('myaccount.advertisement') }}" class="small-box-footer">
                                Ver todos anúncios <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 ">
                        <div class="small-box">
                            <div class="inner text-center">
                                <h3>{{$advertisements}}</h3>
                                <p>Visitas</p>
                            </div>
                            <div class="icon">
                            </div>
                            <p class="small-box-footer" style="height: 30px;"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 col-xs-offset-3 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">
                        <div class="small-box">
                            <div class="inner text-center">
                                <h3>{{$messages}}</h3>
                                <p>Mensgens não lidas</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="{{ route('message.index') }}" class="small-box-footer">
                                Ver minhas mensagens <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('footer-pageinfo')
@endsection
