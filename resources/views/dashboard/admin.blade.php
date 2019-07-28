@extends('dashboard.layouts.master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
@stop

@section('page-title', 'Dashboard')

@section('body_class', 'skin-'. config('adminlte.skin', 'blue') .' sidebar-mini')

@section('content_header')
    <h1>
        {{ Auth::User()->name }}
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$users->count()}}</h3>
                <p>Total de usuários</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            @can('Visualizar usuários')
            <a href="{{ route('dashboard.user.list') }}" class="small-box-footer">
                Ver todos usuários <i class="fa fa-arrow-circle-right"></i>
            </a>
            @endcan
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$advertisements->count()}}</h3>
                <p>Total de Anúncios</p>
            </div>
            <div class="icon">
                <i class="fa fa-link"></i>
            </div>
            <a href="{{ route('dashboard.advertisement.list') }}" class="small-box-footer">
                Ver todos anúncios <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Histórico de anúncios</h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="myChart" style="height:281px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="{{ asset('vendor/adminlte/plugins/Chart.min.js') }}"></script>
    <script>

        var areaChartCanvas = $('#myChart').get(0).getContext('2d')
        // This will get the first returned node in the jQuery collection.
        var areaChart       = new Chart(areaChartCanvas)

        var areaChartData = {
            labels  : [{!! $months !!}],
            datasets: [
                {
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [{!! $resultarraystring !!}]
                }
            ]
        };
        //Create the line chart
        areaChart.Line(areaChartData);
    </script>
@stop


@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>
@stop
