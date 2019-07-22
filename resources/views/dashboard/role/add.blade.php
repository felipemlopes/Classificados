@extends('dashboard.layouts.master')

@section('page-title', 'Adicionar papel')

@section('content_header')
    <h1>
        Criar novo papel
        <small>Detalhes do papel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Papéis</li>
        <li class="active">Criar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Criar papéis')
    <form action="{{route('dashboard.role.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.role.partials.details', ['edit' => false])
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Criar papel
            </button>
        </div>
    </div>
    </form>
@endcan
@stop
