@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('page-title', 'Editar avaliação')

@section('content_header')
    <h1>
        {{ $review->title }}
        <small>editar detalhes da avaliação</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Avaliações</li>
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
                @can('Editar reviews')
                    <form action="{{route('dashboard.review.update',$review->id)}}" method="post">
                    @csrf
                    @include('dashboard.review.partials.details')
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
@stop
