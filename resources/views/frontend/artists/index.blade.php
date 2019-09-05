@extends('frontend.layouts.masterteste')

@section('titulo-interno')
    <div class="bg-titulo-interno">
        <h1 class="text-center titulo-interno">Artistas</h1>
    </div>
@endsection

@section('content')
    <div class="container">
        @include('partials.messages')
        <form method="get">
            <div class="">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-filtros">
                    <div class="col-xs-12 col-sm-4 col-md-4-artistas col-lg-4-artistas filtro">
                        <select name="estilo" id="estilo" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione o estilo</option>
                            @foreach($styles as $style)
                                <option value="{{$style->id}}" {{app('request')->input('estilo')==$style->id? 'selected':''}}>
                                    {{$style->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4-artistas col-lg-4-artistas filtro">
                        <select name="estado" id="estado" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione o estado</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{app('request')->input('estado')==$state->id? 'selected':''}}>
                                    {{$state->estado}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4-artistas col-lg-4-artistas filtro">
                        <select name="cidade" id="cidade" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione a cidade</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" {{app('request')->input('cidade')==$city->id? 'selected':''}}>
                                    {{$city->cidade}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-push-0 col-md-push-0 col-sm-push-8 col-xs-12 col-sm-4-artistas col-md-4-artistas col-lg-4-artistas filtro">
                        <div class="input-group ">
                        <span class="input-group-btn btn-block">
                            @if (app('request')->input('estilo') != '' || app('request')->input('estado') != '' || app('request')->input('cidade') != '')
                                <button class="btn btn-primary pull-right btn-block" style="width: 50%;">Enviar</button>
                                <a href="{{ route('artist.index') }}" class="btn btn-default pull-right btn-block" type="button" style="width: 50%; bottom: 5px;">
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
                    @if(count($destaques) or count($artists))
                    <div class="adds-wrapper col-md-12">
                        @foreach($destaques as $destaque)
                        <div class="item-list col-xs-12 col-sm-4 col-md-3 anuncio">
                            <div>
                                <div class="cornerRibbons topAds">
                                    <a> em destaque</a>
                                </div>
                                <div class="no-padding photobox">
                                    <div class="add-image">
                                        <a href="{{route('artist.show',$destaque->ads_id)}}">
                                            <img class="thumbnail no-margin" src="{{asset('uploads/'.$destaque->embedded->imagepath)}}" alt="img" style="height:186px;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="add-desc-box">
                                <div class="add-details">
                                    <h5 class="add-title">
                                        <a href="{{route('artist.show',$destaque->ads_id)}}">
                                            {{$destaque->embedded->title}}
                                        </a>
                                    </h5>
                                    <span class="info-row">
                                        <p class="category">
                                            <i class="fa fa-music"></i>
                                            {{ $destaque->embedded->musicalstyles->first()->name }}
                                        </p>
                                        <p class="item-location">
                                            <i class="fa fa-map-marker"></i>
                                            {{$destaque->city->cidade .' - '. $destaque->state->sigla}}
                                        </p>
                                    </span>
                                </div>
                            </div>
                            <!--<div class="col-sm-3 text-right  price-box">
                                <h2 class="item-price"> R${{--number_format($dest->preco, 2, ',', '')--}} </h2>
                            </div>-->
                        </div>
                        @endforeach
                        @foreach($artists as $artist)
                            <div class="item-list col-xs-12 col-sm-4 col-md-3 anuncio">
                                <div class="no-padding photobox">
                                    <div class="add-image">
                                        <a href="{{route('artist.show',$artist->ads_id)}}">
                                            <img class="thumbnail no-margin" src="{{asset('uploads/'.$artist->embedded->imagepath)}}" alt="img" style="height:186px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title">
                                            <a href="{{route('artist.show',$artist->ads_id)}}">
                                                {{$artist->embedded->title}}
                                            </a>
                                        </h5>
                                        <span class="info-row">
                                    <p class="category">
                                        <i class="fa fa-music"></i>
                                        {{ $artist->embedded->musicalstyles->first()->name }}
                                    </p>
                                    <p class="item-location">
                                        <i class="fa fa-map-marker"></i>
                                        {{$artist->city->cidade .' - '. $artist->state->sigla}}
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
                {{ $artists->links() }}
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
    </script>
@endsection
