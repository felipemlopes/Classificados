@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
@endsection

@section('page-title', 'Editar usuário')

@section('content_header')
    <h1>
        {{ $user->name }}
        <small>editar detalhes do usuário</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Usuários</li>
        <li class="active">Editar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                Detalhes
            </a>
        </li>
        <li role="presentation">
            <a href="#auth" aria-controls="auth" role="tab" data-toggle="tab">
                <i class="fa fa-lock"></i>
                Alterar senha
            </a>
        </li>
        @can('Gerenciar papel usuário')
        <li role="presentation">
            <a href="#role" aria-controls="role" role="tab" data-toggle="tab">
                <i class="fa fa-lock"></i>
                Papel
            </a>
        </li>
        @endcan
        @can('Gerenciar permissões usuário')
        <li role="presentation">
            <a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab">
                <i class="fa fa-lock"></i>
                Permissões
            </a>
        </li>
        @endcan
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="details">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    @can('Editar usuário')
                        <form action="{{route('dashboard.user.update.details', $user->id)}}" method="post">
                        @csrf
                        @include('dashboard.user.partials.details')
                        </form>
                    @endcan
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="auth">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('dashboard.user.update.login-details', $user->id)}}" method="post">
                    @csrf
                    @include('dashboard.user.partials.auth')
                    </form>
                </div>
            </div>
        </div>
        @can('Gerenciar papel usuário')
        <div role="tabpanel" class="tab-pane" id="role">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('dashboard.user.update.role', $user->id)}}" method="post">
                    @csrf
                    @include('dashboard.user.partials.role')
                    </form>
                </div>
            </div>
        </div>
        @endcan
        @can('Gerenciar permissões usuário')
        <div role="tabpanel" class="tab-pane" id="permissions">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('dashboard.user.update.permission', $user->id)}}" method="post">
                    @csrf
                    @include('dashboard.user.partials.permissions')
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
@stop
