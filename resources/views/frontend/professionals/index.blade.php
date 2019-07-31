@extends('frontend.layouts.master')


@section('content')
    <div class="container">
        <div class="row">
            @include('partials.messages')
            <form method="get">
                <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">Profissionais</h1>

                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <select name="categoria" id="categoria" class="form-control selectpicker" title="Selecione a categoria" data-live-search="true">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{app('request')->input('categoria')==$category->id? 'selected':''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <select name="subcategoria" id="subcategoria" class="form-control selectpicker" title="Selecione a sub-categoria" data-live-search="true">
                            @foreach($subcategories as $subcategory)
                                <option value="{{$subcategory->id}}" {{app('request')->input('subcategoria')==$subcategory->id? 'selected':''}}>
                                    {{$subcategory->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <select name="estado" id="estado" class="form-control selectpicker" title="Selecione o estado" data-live-search="true">
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{app('request')->input('estado')==$state->id? 'selected':''}}>
                                    {{$state->estado}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <select name="cidade" id="cidade" class="form-control selectpicker" title="Selecione a cidade" data-live-search="true">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" {{app('request')->input('cidade')==$city->id? 'selected':''}}>
                                    {{$city->cidade}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="input-group custom-search-form">
                            <span class="input-group-btn">
                                <button class="btn btn-primary pull-right">Enviar</button>
                                @if (app('request')->input('categoria') != '' || app('request')->input('subcategoria') != '' || app('request')->input('estado') != '' || app('request')->input('cidade') != '')
                                    <a href="{{ route('professional.index') }}" class="btn btn-default pull-right" type="button" >
                                        <span class="fa fa-remove"></span> Limpar
                                    </a>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-content col-thin-left">
                <div class="category-list">
                    <div class="tab-box ">
                    </div>
                    <div class="listing-filter">
                    </div>
                    <div class="col-lg-12">
                    </div>
                    <div class="">
                    </div>
                    <div class="adds-wrapper col-md-12">

                        @foreach($destaques as $destaque)
                            <div class="item-list col-md-4">
                                <div>
                                    <div class="cornerRibbons topAds">
                                        <a> em destaque</a>
                                    </div>
                                    <div class="no-padding photobox">
                                        <div class="add-image">
                                            <a href="{{route('professional.show',$destaque->id)}}">
                                                <img class="thumbnail no-margin" src="{{asset('uploads/'.$destaque->embedded->imagepath)}}" alt="img" style="height:186px;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title">
                                            <a href="{{route('professional.show',$destaque->id)}}">
                                                {{$destaque->embedded->title}}
                                            </a>
                                        </h5>
                                        <span class="info-row">
                                        <span class="date">
                                        </span>
                                        <span class="category">{{--$dest->categoria->nome--}} </span>
                                        <span class="item-location">
                                            <i class="fa fa-map-marker"></i>
                                            {{$destaque->city->cidade .' - '. $destaque->state->sigla}}
                                        </span>
                                    </span>
                                    </div>
                                </div>
                            <!--<div class="col-sm-3 text-right  price-box">
                                <h2 class="item-price"> R${{--number_format($dest->preco, 2, ',', '')--}} </h2>
                            </div>-->
                            </div>
                        @endforeach

                        @foreach($professionals as $professional)
                            <div class="item-list col-md-4">
                                <div class="no-padding photobox">
                                    <div class="add-image">
                                        <a href="{{route('professional.show',$professional->id)}}">
                                            <img class="thumbnail no-margin" src="{{asset('uploads/'.$professional->embedded->imagepath)}}" alt="img" style="height:186px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title">
                                            <a href="{{route('professional.show',$professional->id)}}">
                                                {{$professional->embedded->title}}
                                            </a>
                                        </h5>
                                        <span class="info-row">
                                        <span class="date">
                                        </span>
                                        <span class="category">
                                            {{--$produto->categoria->nome--}}
                                        </span>
                                        <span class="item-location">
                                            <i class="fa fa-map-marker"></i>
                                            {{$professional->city->cidade .' - '. $professional->state->sigla}}
                                        </span>
                                    </span>
                                    </div>
                                </div>
                            <!--<div class="text-right  price-box">
                                <h2 class="item-price">Cachê R$ 2000,00{{--number_format($produto->preco, 2, ',', '')--}} </h2>
                            </div>-->
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="text-center">
                {{ $professionals->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#estado').on('changed.bs.select', function (e) {
            var selected = $('#estado option:selected').val();
            $.get('/cidades/'+selected, function (filtros) {
                $('select[id=cidade]').empty();
                $.each(filtros, function (key,value) {
                    $('select[id=cidade]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
                });
                $('#cidade').selectpicker('refresh');
            });
        });
        $('#categoria').on('changed.bs.select', function (e) {
            var selected = $('#categoria option:selected').val();
            $.get('/categoria/'+selected, function (filtros) {
                $('select[id=subcategoria]').empty();
                $.each(filtros, function (key,value) {
                    $('select[id=subcategoria]').append('<option value=' + value.id + '>' + value.name + '</option>');
                });
                $('#subcategoria').selectpicker('refresh');
            });
        });
    </script>
@endsection
