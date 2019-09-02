@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('page-title', 'Adicionar plano')

@section('content_header')
    <h1>
        Criar novo plano
        <small>Detalhes do plano</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Planos</li>
        <li class="active">Criar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Criar planos')
    <form action="{{route('dashboard.plan.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @include('dashboard.plan.partials.details', ['edit' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Criar plano
                </button>
            </div>
        </div>
    </form>
@endcan
@stop

@section('js')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $('#price').mask('000,00', {reverse: true});
    </script>
@stop
