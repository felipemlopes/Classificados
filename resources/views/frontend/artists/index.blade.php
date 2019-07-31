@extends('frontend.layouts.master')


@section('content')
    <div class="container">
        <div class="row">
            @include('partials.messages')
            <form method="get">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-center">Artistas</h1>

                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <select name="estilo" id="estilo" class="form-control selectpicker" title="Selecione o estilo musical" data-live-search="true">
                                @foreach($styles as $style)
                                <option value="{{$style->id}}" {{app('request')->input('estilo')==$style->id? 'selected':''}}>
                                    {{$style->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <select name="estado" id="estados" class="form-control selectpicker" title="Selecione o estado" data-live-search="true">
                                @foreach($states as $state)
                                <option value="{{$state->id}}" {{app('request')->input('estado')==$state->id? 'selected':''}}>
                                    {{$state->estado}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <select name="cidade" id="cidades" class="form-control selectpicker" title="Selecione a cidade" data-live-search="true">
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
                                    @if (app('request')->input('estilo') != '' || app('request')->input('estado') != '' || app('request')->input('cidade') != '')
                                        <a href="{{ route('artist.index') }}" class="btn btn-default pull-right" type="button" >
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
                                        <a href="{{route('artist.show',$destaque->embedded->id)}}">
                                            <img class="thumbnail no-margin" src="{{asset('uploads/'.$destaque->embedded->imagepath)}}" alt="img" style="height:186px;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="add-desc-box">
                                <div class="add-details">
                                    <h5 class="add-title">
                                        <a href="{{route('artist.show',$destaque->id)}}">
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

                        @foreach($artists as $artist)
                        <div class="item-list col-md-4">
                            <div class="no-padding photobox">
                                <div class="add-image">
                                    <a href="{{route('artist.show',$artist->embedded->id)}}">
                                        <img class="thumbnail no-margin" src="{{asset('uploads/'.$artist->embedded->imagepath)}}" alt="img" style="height:186px;">
                                    </a>
                                </div>
                            </div>
                            <div class="add-desc-box">
                                <div class="add-details">
                                    <h5 class="add-title">
                                        <a href="{{route('artist.show',$artist->embedded->id)}}">
                                            {{$artist->embedded->title}}
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
                                            {{$artist->city->cidade .' - '. $artist->state->sigla}}
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
                {{ $artists->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#estados').on('changed.bs.select', function (e) {
            var selected = $('#estados option:selected').val();
            $.get('/cidades/'+selected, function (filtros) {
                $('select[id=cidades]').empty();
                $.each(filtros, function (key,value) {
                    $('select[id=cidades]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
                });
                $('#cidades').selectpicker('refresh');
            });
        });
    </script>
@endsection
