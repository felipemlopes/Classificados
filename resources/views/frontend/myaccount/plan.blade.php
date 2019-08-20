@extends('frontend.layouts.master')


@section('css')
    <style href="{{asset('css/sweetalert.css')}}"></style>
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
                            <i class="fa fa-tags"></i> Anúncios</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.plan') }}" class="link-myaccount active">
                            <i class="fa fa-credit-card"></i> Plano</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                            <i class="fa fa-cog"></i> Configurações</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">

                @include('partials.messages')

                <div class="col-xs-6 col-md-6 col-lg-6">
                    <h3>Detalhes</h3>
                    <div class="panel-body">
                        @if(Auth::User()->hasActiveSubscription())
                            <h3>Plano: {{ Auth::User()->currentSubscription()->first()->plan->name }}</h3>
                            <h3>Expira em: {{ date('d/m/Y', strtotime(Auth::User()->currentSubscription()->first()->expires_on)) }}</h3>
                            <a href="{{route('myaccount.plan.cancel')}}" class="btn btn-primary" id="cancelar">Cancelar</a>
                        @else
                            <h3>Plano: {{ $plano->name }}</h3>
                            <h3>Preço: R${{ $plano->price }}</h3>
                            <ul>
                                @foreach($plano->features as $feature)
                                    @if($feature->name=="qtd_ads_art")
                                        <li>{{$feature->limit}} anúncios de artistas</li>
                                    @endif
                                    @if($feature->name=="qtd_ads_pro")
                                        <li>{{$feature->limit}} anúncios de profissionais</li>
                                    @endif
                                @endforeach
                            </ul>
                            <a href="{{route('myaccount.plan.subscribe',$plano->id)}}" class="btn btn-primary">Assinar</a>
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
        $('#cancelar').click(function (e) {
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
                    $(location).attr('href',$('#cancelar').attr('href'));
                }
            });



        });
    </script>
@endsection
