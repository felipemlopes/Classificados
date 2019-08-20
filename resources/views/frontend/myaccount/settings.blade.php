@extends('frontend.layouts.master')


@section('css')
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
                        <a href="{{ route('myaccount.plan') }}" class="link-myaccount">
                            <i class="fa fa-credit-card"></i> Plano</a>
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
