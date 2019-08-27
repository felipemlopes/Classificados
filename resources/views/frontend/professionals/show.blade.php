@extends('frontend.layouts.masterteste')

@section('css')
    <link href="{{ asset('vendor/starrr/starrr.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
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
                        <div  class="text-center">
                            <img src="{{asset('uploads/'.$professional->embedded->imagepath)}}" alt="img" style="max-width: 60%;">
                        </div>
                    </div>
                    <div class="Ads-Details secao">
                        <div class="row">
                            <h5 class="list-title">
                                <strong>Descrição</strong>
                            </h5>
                        </div>
                        <div class="row">
                            <div class="ads-details-info col-sm-8 col-md-8">
                                <p>
                                    {{$professional->embedded->description}}
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
                                    @if($professional->embedded->hasSocialNetworks())
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Redes sociais:</strong>
                                        </li>
                                        @if($professional->embedded->facebook)
                                        <li>
                                            <a class="linksocialnetowrk" href="{{$professional->embedded->facebook}}" target="_blank">
                                                <i class="fa fa-lg fa-facebook"></i>
                                            </a>
                                        </li>
                                        @endif
                                        @if($professional->embedded->instagram)
                                        <li>
                                            <a class="linksocialnetowrk" href="{{$professional->embedded->instagram}}" target="_blank">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                        @endif
                                        @if($professional->embedded->youtube)
                                        <li>
                                            <a class="linksocialnetowrk" href="{{$professional->embedded->youtube}}" target="_blank">
                                                <i class="fa fa-youtube-square"></i>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                    @endif
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3  page-sidebar-right">
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
                                    <a href="{{route('message.create',$professional->id)}}" class="btn btn-default btn-block">
                                        <i class=" icon-mail-2"></i>
                                        Envie uma menssagem
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 reviews">
                <h3>Avaliações</h3>
                <p> {{$professional->countRating()}} avaliações <span class="rating">{!! $professional->getRating() !!}</span></p>

                @foreach($professional->ratings as $review)
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
        jQuery('.starrr').starrr({
            rating: 1
        });
        jQuery('.starrr').on('starrr:change', function(e, value){
            jQuery('#rating_input').val(value)
        });
    </script>
@endsection
