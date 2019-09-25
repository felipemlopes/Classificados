@extends('frontend.layouts.masterteste')


@section('css')
    <style href="{{asset('css/sweetalert.css')}}"></style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box box-minhaconta">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                    <ul class="list-inline text-center">
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.index') }}" class="link-myaccount">
                                <i class="fa fa-home"></i> Minha conta</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('message.index') }}" class="link-myaccount">
                                <i class="fa fa-envelope"></i> Mensagens</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.advertisement') }}" class="link-myaccount">
                                <i class="fa fa-tags"></i> Anúncios</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.plan') }}" class="link-myaccount active">
                                <i class="fa fa-credit-card"></i> Plano</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.payments') }}" class="link-myaccount">
                                <i class="fa fa-usd"></i> Pagamentos</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                                <i class="fa fa-cog"></i> Configurações</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 secao-minhaconta">

                    @include('partials.messages')

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        @if(Auth::User()->hasActiveSubscription())
                            <div class="col-xs-offset-1 col-xs-10 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 col-lg-offset-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted text-uppercase text-center">{{ $plano->name }}</h5>
                                        <h6 class="card-price text-center">R${{ $plano->price }}<span class="period">/mês</span></h6>
                                        <hr>
                                        <p class="text-center">Expira em: {{ date('d/m/Y', strtotime(Auth::User()->currentSubscription()->first()->expires_on)) }}</p>
                                        <a href="{{route('myaccount.plan.cancel')}}" class="btn btn-primary btn-block" id="cancelar">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if(count($planos)==1)
                                @foreach($planos as $key => $plano)
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-muted text-uppercase text-center">{{ $plano->name }}</h5>
                                                <h6 class="card-price text-center">R${{ $plano->price }}<span class="period">/mês</span></h6>
                                                <hr>
                                                <ul class="fa-ul">
                                                    @foreach($plano->features as $feature)
                                                        @if($feature->name=="qtd_ads_art")
                                                            <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de artistas</strong></li>
                                                        @endif
                                                        @if($feature->name=="qtd_ads_pro")
                                                            <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de profissionais</strong></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <a href="{{route('myaccount.plan.subscribe',$plano->id)}}" class="btn btn-primary btn-block">Assinar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(count($planos)==2)
                                @foreach($planos as $key => $plano)
                                    @if($key>0)
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title text-muted text-uppercase text-center">{{ $plano->name }}</h5>
                                                    <h6 class="card-price text-center">R${{ $plano->price }}<span class="period">/mês</span></h6>
                                                    <hr>
                                                    <ul class="fa-ul">
                                                        @foreach($plano->features as $feature)
                                                            @if($feature->name=="qtd_ads_art")
                                                                <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de artistas</strong></li>
                                                            @endif
                                                            @if($feature->name=="qtd_ads_pro")
                                                                <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de profissionais</strong></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <a href="{{route('myaccount.plan.subscribe',$plano->id)}}" class="btn btn-primary btn-block">Assinar</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title text-muted text-uppercase text-center">{{ $plano->name }}</h5>
                                                    <h6 class="card-price text-center">R${{ $plano->price }}<span class="period">/mês</span></h6>
                                                    <hr>
                                                    <ul class="fa-ul">
                                                        @foreach($plano->features as $feature)
                                                            @if($feature->name=="qtd_ads_art")
                                                                <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de artistas</strong></li>
                                                            @endif
                                                            @if($feature->name=="qtd_ads_pro")
                                                                <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de profissionais</strong></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <a href="{{route('myaccount.plan.subscribe',$plano->id)}}" class="btn btn-primary btn-block">Assinar</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @elseif(count($planos)>2)
                                @foreach($planos as $key => $plano)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center">{{ $plano->name }}</h5>
                                            <h6 class="card-price text-center">R${{ $plano->price }}<span class="period">/mês</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                @foreach($plano->features as $feature)
                                                    @if($feature->name=="qtd_ads_art")
                                                        <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de artistas</strong></li>
                                                    @endif
                                                    @if($feature->name=="qtd_ads_pro")
                                                        <li><span class="fa-li"></span><strong>{{$feature->limit}} anúncios de profissionais</strong></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <a href="{{route('myaccount.plan.subscribe',$plano->id)}}" class="btn btn-primary btn-block">Assinar</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script>
        jQuery('#cancelar').click(function (e) {
            e.preventDefault();
            swal({
                    title: "Você tem certeza que deseja cancelar a assinatura?",
                    buttons:{
                        cancel: {
                            text: "Não",
                                value: false,
                                visible: true,
                                className: "",
                                closeModal: true,
                        },
                        confirm: {
                            text: "Sim",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                        }
                    }
                }).then((willCancel) => {
                if (willCancel) {
                    jQuery(location).attr('href',$('#cancelar').attr('href'));
                }
            });



        });
    </script>
@endsection
