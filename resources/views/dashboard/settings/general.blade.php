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
                            <label for="app_name">Nome do site</label>
                            <input type="text" class="form-control" id="app_name"
                                   name="app_name" value="{{ setting('app_name')!=""?setting('app_name'):old('app_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="home_url">Url da home</label>
                            <input type="text" class="form-control" id="home_url"
                                   name="home_url" value="{{ setting('home_url')!=""?setting('home_url'):old('home_url') }}">
                        </div>
                        <div class="form-group">
                            <label for="qtd_ads_destaque">Quantidade de anúncios em destaque por página</label>
                            <input type="text" class="form-control" id="qtd_ads_destaque"
                                   name="qtd_ads_destaque" value="{{ setting('qtd_ads_destaque')!=""?setting('qtd_ads_destaque'):old('qtd_ads_destaque') }}">
                        </div>
                        <div class="form-group">
                            <label for="days_ads_free">Dias que um anúncio gratuito fica no sistema</label>
                            <input type="text" class="form-control" id="days_ads_free"
                                   name="days_ads_free" value="{{ setting('days_ads_free')!=""?setting('days_ads_free'):old('days_ads_free') }}">
                        </div>
                        <div class="form-group">
                            <label for="days_ads_premium">Dias que um anúncio premium fica no sistema</label>
                            <input type="text" class="form-control" id="days_ads_premium"
                                   name="days_ads_premium" value="{{ setting('days_ads_premium')!=""?setting('days_ads_premium'):old('days_ads_premium') }}">
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
