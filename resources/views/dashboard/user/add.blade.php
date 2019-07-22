@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('page-title', 'Adicionar usuário')

@section('content_header')
    <h1>
        Criar novo usuário
        <small>Detalhes do usuario</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Usuários</li>
        <li class="active">Criar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Criar usuário')
    <form action="{{route('dashboard.user.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-8">
            @include('dashboard.user.partials.details', ['edit' => false])
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Criar usuário
            </button>
        </div>
    </div>
    </form>
@endcan
@stop


@section('js')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
@endsection

