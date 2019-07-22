@extends('dashboard.layouts.master')

@section('page-title', 'Adicionar permissão')

@section('content_header')
    <h1>
        Criar nova permissão
        <small>Detalhes da permissão</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Permissões</li>
        <li class="active">Criar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Criar permissões')
    <form action="{{route('dashboard.permission.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @include('dashboard.permission.partials.details', ['edit' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Criar permissão
                </button>
            </div>
        </div>
    </form>
@endcan
@stop
