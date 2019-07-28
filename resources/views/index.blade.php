@extends('frontend.layouts.master')


@section('intro')
    <!--<div class="intro">
        <div class="dtable hw100">
            <div class="dtable-cell hw100">
                <div class="container text-center">
                    <h1 class="intro-title animated fadeInDown"> Não deixe seu evento sem música </h1>
                    <p class="sub animateme fittext3 animated fadeIn"> Encontre o artista perfeito para o seu evento</p>

                    <form role="form" action="{{--route('frontend.search.index')--}}" method="get"  class="form-horizontal">
                        <div class="row search-row animated fadeInUp">
                            <div class="col-lg-4 col-sm-4 search-col relative locationicon">
                                <i class="icon-location-2 icon-append"></i>
                                <input name="cidade" class="form-control locinput input-rel searchtag-input has-icon" placeholder="Cidade..." type="text">
                            </div>
                            <div class="col-lg-4 col-sm-4 search-col relative"><i class="icon-docs icon-append"></i>
                                <select name="q" id="" class="form-control has-icon">
                                    <option value="">Procuro por...</option>
                                    <option value="">Artistas</option>
                                    <option value="">Profissionais</option>
                                </select>

                            </div>
                            <div class="col-lg-4 col-sm-4 search-col">
                                <button type="submit" class="btn btn-primary btn-search btn-block"><i class="icon-search"></i><strong>Procurar</strong></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>-->
@endsection


@section('content')
    <!--<div class="container">
        <div class="row">
            <div class="col-sm-9 page-content col-thin-right">
                <div class="inner-box category-content">
                    <h2 class="title-2">Encontre aqui o anúncio que você procura</h2>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 ">

                            <div class="cat-list">
                                <h3 class="cat-title">
                                    <a href="{{--route('frontend.categoria.index', ['slug_categoria'=>$automoveis[0]->slug])--}}">
                                        <i class="fa {{--$automoveis[0]->classfontawesome--}} ln-shadow"></i>
                                        {{--$automoveis[0]->nome--}}
                                        <span class="count">{{--$automoveis[0]->produtos--}}</span> </a>
                                    <span data-target=".cat-id-1" data-toggle="collapse" class="btn-cat-collapsed collapsed">
                                        <span class=" icon-down-open-big"></span>
                                    </span>
                                </h3>
                                <ul style="height: auto;" class="cat-collapse collapse in cat-id-1">

                                </ul>
                            </div>
                            <div class="cat-list">
                                <h3 class="cat-title">
                                    <a href="{{--route('frontend.categoria.index', ['slug_categoria'=>$imoveis[0]->slug])--}}">
                                        <i class="{{--$imoveis[0]->classfontawesome--}} ln-shadow"></i>
                                        {{--$imoveis[0]->nome--}}
                                        <span class="count">{{--$imoveis[0]->produtos--}}</span>
                                    </a>
                                    <span data-target=".cat-id-2" data-toggle="collapse" class="btn-cat-collapsed collapsed">
                                        <span class=" icon-down-open-big"></span>
                                    </span>
                                </h3>
                                <ul style="height: auto;" class="cat-collapse collapse in cat-id-2">

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="cat-list">
                                <h3 class="cat-title">
                                    <a href="{{--route('frontend.categoria.index', ['slug_categoria'=>$servicos[0]->slug])--}}">
                                        <i class="fa {{--$servicos[0]->classfontawesome--}} ln-shadow"></i> {{--$servicos[0]->nome--}}
                                        <span class="count">{{--$servicos[0]->produtos--}}</span>
                                    </a>
                                    <span data-target=".cat-id-4" data-toggle="collapse" class="btn-cat-collapsed collapsed"> <span class=" icon-down-open-big"></span> </span>
                                </h3>
                                <ul style="height: auto;" class="cat-collapse collapse in cat-id-4">

                                </ul>
                            </div>

                            <div class="cat-list">
                                <h3 class="cat-title">
                                    <a href="{{--route('frontend.categoria.index', ['slug_categoria'=>$pets[0]->slug])--}}">
                                        <i class="{{--$pets[0]->classfontawesome--}} ln-shadow"></i> {{--$pets[0]->nome--}}
                                        <span class="count">{{--$pets[0]->produtos--}}</span>
                                    </a>
                                    <span data-target=".cat-id-6" data-toggle="collapse" class="btn-cat-collapsed collapsed"> <span class=" icon-down-open-big"></span> </span>
                                </h3>
                                <ul style="height: auto;" class="cat-collapse collapse in cat-id-6">

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4   last-column">
                            <div class="cat-list">
                                <h3 class="cat-title">
                                    <a href="{{--route('frontend.categoria.index', ['slug_categoria'=>$paravender[0]->slug])--}}">
                                        <i class=" {{--$paravender[0]->classfontawesome--}} ln-shadow"></i> {{--$paravender[0]->nome--}}
                                        <span class="count">{{--$paravender[0]->produtos--}}</span>
                                    </a>
                                    <span data-target=".cat-id-7" data-toggle="collapse" class="btn-cat-collapsed collapsed">
                                        <span class=" icon-down-open-big"></span>
                                    </span>
                                </h3>
                                <ul style="height: auto;" class="cat-collapse collapse in cat-id-7">

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 page-sidebar col-thin-left">
                <aside>
                    <div class="inner-box no-padding">
                        <div class="inner-box-content"><a href="#"><img class="img-responsive" src="classificados/app.jpg" alt="tv"></a>
                        </div>
                    </div>
                    <div class="inner-box">
                        <h2 class="title-2">Categorias Populares</h2>
                        <div class="inner-box-content">
                            <ul class="cat-list arrow">

                            </ul>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>-->
@endsection


@section('footer-pageinfo')
    <!--<div class="page-info">
        <div class="page-bottom-info-inner">
            <div class="container text-center section-promo">
                <div class="row ">
                    <div class=" col-sm-6 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-group"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{--1--}}</span></h5>
                                    <div class="iconbox-wrap-text">Usuários</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-th-large-1"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>{{--1--}}</span></h5>
                                    <div class="iconbox-wrap-text">Anúncios</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->


@endsection
