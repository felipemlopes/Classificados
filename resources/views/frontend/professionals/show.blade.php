@extends('frontend.layouts.master')


@section('content')
    <div class="container">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 page-content col-thin-right">
                <div class="inner inner-box ads-details-wrapper">
                    <h2> {{$professional->embedded->title}} </h2>
                    <span class="info-row">
                        <span class="date">
                            {{--<i class=" icon-clock"> </i>
                            $produto->Criado--}}
                        </span>
                        <span class="category">{{--$produto->categoria->nome--}} </span>
                        <span class="item-location">
                            <i class="fa fa-map-marker"></i>
                            {{$professional->city->cidade.' - '. $professional->state->sigla}}
                        </span>
                    </span>
                    <div class="text-center">
                        <!--<h1 class="pricetag"> R$ 2000 </h1>-->
                        <div  class="text-center">
                            <img src="{{asset('uploads/'.$professional->embedded->imagepath)}}" alt="img" style="max-width: 60%;">
                        </div>
                    </div>

                    <div class="Ads-Details">
                        <h5 class="list-title">
                            <strong>Descrição</strong>
                        </h5>
                        <div class="row">
                            <div class="ads-details-info col-md-8">
                                <p>
                                    {{$professional->embedded->description}}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <ul>
                                        <!--<li>
                                            <p class=" no-margin ">
                                                <strong>Preço:</strong>
                                                R${{--number_format($artist->embedded->cache, 2, ',', '')--}}
                                            </p>
                                        </li>-->
                                        <li>
                                            <p class="no-margin">
                                                <strong>Cidade:</strong>
                                                {{$professional->city->cidade.' - '.$professional->state->sigla}}
                                            </p>
                                        </li>
                                    </ul>
                                </aside>
                                <!--<div class="ads-action">
                                    <ul class="list-border">
                                        <li>
                                            <a href="#">
                                                <i class=" fa fa-user"></i>
                                                Mais anúncios deste usuário
                                            </a>
                                        </li>
                                    </ul>
                                </div>-->
                            </div>
                        </div>
                        <div class="content-footer text-left">
                            <a class="btn  btn-default">
                                <i class=" icon-mail-2"></i>
                                Envie uma menssagem
                            </a>
                            <!--<a class="btn  btn-primary">
                                <i class=" icon-phone-1"></i>
                                {{--$produto->owner->phone--}}
                            </a>-->
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-3  page-sidebar-right">
                <aside>
                    <div class="panel sidebar-panel panel-contact-seller">
                        <div class="panel-heading">Contato do anunciante</div>
                        <div class="panel-content user-info">
                            <div class="panel-body text-center">
                                <div class="seller-info">
                                    <h3 class="no-margin">{{ $professional->user->first_name.' '.$professional->user->last_name }}</h3>
                                    <p>Cidade:
                                        <strong>{{$professional->city->cidade.' - '.$professional->state->sigla}}</strong>
                                    </p>
                                    <p> Usuário desde:
                                        <strong>{{ date('d/m/Y', strtotime($professional->user->created_at)) }}</strong>
                                    </p>
                                </div>
                                <div class="user-ads-action">
                                    <a data-target="#myModal" data-toggle="modal" class="btn   btn-default btn-block">
                                        <i class=" icon-mail-2"></i>
                                        Envie uma menssagem
                                    </a>
                                    <!--<a class="btn  btn-primary btn-block">
                                        <i class=" icon-phone-1"></i>
                                        {{--$produto->owner->phone--}}
                                    </a>-->
                                </div>
                            </div>
                        </div>
                    </div>


                </aside>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
