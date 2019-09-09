@extends('frontend.layouts.masterteste')


@section('css')
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
                            <a href="{{ route('myaccount.plan') }}" class="link-myaccount">
                                <i class="fa fa-credit-card"></i> Plano</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.settings') }}" class="link-myaccount active">
                                <i class="fa fa-cog"></i> Configurações</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 secao-minhaconta">
                    @include('partials.messages')
                    <div class="nav-tabs-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                                    <i class="fa fa-info"></i>
                                    Detalhes
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#auth" aria-controls="auth" role="tab" data-toggle="tab">
                                    <i class="fa fa-lock"></i>
                                    Alterar senha
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active secao-ajuste" id="details">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 secao-ajuste-topo">
                                        <div class="col-md-12">
                                            <form action="{{route('myaccount.settings.update.details')}}" method="post">
                                                @csrf
                                                <h2 class="text-center">Editar detalhes</h2>
                                                <div class="col-md-12">
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
                                                    <button type="submit" class="btn btn-primary btn-block" id="update-details-btn">
                                                        <i class="fa fa-refresh"></i>
                                                        Atualizar
                                                    </button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="auth">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 secao-ajuste-topo">
                                        <div class="">
                                            <h2 class="text-center">Alterar senha</h2>
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
                                                <button type="submit" class="btn btn-primary btn-block" id="update-login-details-btn">
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
                </div>
            </div>
        </div>
    </div>


@endsection


@section('footer-pageinfo')
@endsection
