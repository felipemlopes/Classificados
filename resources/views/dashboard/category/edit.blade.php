@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('page-title', 'Editar categoria')

@section('content_header')
    <h1>
        {{ $category->name }}
        <small>editar detalhes da categoria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Categorias</li>
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
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @can('Editar categorias')
                    <form action="{{route('dashboard.category.update',$category->id)}}" method="post">
                    @csrf
                    @include('dashboard.category.partials.details')
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
</div>

@stop

@section('js')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker('refresh');
    </script>
@stop
