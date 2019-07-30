@extends('frontend.layouts.master')

@section('page-title', 'Redefinir senha')

@section('content')
    <div class="row">
        <div class="col-sm-5 login-box">
            @include('partials/messages')
            <form role="form" action="{{route('password.update')}}" method="POST" autocomplete="off">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title">
                            Redefinir senha
                    </div>
                    <div class="panel-body">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="sender-email" class="control-label">Email:</label>
                            <div class="input-icon"><i class="icon-user fa"></i>
                                <input name="email" id="email" placeholder="Email" class="form-control email" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Senha</label>
                            <div class="input-icon"><i class="icon-lock fa"></i>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Confirmar senha</label>
                            <div class="input-icon"><i class="icon-lock fa"></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-login">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
