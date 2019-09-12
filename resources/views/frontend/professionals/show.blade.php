@extends('frontend.layouts.masterteste')

@section('css')
    <link href="{{ asset('vendor/starrr/starrr.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="container secao">
                <a href="{{ url()->previous() }}" class="btn btn-primary voltar">Voltar</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 secao">
                <div class="inner inner-box ads-details-wrapper secao">
                    <h2> {{$professional->embedded->title}} </h2>
                    <span class="info-row">
                        <span class="item-location">
                            <i class="fa fa-map-marker"></i>
                            {{$professional->city->cidade.' - '. $professional->state->sigla}}
                        </span>
                    </span>
                    <div class="text-center">
                        <!--<h1 class="pricetag"> R$ 2000 </h1>-->
                        {{--<div  class="text-center">
                            <img src="{{asset('uploads/'.$professional->embedded->imagepath)}}" class="img-anuncio">
                        </div>--}}
                        <div id="carousel" class="carousel slide" >
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                @if($professional->embedded->imagepath2)
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                @endif
                                @if($professional->embedded->imagepath3)
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                @endif
                                @if($professional->embedded->imagepath4)
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                                @endif
                                @if($professional->embedded->imagepath5)
                                <li data-target="#myCarousel" data-slide-to="4"></li>
                                @endif
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="{{asset('uploads/'.$professional->embedded->imagepath)}}" class="img-anuncio">
                                </div>
                                @if($professional->embedded->imagepath2)
                                <div class="item">
                                    <img src="{{asset('uploads/'.$professional->embedded->imagepath2)}}" class="img-anuncio">
                                </div>
                                @endif
                                @if($professional->embedded->imagepath3)
                                <div class="item">
                                    <img src="{{asset('uploads/'.$professional->embedded->imagepath3)}}" class="img-anuncio">
                                </div>
                                @endif
                                @if($professional->embedded->imagepath4)
                                <div class="item">
                                    <img src="{{asset('uploads/'.$professional->embedded->imagepath4)}}" class="img-anuncio">
                                </div>
                                @endif
                                @if($professional->embedded->imagepath5)
                                <div class="item">
                                    <img src="{{asset('uploads/'.$professional->embedded->imagepath5)}}" class="img-anuncio">
                                </div>
                                @endif
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#carousel" data-slide="prev">
                                <span class="fa fa-chevron-left" style="position: relative; top:50%;"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel" data-slide="next">
                                <span class="fa fa-chevron-right" style="position: relative; top:50%;"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="Ads-Details secao">
                        <div class="">
                            <h5 class="list-title">
                                <strong>Descrição</strong>
                            </h5>
                        </div>
                        <div class="row">
                            <div class="ads-details-info col-sm-8 col-md-8">
                                <p>
                                    {!! $professional->embedded->description !!}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <ul>
                                        <li>
                                            <p class="no-margin">
                                                <strong>Cidade:</strong>
                                                {{$professional->city->cidade.' - '.$professional->state->sigla}}
                                            </p>
                                        </li>
                                    </ul>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3  page-sidebar-right">
                <aside>
                    <div class="panel sidebar-panel panel-contact-seller">
                        <div class="panel-heading panel-primary">Contato do anunciante</div>
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
                                    {{--<a href="{{route('message.create',$professional->id)}}" class="btn btn-default btn-block">
                                        <i class=" icon-mail-2"></i>
                                        Envie uma menssagem
                                    </a>--}}
                                    @if(Auth::Check())
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalmessage">
                                            <i class=" icon-mail-2"></i>
                                            Envie uma menssagem
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary btn-block" disabled>
                                            <i class=" icon-mail-2"></i>
                                            Envie uma menssagem
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                @if($professional->embedded->hasSocialNetworks())
                    <ul class="list-inline text-center socialnetworks">
                        @if($professional->embedded->facebook)
                            <li>
                                <a class="facebook" href="{{$professional->embedded->facebook}}" target="_blank">
                                    <i class="fa fa-lg fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if($professional->embedded->instagram)
                            <li>
                                <a class="instagram" href="{{$professional->embedded->instagram}}" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if($professional->embedded->youtube)
                            <li>
                                <a class="youtube" href="{{$professional->embedded->youtube}}" target="_blank">
                                    <i class="fa fa-youtube-square"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="inner inner-box ads-details-wrapper secao">
                    <h3>Avalie este artista</h3>
                    @include('partials.messages')
                    @if(Auth::Check())
                        <form action="{{route('review.professional.store',$professional->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Título</label>
                                <input type="text" class="form-control" id="title"
                                       name="title" placeholder="Título da avaliação" value="">
                            </div>
                            <div class='starrr'></div>
                            <div class="form-group">
                                <label for="name">Sua opnião</label>
                                <textarea type="text" class="form-control" id="body"
                                          name="body" placeholder="" value=""></textarea>
                            </div>
                            <input type="hidden" name="rating" value="0" id="rating_input">
                            <button type="submit" class="btn btn-primary">Avaliar</button>
                        </form>
                    @else
                        <p>Faça <a href="{{route('login')}}">Login</a> para avaliar</p>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 reviews">
                <div class="inner inner-box ads-details-wrapper secao">
                    <h3>Avaliações</h3>
                    <p> {{$professional->countRating()}} avaliações <span class="rating">{!! $professional->getRating() !!}</span></p>

                    @foreach($professional->ratings as $review)
                        <div class="" style="background-color: #cfcfcf; margin-bottom: 15px; position: relative; padding: 10px;">
                            <h4>{{$review->title}}</h4>
                            <p class="review-text">{{$review->body}}</p>
                            <small class="review-date">{{ date('d/m/Y', strtotime($review->created_at)) }} Por {{$review->author->first_name.' '.$review->author->last_name}}</small>
                            @hasanyrole('Administrador|Gerente|Proprietário')
                            <div>
                                <a href="{{route('review.delete',$review->id)}}" class="btn btn-secondary">Excluir</a>
                            </div>
                            @endhasanyrole
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div id="modalmessage" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Fechar</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="icon-mail-2"></i>
                        Envie uma mensagem ao anunciante
                    </h4>
                </div>
                <form role="form" method="POST" action="{{route('message.send',$professional->id)}}" id="formmessage">
                    @csrf
                    <div class="modal-body">
                        {{--@if(Auth::Check())
                            <input type="hidden" name="from_name" value="Felipe">
                            <input type="hidden" name="from_email" value="felipemarcanthlopes@gmail.com">
                        @else
                            <div class="form-group required ">
                                <label for="from_name" class="control-label">
                                    Nome <sup>*</sup>
                                </label>
                                <input id="from_name" name="from_name" class="form-control" placeholder="Seu nome" type="text" value="">
                            </div>
                            <div class="form-group required ">
                                <label for="from_email" class="control-label">
                                    E-mail <sup>*</sup>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon-mail"></i>
                                    </span>
                                    <input id="from_email" name="from_email" type="text" placeholder="i.e. you@gmail.com" class="form-control" value="">
                                </div>
                            </div>
                        @endif--}}
                        {{--<div class="form-group required ">
                            <label for="phone" class="control-label">Numero de telefone </label>
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-phone-1"></i>
                                        </span>
                                <input id="phone" name="phone" type="text" placeholder="Numero de telefone" maxlength="60" class="form-control" value="">
                            </div>
                        </div>--}}
                        <div class="form-group required ">
                            <label for="message" class="control-label">Mensagem
                            </label>
                            <textarea id="message" name="message" class="form-control required" placeholder="Sua mensagem..." rows="5"></textarea>
                        </div>
                        <input type="hidden" id="advertisement_id" value="{{$professional->id}}">
                    </div>
                </form>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary pull-right" id="sendmessage">Enviar mensagem</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/starrr/starrr.js') }}"></script>
    <script>
        jQuery('.starrr').starrr({
            rating: 1
        });
        jQuery('.starrr').on('starrr:change', function(e, value){
            jQuery('#rating_input').val(value)
        });
        jQuery("#formmessage").submit(function(e){
            e.preventDefault();
        });
        jQuery('#sendmessage').on('click', function (e) {


            var advertisement = jQuery('#advertisement_id').val();
            var message = jQuery('#message').val();
            var csrftoken = jQuery('input[name=_token]').val();

            axios.post(`/mensagens/${advertisement}/send`, {
                _token: csrftoken,
                message: message,
            })
                .then(response => {
                    jQuery('#message').val('');
                    jQuery('#modalmessage').modal('hide');
                })
                .catch(error => {
                });
        });
    </script>
@endsection
