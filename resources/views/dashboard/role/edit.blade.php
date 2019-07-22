@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
@endsection

@section('page-title', 'Editar papel')

@section('content_header')
    <h1>
        {{ $role->name }}
        <small>editar detalhes do papel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Papéis</li>
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
            <div class="col-lg-12 col-md-12">
                @can('Editar papéis')
                    <form action="{{route('dashboard.role.update',$role->id)}}" method="post">
                    @csrf
                    @include('dashboard.role.partials.details')
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
</div>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
@stop
