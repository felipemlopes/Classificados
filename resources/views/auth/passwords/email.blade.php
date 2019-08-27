@extends('frontend.layouts.masterteste')

@section('page-title', 'Recuperar senha')

@section('content')
<div class="row">
    <div class="col-xs-6 col-sm-5 col-md-5 login-box">
        @include('partials/messages')
        <form role="form" action="{{route('send.password.remind')}}" method="POST" autocomplete="off">
            <div class="panel panel-default">
                <div class="panel-intro text-center">
                    <h2 class="logo-title">
                        Recuperar senha
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
                            <button type="submit" class="btn btn-primary btn-block" id="btn-login">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
