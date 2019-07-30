@extends('frontend.layouts.master')

@section('page-title', 'Cadastrar')

@section('content')
<div class="row">
    <div class="col-sm-5 login-box">
        @include('partials/messages')

        <div class="panel panel-default">
            <div class="panel-intro text-center">
                <h2 class="logo-title">
                    Cadastre-se
                </h2>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('postregister') }}">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                        <div class="form-group">
                            <label class="h6" for="first_name">Nome</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                        <div class="form-group">
                            <label class="h6" for="last_name">Sobrenome</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                        <div class="form-group">
                            <label class="h6" for="email">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                        <div class="form-group">
                            <label class="h6" for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                        <div class="form-group">
                            <label class="h6" for="password_confirmation">Confirmar senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                        </div>
                    </div>
                    @if (setting('tos'))
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="tos">Aceitar termos de uso</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group text-center">
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <button type="submit" class="btn btn-primary">
                                Criar conta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
