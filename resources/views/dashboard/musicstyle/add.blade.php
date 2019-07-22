@extends('dashboard.layouts.master')

@section('page-title', 'Adicionar estilo musical')

@section('content_header')
    <h1>
        Criar novo estilo musical
        <small>Detalhes do estilo musical</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Estilos musicais</li>
        <li class="active">Criar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Criar estilos musicais')
    <form action="{{route('dashboard.musicstyle.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @include('dashboard.musicstyle.partials.details', ['edit' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Criar estilo musical
                </button>
            </div>
        </div>
    </form>
@endcan
@stop
