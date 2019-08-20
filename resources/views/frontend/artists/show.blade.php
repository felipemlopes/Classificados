@extends('frontend.layouts.master')

@section('css')
    <link href="{{ asset('vendor/starrr/starrr.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 page-content col-thin-right">
                <div class="inner inner-box ads-details-wrapper">
                    <h2> {{$artist->embedded->title}} </h2>
                    <span class="info-row">
                        <span class="date">
                            {{--<i class=" icon-clock"> </i>
                            $produto->Criado--}}
                        </span>
                        <span class="category">{{--$produto->categoria->nome--}} </span>
                        <span class="item-location">
                            <i class="fa fa-map-marker"></i>
                            {{$artist->city->cidade.' - '. $artist->state->sigla}}
                        </span>
                    </span>
                    <div class="text-center">
                        <!--<h1 class="pricetag"> R$ 2000 </h1>-->
                        <div  class="text-center">
                            <img src="{{asset('uploads/'.$artist->embedded->imagepath)}}" alt="img" style="max-width: 60%;">
                        </div>
                    </div>

                    <div class="Ads-Details">
                        <h5 class="list-title">
                            <strong>Descrição</strong>
                        </h5>
                        <div class="row">
                            <div class="ads-details-info col-md-8">
                                <p>
                                    {{$artist->embedded->description}}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <ul>
                                        <li>
                                            <p class=" no-margin ">
                                                <strong>Cachê:</strong>
                                                R${{number_format($artist->embedded->cache, 2, ',', '')}}
                                            </p>
                                        </li>
                                        <li>
                                            <p class="no-margin">
                                                <strong>Cidade:</strong>
                                                {{$artist->city->cidade.' - '.$artist->state->sigla}}
                                            </p>
                                        </li>
                                    </ul>
                                    @if($artist->embedded->hasSocialNetworks())
                                        <ul class="list-inline">
                                            <li>
                                                <strong>Redes sociais:</strong>
                                            </li>
                                            @if($artist->embedded->facebook)
                                                <li>
                                                    <a class="linksocialnetowrk" href="{{$artist->embedded->facebook}}" target="_blank">
                                                        <i class="fa fa-lg fa-facebook"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if($artist->embedded->instagram)
                                                <li>
                                                    <a class="linksocialnetowrk" href="{{$artist->embedded->instagram}}" target="_blank">
                                                        <i class="fa fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if($artist->embedded->youtube)
                                                <li>
                                                    <a class="linksocialnetowrk" href="{{$artist->embedded->youtube}}" target="_blank">
                                                        <i class="fa fa-youtube-square"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
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
                        <h5 class="list-title">
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
                        <h5 class="list-title">
                            <strong>Vídeo</strong>
                            <div class="text-center">
                                <iframe width="100%"
                                        height="350px"
                                        src="https://www.youtube.com/embed/{{$videoyoutube}}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                            </div>

                        </h5>
                        <div class="content-footer text-left">
                            @if(Auth::Check())
                                @if($artist->user_id!=Auth::User()->id)
                                    <a href="{{route('message.create',$artist->id)}}" class="btn  btn-default">
                                        <i class=" icon-mail-2"></i>
                                        Envie uma menssagem
                                    </a>
                                @endif
                            @endif
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
                                        @if($artist->user_id!=Auth::User()->id)
                                        <a href="{{route('message.create',$artist->id)}}" class="btn btn-default btn-block">
                                            <i class=" icon-mail-2"></i>
                                            Envie uma menssagem
                                        </a>
                                        @endif
                                    @endif
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

            <div class="col-sm-12 col-md-9">
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

            <div class="col-sm-12 reviews">
                <h3>Avaliações</h3>
                <p> {{$artist->countRating()}} avaliações <span class="rating">{!! $artist->getRating() !!}</span></p>

                @foreach($artist->ratings as $review)
                <div class="col-md-9" style="background-color: #cfcfcf; margin-bottom: 15px;">
                    <h4>{{$review->title}}</h4>
                    <div class="">
                    </div>
                    <p class="review-text">{{$review->body}}</p>
                    <small class="review-date">{{ date('d/m/Y', strtotime($review->created_at)) }} Por {{$review->author->first_name.' '.$review->author->last_name}}</small>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/starrr/starrr.js') }}"></script>
    <script>
        $('.starrr').starrr({
            rating: 1
        });
        $('.starrr').on('starrr:change', function(e, value){
            $('#rating_input').val(value)
        });
    </script>
@endsection
