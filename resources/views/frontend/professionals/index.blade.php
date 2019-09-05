@extends('frontend.layouts.masterteste')

@section('titulo-interno')
    <div class="bg-titulo-interno">
        <h1 class="text-center titulo-interno">Profissionais</h1>
    </div>
@endsection

@section('content')
    <div class="container">
        @include('partials.messages')
        <form method="get">
            <div class="">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-filtros">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3-profissionais filtro">
                        <select name="categoria" id="categoria" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione a categoria</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{app('request')->input('categoria')==$category->id? 'selected':''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3-profissionais filtro">
                        <select name="subcategoria" id="subcategoria" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione a subcategoria</option>
                            @if($subcategories)
                                @foreach($subcategories as $subcategory)
                                    <option value="{{$subcategory->id}}" {{app('request')->input('subcategoria')==$subcategory->id? 'selected':''}}>
                                        {{$subcategory->name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3-profissionais filtro">
                        <select name="estado" id="estado" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione o estado</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{app('request')->input('estado')==$state->id? 'selected':''}}>
                                    {{$state->estado}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3-profissionais filtro">
                        <select name="cidade" id="cidade" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione a cidade</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" {{app('request')->input('cidade')==$city->id? 'selected':''}}>
                                    {{$city->cidade}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-push-0 col-md-push-9 col-sm-push-0 col-xs-12 col-sm-12 col-md-3 col-lg-3-profissionais filtro">
                        <div class="input-group ">
                        <span class="input-group-btn btn-block">
                            @if (app('request')->input('categoria') != '' || app('request')->input('subcategoria') != '' || app('request')->input('estado') != '' || app('request')->input('cidade') != '')
                                <button class="btn btn-primary pull-right btn-block" style="width: 50%;">Enviar</button>
                                <a href="{{ route('professional.index') }}" class="btn btn-default pull-right btn-block" type="button" style="width: 50%; bottom: 5px;">
                                    <span class="fa fa-remove"></span> Limpar
                                </a>
                            @else
                                <button class="btn btn-primary pull-right btn-block">Buscar</button>
                            @endif
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="category-list">
                    @if(count($destaques) or count($professionals))
                    <div class="adds-wrapper col-md-12">
                        @foreach($destaques as $destaque)
                            <div class="item-list col-xs-12 col-sm-4 col-md-3 anuncio">
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
                                            <p class="category">
                                                <i class="fa fa-tag"></i>
                                                {{ $destaque->embedded->category->name }}
                                            </p>
                                            <p class="item-location">
                                                <i class="fa fa-map-marker"></i>
                                                {{$destaque->city->cidade .' - '. $professional->state->sigla}}
                                            </p>
                                        </span>
                                    </div>
                                </div>
                            <!--<div class="col-sm-3 text-right  price-box">
                                <h2 class="item-price"> R${{--number_format($dest->preco, 2, ',', '')--}} </h2>
                            </div>-->
                            </div>
                        @endforeach

                        @foreach($professionals as $professional)
                            <div class="item-list col-xs-12 col-sm-4 col-md-3 anuncio">
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
                                            <p class="category">
                                                <i class="fa fa-tag"></i>
                                                {{ $professional->embedded->category->name }}
                                            </p>
                                            <p class="item-location">
                                                <i class="fa fa-map-marker"></i>
                                                {{$professional->city->cidade .' - '. $professional->state->sigla}}
                                            </p>
                                        </span>
                                    </div>
                                </div>
                            <!--<div class="text-right  price-box">
                                <h2 class="item-price">Cachê R$ 2000,00{{--number_format($produto->preco, 2, ',', '')--}} </h2>
                            </div>-->
                            </div>
                        @endforeach

                    </div>
                    @endif
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
        jQuery('#estado').on('changed.bs.select', function (e) {
            var selected = jQuery('#estado option:selected').val();
            jQuery.get('/cidades/'+selected, function (filtros) {
                jQuery('select[id=cidade]').empty();
                jQuery('select[id=cidade]').append('<option value=>Selecione a cidade</option>');
                jQuery.each(filtros, function (key,value) {
                    jQuery('select[id=cidade]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
                });
                jQuery('#cidade').selectpicker('refresh');
            });
        });
        jQuery('#categoria').on('changed.bs.select', function (e) {
            var selected = jQuery('#categoria option:selected').val();
            jQuery.get('/categoria/'+selected, function (filtros) {
                jQuery('select[id=subcategoria]').empty();
                jQuery('select[id=subcategoria]').append('<option value=>Selecione a subcategoria</option>');
                jQuery.each(filtros, function (key,value) {
                    jQuery('select[id=subcategoria]').append('<option value=' + value.id + '>' + value.name + '</option>');
                });
                jQuery('#subcategoria').selectpicker('refresh');
            });
        });
    </script>
@endsection
