@extends('dashboard.layouts.master')

@section('page-title', 'Configurações de notificação')

@section('content_header')
    <h1>
        Configurações de planos
        <small>gerencie as configurações de planos do sistema</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="javascript:;">Configurações</a></li>
        <li class="active">Planos</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Gerenciar configurações')
<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <a href="#free" aria-controls="free" role="tab" data-toggle="tab">
                Free
            </a>
        </li>
        <li role="presentation">
            <a href="#premium" aria-controls="premium" role="tab" data-toggle="tab">
                Premium
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="free">
            <div class="row">
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="premium">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@stop

@section('js')
@stop
