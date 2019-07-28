@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
@endsection

@section('page-title', 'Editar anúncio')

@section('content_header')
    <h1>
        {{-- $advertisement->name --}}
        <small>editar detalhes do anúncio</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Anúncios</li>
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
        <li role="presentation">
            <a href="#imagem" aria-controls="imagem" role="tab" data-toggle="tab">
                Imagem
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="details">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    @can('Editar anúncios')
                        <form action="{{route('dashboard.advertisement.update',$advertisement->id)}}" method="post">
                        @csrf
                            @include('dashboard.advertisement.partials.details')
                        </form>
                    @endcan
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane active" id="imagem">
            <div class="col-lg-4 col-md-5">
                <form action="{{route('dashboard.advertisement.updateimage',$advertisement->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div style="padding-bottom:10px;">
                        <label class="btn btn-primary" for="my-file-selector">
                            <input name="foto" id="my-file-selector" type="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
                            Procurar foto
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                    </div>
                    @if ($edit)
                        <div>
                            <button type="submit" class="btn btn-primary" id="update-details-btn">
                                <i class="fa fa-refresh"></i>
                                Atualizar imagem
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $('#cache').mask('000.000.000.000.000,00', {reverse: true});
        $('#estado').on('change', function (e) {
            var selected = $('#estado option:selected').val();
            $.get('/cidades/'+selected, function (filtros) {
                $('select[id=cidade]').empty();
                $('select[id=cidade]').append('<option value=>Selecione</option>');
                $.each(filtros, function (key,value) {
                    $('select[id=cidade]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
                });
            });
        });

        $('#categoria').on('change', function (e) {
            var selected = $('#categoria option:selected').val();
            $.get('/categoria/'+selected, function (filtros) {
                $('select[id=subcategoria]').empty();
                $('select[id=subcategoria]').append('<option value=>Selecione</option>');
                $.each(filtros, function (key,value) {
                    $('select[id=subcategoria]').append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
        });
    </script>
@stop
