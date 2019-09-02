@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('page-title', 'Visualizar pagamento')

@section('content_header')
    <h1>
        Visualizar pagamento
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Pagamentos</li>
        <li class="active">Visualizar</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')
@can('Visualizar pagamentos')
    <div class="row">
        <div class="col-md-8">
            @include('dashboard.payment.partials.details', ['edit' => false])
        </div>
    </div>
@endcan
@stop

@section('js')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
@stop
