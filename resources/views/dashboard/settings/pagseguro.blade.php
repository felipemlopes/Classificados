@extends('dashboard.layouts.master')

@section('page-title', 'Configurações gerais')

@section('content_header')
    <h1>
        Configurações do Pagseguro
        <small>gerencie as configuraçõesdo pagseguro</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="javascript:;">Configurações</a></li>
        <li class="active">Pagseguro</li>
    </ol>
@endsection

@section('content')
@include('partials.messages')

@can('Gerenciar configurações')
    <form action="{{route('dashboard.settings.pagseguro.update')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Configurações do pagseguro</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email"
                                   name="email" value="{{ $email }}">
                        </div>
                        <div class="form-group">
                            <label for="token">Token</label>
                            <input type="text" class="form-control" id="token"
                                   name="token" value="{{ $token }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-refresh"></i>
                            Atualizar configurações
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endcan
@stop

@section('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $('#price_ads_premium').mask('000,00', {reverse: true});
    </script>
@stop
