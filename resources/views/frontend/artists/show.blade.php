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
                    <h2> {{$artist->embedded->title}} </h2>
                    <span class="info-row">
                        <span class="item-location">
                            <i class="fa fa-map-marker"></i>
                            {{$artist->city->cidade.' - '. $artist->state->sigla}}
                        </span>
                    </span>
                    <div class="hidden-lg hidden-md hidden-sm text-center secao">
                        <iframe
                                src="https://www.youtube.com/embed/{{$videoyoutube}}"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                    <div class="hidden-lg hidden-xs text-center secao">
                        <iframe width="100%"
                                height="350px"
                                src="https://www.youtube.com/embed/{{$videoyoutube}}"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                    <div class="hidden-md hidden-xs hidden-sm text-center secao">
                        <iframe width="100%"
                                height="450px"
                                src="https://www.youtube.com/embed/{{$videoyoutube}}"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
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
                                    {!! $artist->embedded->description !!}
                                </p>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <ul>
                                        <li>
                                            <p class="">
                                                <strong>Cachê:</strong>
                                                R${{number_format($artist->embedded->cache, 2, ',', '')}}
                                            </p>
                                        </li>
                                        <li>
                                            <p class="">
                                                <strong>Cidade:</strong>
                                                {{$artist->city->cidade.' - '.$artist->state->sigla}}
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
                        @if(count($artist->embedded->musicalstyles))
                        <h5>
                            <strong>Estilos musicais</strong>
                        </h5>
                        <ul class="list-circle">
                            @foreach($artist->embedded->musicalstyles as $style)
                                <li>
                                    <strong>{{$style->name}}</strong>
                                </li>
                            @endforeach
                        </ul>
                        @endif
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
                                    <h3 class="no-margin">{{ $artist->user->first_name.' '.$artist->user->last_name }}</h3>
                                    <p>Cidade:
                                        <strong>{{$artist->city->cidade.' - '.$artist->state->sigla}}</strong>
                                    </p>
                                    <p> Usuário desde:
                                        <strong>{{ date('d/m/Y', strtotime($artist->user->created_at)) }}</strong>
                                    </p>
                                </div>
                                <div class="user-ads-action">
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
                                        <p style="margin-top: 5px;">Faça <a href="{{route('login')}}">Login</a> para enviar mensagens</p>
                                    @endif

                                    {{--<a href="{{route('message.create',$artist->id)}}" class="btn btn-default btn-block">
                                        <i class=" icon-mail-2"></i>
                                        Envie uma menssagem
                                    </a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                @if($artist->embedded->hasSocialNetworks())
                    <ul class="list-inline text-center socialnetworks">
                        @if($artist->embedded->facebook)
                            <li>
                                <a class="facebook" href="{{$artist->embedded->facebook}}" target="_blank">
                                    <i class="fa fa-lg fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if($artist->embedded->instagram)
                            <li>
                                <a class="instagram" href="{{$artist->embedded->instagram}}" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if($artist->embedded->youtube)
                            <li>
                                <a class="youtube" href="{{$artist->embedded->youtube}}" target="_blank">
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
                        <form action="{{route('review.artist.store',$artist->id)}}" method="post">
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
                            <input type="hidden" name="rating" value="1" id="rating_input">
                            <button type="submit" class="btn btn-primary">Avaliar</button>
                        </form>
                    @else
                        <p>Faça <a href="{{route('login')}}">Login</a> para avaliar</p>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="inner inner-box  ads-details-wrapper secao reviews">
                    <h3>Avaliações</h3>
                    <p> {{$artist->countRating()}} avaliações <span class="rating">{!! $artist->getRating() !!}</span></p>

                    @foreach($artist->ratings as $review)
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
                <form role="form" method="POST" action="{{route('message.send',$artist->id)}}" id="formmessage">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group required ">
                            <label for="message" class="control-label">Mensagem
                            </label>
                            <textarea id="message" name="message" class="form-control required" placeholder="Sua mensagem..." rows="5"></textarea>
                        </div>
                        <input type="hidden" id="advertisement_id" value="{{$artist->id}}">
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
