@extends('dashboard.layouts.master')

@section('page-title', 'Editar plano')

@section('content_header')
    <h1>
        {{ $plan->name }}
        <small>editar detalhes do plano</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Planos</li>
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
                @can('Editar planos')
                    <form action="{{route('dashboard.plan.update',$plan->id)}}" method="post">
                    @csrf
                    @include('dashboard.plan.partials.details')
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
</div>

@stop

@section('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $('#price').mask('000,00', {reverse: true});
    </script>
@stop
