@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
@endsection

@section('page-title', 'Editar permissão')

@section('content_header')
    <h1>
        {{ $permission->name }}
        <small>editar detalhes da permissão</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Permissões</li>
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
                @can('Editar permissões')
                    <form action="{{route('dashboard.permission.update',$permission->id)}}" method="post">
                    @csrf
                    @include('dashboard.permission.partials.details')
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
</div>

@stop

@section('js')
@stop
