@extends('frontend.layouts.masterteste')

@section('page-title', 'Entrar')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-sm-5 col-md-5 login-box">
            @include('partials/messages')
            <form role="form" action="{{route('login')}}" method="POST" id="login-form" autocomplete="off">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title">
                            Entrar
                        </h2>
                    </div>
                    <div class="panel-body">
                        @csrf
                        <form role="form">
                            <div class="form-group">
                                <label for="sender-email" class="control-label">Email:</label>
                                <div class="input-icon">
                                    <i class="icon-user fa"></i>
                                    <input name="email" id="email" placeholder="Email" class="form-control email" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user-pass" class="">Senha:</label>
                                <div class="input-icon">
                                    <i class="icon-lock fa"></i>
                                    <input class="form-control" placeholder="Senha" id="password" type="password" name="password">
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            </div>
                            @if (setting('reg_enabled'))
                            <div class="form-group">
                                <a href="{{route('register')}}" class="btn btn-secondary btn-block">Criar conta</a>
                            </div>
                            @endif
                        </form>
                    </div>
                    <div class="panel-footer">
                        @if (setting('forgot_password'))
                            <p class="text-center pull-right"><a href="{{route('password.remind')}}">Esqueci a minha senha</a>
                            </p>
                        @endif
                        <div style=" clear:both"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('after-scripts-end')

@stop
