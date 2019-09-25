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

                    @include('partials.messages')
                    <div class="nav-tabs-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                                    <i class="fa fa-info"></i>
                                    Detalhes
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#image" aria-controls="image" role="tab" data-toggle="tab">
                                    <i class="fa fa-picture-o"></i>
                                    Alterar imagem
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active secao-ajuste" id="details">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8 secao-ajuste-topo">
                                        <div class="col-md-12">
                                            <form action="{{route('myaccount.advertisement.update',$advertisement->id)}}" method="post">
                                                @csrf
                                                <h2 class="text-center">Editar detalhes</h2>
                                                <div class="col-md-12">
                                                    <input type="hidden" name="type" value="{{$advertisement->embedded_type=="App\Models\Artist"?1:2}}">
                                                    @if($advertisement->embedded_type=="App\Models\Artist")
                                                        <div class="form-group">
                                                            <label for="name">Título</label>
                                                            <input type="text" class="form-control" id="title"
                                                                   name="title" placeholder="Título do anúncio" value="{{ $edit ? $advertisement->embedded->title : old('title') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Descrição:</label>
                                                            <textarea class="form-control" rows="5" id="description" name="description">{{ $edit ? $advertisement->embedded->description : old('description') }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Cachê:</label>
                                                            <input type="text" class="form-control" name="cache"
                                                                   id="cache" value="{{ $edit ? $advertisement->embedded->cache : old('cache') }}">
                                                        </div>
                                                        <div>
                                                            <label>Estilo musical:</label>
                                                            @foreach($estilos as $estilo)
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$estilo->id}}" name="estilos[]"
                                                                                {{$advertisement->embedded->checkMusicStyle($estilo->id)==true?'checked':''}}>{{$estilo->name}}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="youtube">video do youtube:</label>
                                                            <input type="text" class="form-control" id="videoyoutube" name="videoyoutube"
                                                                   value="{{ $edit ? $advertisement->embedded->video : old('videoyoutube') }}" placeholder="informe um link de vídeo do youtube">
                                                        </div>
                                                        <div>
                                                            <div class="form-group">
                                                                <label for="estado">Estado:</label>
                                                                <select class="form-control" id="estado" name="estado" @change="onChangeEstado($event)">
                                                                    <option value="">Selecione</option>
                                                                    @foreach($estados as $estado)
                                                                        <option value="{{$estado->id}}" {{$advertisement->estado_id==$estado->id?"selected":""}}>{{$estado->estado}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cidade">Cidade:</label>
                                                                <select class="form-control" id="cidade" name="cidade">
                                                                    <option value="">Selecione</option>
                                                                    @foreach($cidades as $cidade)
                                                                        <option value="{{$cidade->id}}" {{$advertisement->cidade_id==$cidade->id?"selected":""}}>{{$cidade->cidade}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="form-group">
                                                                <label for="facebook">Facebook:</label>
                                                                <input type="text" class="form-control" id="facebook" name="facebook"
                                                                       value="{{ $edit ? $advertisement->embedded->facebook : old('facebook') }}" placeholder="informe seu facebook">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="instagram">Instagram:</label>
                                                                <input type="text" class="form-control" id="instagram" name="instagram"
                                                                       value="{{ $edit ? $advertisement->embedded->instagram : old('instagram') }}" placeholder="informe seu instagram">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="youtube">Youtube:</label>
                                                                <input type="text" class="form-control" id="youtube" name="youtube"
                                                                       value="{{ $edit ? $advertisement->embedded->youtube : old('youtube') }}" placeholder="informe seu canal do yotube">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <label for="name">Título</label>
                                                            <input type="text" class="form-control" id="title"
                                                                   name="title" placeholder="Título do anúncio" value="{{ $edit ? $advertisement->embedded->title : old('title') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Descrição:</label>
                                                            <textarea class="form-control" rows="5" id="description" name="description">{{ $edit ? $advertisement->embedded->description : old('description') }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="categoria">Categoria:</label>
                                                            <select class="form-control" id="categoria" name="categoria" @change="onChangeCategoria($event)">
                                                                <option value="">Selecione</option>
                                                                @foreach($categorias as $categoria)
                                                                    <option value="{{$categoria->id}}" {{$advertisement->embedded->category_id==$categoria->id?"selected":""}}>{{$categoria->name}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="subcategoria">Sub categoria:</label>
                                                            <select class="form-control" id="subcategoria" name="subcategoria">
                                                                <option value="">Selecione</option>
                                                                @foreach($subcategorias as $subcategoria)
                                                                    <option value="{{$subcategoria->id}}" {{$advertisement->embedded->subcategory_id==$subcategoria->id?"selected":""}}>{{$subcategoria->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <div class="form-group">
                                                                <label for="estado">Estado:</label>
                                                                <select class="form-control" id="estado" name="estado" @change="onChangeEstado($event)">
                                                                    <option value="">Selecione o estado</option>
                                                                    @foreach($estados as $estado)
                                                                        <option value="{{$estado->id}}" {{$advertisement->estado_id==$estado->id?"selected":""}}>{{$estado->estado}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cidade">Cidade:</label>
                                                                <select class="form-control" id="cidade" name="cidade">
                                                                    <option value="">Selecione a cidade</option>
                                                                    @foreach($cidades as $cidade)
                                                                        <option value="{{$cidade->id}}" {{$advertisement->cidade_id==$cidade->id?"selected":""}}>{{$cidade->cidade}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="form-group">
                                                                <label for="facebook">Facebook:</label>
                                                                <input type="text" class="form-control" id="facebook" name="facebook"
                                                                       value="{{ $edit ? $advertisement->embedded->facebook : old('facebook') }}" placeholder="informe seu facebook">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="instagram">Instagram:</label>
                                                                <input type="text" class="form-control" id="instagram" name="instagram"
                                                                       value="{{ $edit ? $advertisement->embedded->instagram : old('instagram') }}" placeholder="informe seu instagram">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="youtube">Youtube:</label>
                                                                <input type="text" class="form-control" id="youtube" name="youtube"
                                                                       value="{{ $edit ? $advertisement->embedded->youtube : old('youtube') }}" placeholder="informe seu canal do yotube">
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                                @if ($publish)
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary" id="update-details-btn">
                                                            <i class="fa fa-refresh"></i>
                                                            Publicar anúncio
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary" id="update-details-btn">
                                                            <i class="fa fa-refresh"></i>
                                                            Atualizar anúncio
                                                        </button>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="image">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8 secao-ajuste-topo">
                                        <div class="col-md-12">
                                            <h2 class="text-center">Alterar imagem</h2>

                                            <form action="{{route('myaccount.advertisement.update.image',$advertisement->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div>
                                                    <img class="thumbnail" src="{{asset('uploads/'.$advertisement->embedded->imagepath)}}" alt="img" style="height:186px; margin:0 auto;">
                                                </div>
                                                <div class="text-center" style="padding-bottom:10px;">
                                                    <label class="btn btn-primary" for="my-file-selector">
                                                        <input name="foto" id="my-file-selector" type="file" style="display:none;" onchange="jQuery('#upload-file-info').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                        Procurar foto 1
                                                    </label>
                                                    <span class='label label-info' id="upload-file-info"></span>
                                                </div>
                                                @if($advertisement->embedded_type=="App\Models\Professional")
                                                    @if($advertisement->embedded->imagepath2)
                                                    <div>
                                                        <img class="thumbnail" src="{{asset('uploads/'.$advertisement->embedded->imagepath2)}}" alt="img" style="height:186px; margin:0 auto;">
                                                    </div>
                                                    @endif
                                                    <div class="text-center" style="padding-bottom:10px;">
                                                        <label class="btn btn-primary" for="my-file-selector2">
                                                            <input name="foto2" id="my-file-selector2" type="file" style="display:none;" onchange="jQuery('#upload-file-info2').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                            Procurar foto 2
                                                        </label>
                                                        <span class='label label-info' id="upload-file-info2"></span>
                                                    </div>
                                                    @if($advertisement->embedded->imagepath3)
                                                        <div>
                                                            <img class="thumbnail" src="{{asset('uploads/'.$advertisement->embedded->imagepath3)}}" alt="img" style="height:186px; margin:0 auto;">
                                                        </div>
                                                    @endif
                                                    <div class="text-center" style="padding-bottom:10px;">
                                                        <label class="btn btn-primary" for="my-file-selector3">
                                                            <input name="foto3" id="my-file-selector3" type="file" style="display:none;" onchange="jQuery('#upload-file-info3').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                            Procurar foto 3
                                                        </label>
                                                        <span class='label label-info' id="upload-file-info3"></span>
                                                    </div>
                                                    @if($advertisement->embedded->imagepath4)
                                                        <div>
                                                            <img class="thumbnail" src="{{asset('uploads/'.$advertisement->embedded->imagepath4)}}" alt="img" style="height:186px; margin:0 auto;">
                                                        </div>
                                                    @endif
                                                    <div class="text-center" style="padding-bottom:10px;">
                                                        <label class="btn btn-primary" for="my-file-selector4">
                                                            <input name="foto4" id="my-file-selector4" type="file" style="display:none;" onchange="jQuery('#upload-file-info4').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                            Procurar foto 4
                                                        </label>
                                                        <span class='label label-info' id="upload-file-info4"></span>
                                                    </div>
                                                    @if($advertisement->embedded->imagepath5)
                                                        <div>
                                                            <img class="thumbnail" src="{{asset('uploads/'.$advertisement->embedded->imagepath5)}}" alt="img" style="height:186px; margin:0 auto;">
                                                        </div>
                                                    @endif
                                                    <div class="text-center" style="padding-bottom:10px;">
                                                        <label class="btn btn-primary" for="my-file-selector5">
                                                            <input name="foto5" id="my-file-selector5" type="file" style="display:none;" onchange="jQuery('#upload-file-info5').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                            Procurar foto 5
                                                        </label>
                                                        <span class='label label-info' id="upload-file-info5"></span>
                                                    </div>
                                                @endif
                                                <input type="hidden" name="id" value="{{$advertisement->id}}">
                                                @if ($edit)
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary" id="update-details-btn">
                                                            <i class="fa fa-refresh"></i>
                                                            Atualizar fotos
                                                        </button>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script>
        jQuery('#cache').mask('000.000.000.000.000,00', {reverse: true});
        CKEDITOR.replace( 'description' );
    </script>
@endsection
