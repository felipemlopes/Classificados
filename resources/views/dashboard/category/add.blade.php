@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('page-title', 'Adicionar categoria')

@section('content_header')
    <h1>
        Criar nova categoria
        <small>Detalhes da categoria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Categorias</li>
        <li class="active">Criar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Criar categorias')
    <form action="{{route('dashboard.category.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @include('dashboard.category.partials.details', ['edit' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Criar categoria
                </button>
            </div>
        </div>
    </form>
@endcan
@stop

@section('js')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
@stop
