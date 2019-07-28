@extends('dashboard.layouts.master')

@section('page-title', 'Configurações de auteticação')

@section('content_header')
    <h1>
        Autenticação e registro
        <small>configuração do sistema de autenticação e registro</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="javascript:;">Configurações</a></li>
        <li class="active">Autenticação e registro</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Gerenciar configurações')
<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <a href="#auth" aria-controls="auth" role="tab" data-toggle="tab">
                <i class="fa fa-lock"></i>
                Autenticação
            </a>
        </li>
        <li role="presentation">
            <a href="#registration" aria-controls="registration" role="tab" data-toggle="tab">
                <i class="fa fa-user-plus"></i>
                Registro
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="auth">
            <div class="row">
                <div class="col-md-6">
                    @include('dashboard.settings.partials.auth')
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="registration">
            <div class="row">
                <div class="col-md-6">
                    @include('dashboard.settings.partials.registration')
                </div>
                <div class="col-md-6">
                    @include('dashboard.settings.partials.recaptcha')
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@stop

@section('js')
@stop
