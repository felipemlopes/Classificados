@extends('frontend.layouts.master')

@section('page-title', 'Entrar')

@section('content')
    <div class="row">
        <div class="col-sm-5 login-box">
            @include('partials/messages')
            <form role="form" action="{{route('login')}}" method="POST" id="login-form" autocomplete="off">
            <div class="panel panel-default">
                <div class="panel-intro text-center">
                    <h2 class="logo-title">
                        {{ setting('app_name') }}
                    </h2>
                </div>
                <div class="panel-body">
                    @csrf
                    <form role="form">
                        <div class="form-group">
                            <label for="sender-email" class="control-label">Email:</label>
                            <div class="input-icon"><i class="icon-user fa"></i>
                                <input name="email" id="email" placeholder="Email" class="form-control email" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user-pass" class="">Senha:</label>
                            <div class="input-icon"><i class="icon-lock fa"></i>
                                <input class="form-control" placeholder="Senha" id="password" type="password" name="password">
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-login">Entrar</button>
                        </div>


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

            @if (setting('reg_enabled'))
            <div class="login-box-btm text-center">
                <p> Não tem uma conta? <br>
                        <a href="{{route('register')}}" class="text-center">Registre-se</a>
            </div>
            @endif
            </form>
        </div>
    </div>
@stop

@section('after-scripts-end')

@stop
