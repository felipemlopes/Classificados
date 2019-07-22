@extends('dashboard.layouts.master')

@section('page-title', 'Configurações gerais')

@section('content_header')
    <h1>
        Configurações gerais
        <small>gerencie as configurações gerais do sistema</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="javascript:;">Configurações</a></li>
        <li class="active">Gerais</li>
    </ol>
@endsection

@section('content')
@include('partials.messages')

@can('Gerenciar configurações')
    <form action="{{route('dashboard.settings.general.update')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Configurações gerais</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name">Nome do site</label>
                            <input type="text" class="form-control" id="app_name"
                                   name="app_name" value="{{ setting('app_name') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-refresh"></i>
                            Atualizar configurações
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </form>
@endcan
@stop

@section('js')
@stop
