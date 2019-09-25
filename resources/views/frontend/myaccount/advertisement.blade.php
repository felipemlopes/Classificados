@extends('frontend.layouts.masterteste')


@section('css')
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box box-minhaconta">
                <div class="col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                    <ul class="list-inline text-center">
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.index') }}" class="link-myaccount">
                                <i class="fa fa-home"></i> Minha conta</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('message.index') }}" class="link-myaccount">
                                <i class="fa fa-envelope"></i> Mensagens</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.advertisement') }}" class="link-myaccount active">
                                <i class="fa fa-tags"></i> Anúncios</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.plan') }}" class="link-myaccount">
                                <i class="fa fa-credit-card"></i> Plano</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.payments') }}" class="link-myaccount">
                                <i class="fa fa-usd"></i> Pagamentos</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                                <i class="fa fa-cog"></i> Configurações</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">


                    <div class="row tab-search secao">

                        <form method="GET" action="" accept-charset="UTF-8" id="ads-form">
                            <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 col-md-offset-7 col-lg-offset-7" style="margin-bottom: 10px;">
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="">Tipo</option>
                                    <option value="1" {{app('request')->input('tipo')==1?'selected':''}}>Artistas</option>
                                    <option value="2" {{app('request')->input('tipo')==2?'selected':''}}>Profissionais</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" name="search" value="{{ app('request')->input('search') }}" placeholder="Procure por anúncios...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" id="search-users-btn" style="height: 40px;">
                                            <span class="fa fa-search"></span>
                                        </button>
                                        @if (app('request')->input('search') != '' || app('request')->input('tipo')!='')
                                                <a href="{{ route('myaccount.advertisement') }}" class="btn btn-danger" type="button" >
                                                    <span class="fa fa-remove"></span>
                                                </a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('partials.messages')

                    <table class="table table-hover table-striped">
                        <tbody>
                        <tr>
                            <th>Foto</th>
                            <th>Detalhes</th>
                            <th>Visitas</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        @if (count($advertisements))
                            @foreach ($advertisements as $advertisement)
                                <tr>
                                    <td width="20%" >
                                        <img class="thumbnail text-center" src="{{asset('uploads/'.$advertisement->embedded->imagepath)}}"style="width: 100px; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    </td>
                                    <td width="50%">
                                        @if($advertisement->embedded_type=='App\Models\Artist')
                                            <a href="{{ route('artist.show',$advertisement->id) }}" target="_blank">
                                                <h5>{{ $advertisement->embedded->title }}</h5>
                                            </a>
                                            <span class="info-row">
                                                <p class="category">
                                                    <i class="fa fa-music"></i>
                                                    {{ $advertisement->embedded->musicalstyles->first()->name }}
                                                </p>
                                                <p class="item-location">
                                                    <i class="fa fa-map-marker"></i>
                                                    {{$advertisement->city->cidade .' - '. $advertisement->state->sigla}}
                                                </p>
                                            </span>
                                        @else
                                            <a href="{{ route('professional.show',$advertisement->id) }}" target="_blank">
                                                <h5>{{ $advertisement->embedded->title }}</h5>
                                            </a>
                                            <span class="info-row">
                                                <p class="category">
                                                    <i class="fa fa-tag"></i>
                                                    {{ $advertisement->embedded->category->name }}
                                                </p>
                                                <p class="item-location">
                                                    <i class="fa fa-map-marker"></i>
                                                    {{$advertisement->city->cidade .' - '. $advertisement->state->sigla}}
                                                </p>
                                            </span>
                                        @endif
                                    </td>
                                    <td width="10%">{{ $advertisement->visits }}</td>
                                    <td width="10%" class="text-center">
                                        @if(!$advertisement->isActiveFeatured())
                                        <a href="{{route('myaccount.advertisement.pay',$advertisement->id)}}" class="btn btn-primary btn-circle edit" style="margin-top: 10px;" title="Colocar anúncio em destaque"
                                           data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-certificate"></i> Destaque
                                        </a>
                                        @endif
                                        @if($advertisement->suspended)
                                        <a href="{{ route('myaccount.advertisement.publish', $advertisement->id) }}" class="btn btn-primary btn-circle edit" style="margin-top: 10px;" title="Editar anúncio"
                                           data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-edit"></i> Publicar
                                        </a>
                                        @else
                                        <a href="{{ route('myaccount.advertisement.edit', $advertisement->id) }}" class="btn btn-primary btn-circle edit" style="margin-top: 10px;" title="Editar anúncio"
                                           data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        @endif
                                        <a id="deletebtn{{$advertisement->id}}" href="{{route('myaccount.advertisement.delete',$advertisement->id)}}" onclick="deleteads({{$advertisement->id}})"  class="btn btn-secondary btn-circle excluir" style="margin-top: 10px;" title="Excluir anúncio"
                                           data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-trash"></i> Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center"><em>Não foram encontrados registros</em></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $advertisements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
    <script>
        jQuery("#tipo").change(function () {
            jQuery("#ads-form").submit();
        });
        jQuery('.excluir').click(function(e){
            e.preventDefault();
        });
        function deleteads(id){
            swal({
                title: 'Você tem certeza?',
                text: "Isso vai excluir permanentemente o seu anúncio !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then(function(teste) {
                if(teste.value){
                    window.location.href = jQuery('#deletebtn'+id).attr('href');
                }else{
                }
            })
        }
    </script>
@endsection
