@extends('frontend.layouts.masterteste')


@section('content')
    <div class="container">
        <div class="row">
            <div class="container secao">
                <a href="{{ url()->previous() }}" class="btn btn-primary voltar">Voltar</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 15px;">
                <h1 class="text-center">Criar anúncio</h1>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box">
                <div>
                    <form action="{{$edit?route('advertisement.update',$advertisement->id):route('advertisement.post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if($edit)
                            <input type="hidden" name="edit" value="1">
                        @else
                            <input type="hidden" name="edit" value="0">
                        @endif
                        <div class="form-group col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                            @include('partials.messages')

                            <h2>Detalhes do anúncio:</h2>

                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="type">Tipo de anúncio:</label>
                                <select class="form-control selectpicker" id="type" name="type">
                                    <option value="">Selecione</option>
                                    @if($edit)
                                        <option value="1" {{$advertisement->embedded_type=='App\Models\Artist'?"selected":""}}>Artista</option>
                                        <option value="2" {{$advertisement->embedded_type=='App\Models\Professional'?"selected":""}}>Profissional</option>
                                    @else
                                    <option value="1" {{old('type')=='1'?"selected":""}}>Artista</option>
                                    <option value="2" {{old('type')=='2'?"selected":""}}>Profissional</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="title">Título:</label>
                                @if($edit)
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{$advertisement->embedded->title}}" placeholder="título do anúncio...">
                                @else
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{old('title')}}" placeholder="título do anúncio...">
                                @endif

                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="description">Descrição:</label>
                                @if($edit)
                                    <textarea class="form-control" rows="5" id="description" name="description">{{$advertisement->embedded->description}}</textarea>
                                @else
                                    <textarea class="form-control" rows="5" id="description" name="description">{{old('description')}}</textarea>
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divcache">
                                <label for="title">Cachê:</label>
                                @if($edit)
                                    <input type="text" class="form-control" id="cache" name="cache"
                                           value="{{$advertisement->embedded_type=='App\Models\Artist'?$advertisement->embedded->cache:''}}" placeholder="00,00">
                                @else
                                    <input type="text" class="form-control" id="cache" name="cache"
                                           value="{{old('cache')}}" placeholder="00,00">
                                @endif
                            </div>
                            <div id="divestilos">
                                <label class="col-xs-12 col-sm-12 col-md-12">Estilo musical:</label>
                                @if($edit and $advertisement->embedded_type=='App\Models\Artist')
                                    @foreach($estilos as $estilo)
                                        <div class="checkbox col-xs-12 col-sm-12 col-md-12">
                                            <label>
                                                <input type="checkbox" value="{{$estilo->id}}" name="estilos[]"
                                                        {{$advertisement->embedded->checkMusicStyle($estilo->id)==true?'checked':''}}>{{$estilo->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($estilos as $estilo)
                                        <div class="checkbox col-xs-12 col-sm-12 col-md-12">
                                            <label>
                                                <input type="checkbox" value="{{$estilo->id}}" name="estilos[]" >{{$estilo->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divvideo">
                                <label for="youtube">video do youtube:</label>
                                @if($edit)
                                    <input type="text" class="form-control" id="videoyoutube" name="videoyoutube"
                                           value="{{$advertisement->embedded_type=='App\Models\Artist'?$advertisement->embedded->video:''}}" placeholder="informe um link de vídeo do youtube">
                                @else
                                    <input type="text" class="form-control" id="videoyoutube" name="videoyoutube"
                                           value="{{old('videoyoutube')}}" placeholder="informe um link de vídeo do youtube">
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divcategoria">
                                <label for="categoria">Categoria:</label>
                                @if($edit and $advertisement->embedded_type=='App\Models\Professional')
                                    <select class="form-control selectpicker" id="categoria" name="categoria" data-live-search="true">
                                        <option value="">Selecione a categoria</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}" {{$advertisement->embedded->category_id==$categoria->id?"selected":""}}>{{$categoria->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control selectpicker" id="categoria" name="categoria" data-live-search="true">
                                        <option value="">Selecione a categoria</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}" {{old('categoria')==$categoria->id?"selected":""}}>{{$categoria->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divsubcategoria">
                                <label for="subcategoria">Sub categoria:</label>
                                @if($edit and $advertisement->embedded_type=='App\Models\Professional')
                                    <select class="form-control selectpicker" id="subcategoria" name="subcategoria" data-live-search="true">
                                        <option value="">Selecione a subcategoria</option>
                                        @foreach($subcategorias as $subcategoria)
                                            <option value="{{$subcategoria->id}}" {{$advertisement->embedded->subcategory_id==$subcategoria->id?"selected":""}}>{{$subcategoria->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control selectpicker" id="subcategoria" name="subcategoria" data-live-search="true">
                                        <option value="">Selecione a subcategoria</option>
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                            <h2>Local:</h2>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="estado">Estado:</label>
                                @if($edit)
                                    <select class="form-control selectpicker" id="estado" name="estado" data-live-search="true">
                                        <option value="">Selecione o estado</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}" {{$advertisement->estado_id==$estado->id?"selected":""}}>{{$estado->estado}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control selectpicker" id="estado" name="estado" data-live-search="true">
                                        <option value="">Selecione o estado</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}" {{old('estado')==$estado->id?"selected":""}}>{{$estado->estado}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="cidade">Cidade:</label>
                                @if($edit)
                                    <select class="form-control selectpicker" id="cidade" name="cidade" data-live-search="true">
                                        <option value="">Selecione a cidade</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{$cidade->id}}" {{$advertisement->cidade_id==$cidade->id?"selected":""}}>{{$cidade->cidade}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control selectpicker" id="cidade" name="cidade" data-live-search="true">
                                        <option value="">Selecione a cidade</option>
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                            <h2>Fotos:</h2>
                            @if($edit)
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                        <img class="thumbnail no-margin" src="{{asset('uploads/'.$advertisement->embedded->imagepath)}}" alt="img" style="height:186px;">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                        <label class="btn btn-primary" for="my-file-selector">
                                            <input name="foto" id="my-file-selector" type="file" style="display:none;" onchange="jQuery('#upload-file-info').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                            Procurar foto 1
                                        </label>
                                        <span class='label label-info' id="upload-file-info"></span>
                                    </div>
                                    <div id="fotosprofissionais">
                                        @if($advertisement->embedded->imagepath2)
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                <img class="thumbnail no-margin" src="{{asset('uploads/'.$advertisement->embedded->imagepath2)}}" alt="img" style="height:186px;">
                                            </div>
                                        @endif
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                            <label class="btn btn-primary" for="my-file-selector2">
                                                <input name="foto2" id="my-file-selector2" type="file" style="display:none;" onchange="jQuery('#upload-file-info2').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                Procurar foto 2
                                            </label>
                                            <span class='label label-info' id="upload-file-info2"></span>
                                        </div>
                                        @if($advertisement->embedded->imagepath3)
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                <img class="thumbnail no-margin" src="{{asset('uploads/'.$advertisement->embedded->imagepath3)}}" alt="img" style="height:186px;">
                                            </div>
                                        @endif
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                            <label class="btn btn-primary" for="my-file-selector3">
                                                <input name="foto3" id="my-file-selector3" type="file" style="display:none;" onchange="jQuery('#upload-file-info3').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                Procurar foto 3
                                            </label>
                                            <span class='label label-info' id="upload-file-info3"></span>
                                        </div>
                                        @if($advertisement->embedded->imagepath4)
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                <img class="thumbnail no-margin" src="{{asset('uploads/'.$advertisement->embedded->imagepath4)}}" alt="img" style="height:186px;">
                                            </div>
                                        @endif
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                            <label class="btn btn-primary" for="my-file-selector4">
                                                <input name="foto4" id="my-file-selector4" type="file" style="display:none;" onchange="jQuery('#upload-file-info4').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                Procurar foto 4
                                            </label>
                                            <span class='label label-info' id="upload-file-info4"></span>
                                        </div>
                                        @if($advertisement->embedded->imagepath5)
                                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                                <img class="thumbnail no-margin" src="{{asset('uploads/'.$advertisement->embedded->imagepath5)}}" alt="img" style="height:186px;">
                                            </div>
                                        @endif
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                            <label class="btn btn-primary" for="my-file-selector5">
                                                <input name="foto5" id="my-file-selector5" type="file" style="display:none;" onchange="jQuery('#upload-file-info5').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                                Procurar foto 5
                                            </label>
                                            <span class='label label-info' id="upload-file-info5"></span>
                                        </div>
                                    </div>
                            @else
                                <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                    <label class="btn btn-primary" for="my-file-selector">
                                        <input name="foto" id="my-file-selector" type="file" style="display:none;" onchange="jQuery('#upload-file-info').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                        Procurar foto 1
                                    </label>
                                    <span class='label label-info' id="upload-file-info"></span>
                                </div>
                                <div id="fotosprofissionais">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                        <label class="btn btn-primary" for="my-file-selector2">
                                            <input name="foto2" id="my-file-selector2" type="file" style="display:none;" onchange="jQuery('#upload-file-info2').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                            Procurar foto 2
                                        </label>
                                        <span class='label label-info' id="upload-file-info2"></span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                        <label class="btn btn-primary" for="my-file-selector3">
                                            <input name="foto3" id="my-file-selector3" type="file" style="display:none;" onchange="jQuery('#upload-file-info3').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                            Procurar foto 3
                                        </label>
                                        <span class='label label-info' id="upload-file-info3"></span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                        <label class="btn btn-primary" for="my-file-selector4">
                                            <input name="foto4" id="my-file-selector4" type="file" style="display:none;" onchange="jQuery('#upload-file-info4').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                            Procurar foto 4
                                        </label>
                                        <span class='label label-info' id="upload-file-info4"></span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                                        <label class="btn btn-primary" for="my-file-selector5">
                                            <input name="foto5" id="my-file-selector5" type="file" style="display:none;" onchange="jQuery('#upload-file-info5').html(jQuery(this).val().replace('C:\\fakepath\\', ''));">
                                            Procurar foto 5
                                        </label>
                                        <span class='label label-info' id="upload-file-info5"></span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                            <h2>Redes sociais:</h2>
                            @if($edit)
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="facebook">Facebook:</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                           value="{{$advertisement->embedded->facebook}}" placeholder="informe seu facebook">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="instagram">Instagram:</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                           value="{{$advertisement->embedded->instagram}}" placeholder="informe seu instagram">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="youtube">Youtube:</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube"
                                           value="{{$advertisement->embedded->youtube}}" placeholder="informe seu canal do yotube">
                                </div>
                            @else
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="facebook">Facebook:</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                           value="{{old('facebook')}}" placeholder="informe seu facebook">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="instagram">Instagram:</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                           value="{{old('instagram')}}" placeholder="informe seu instagram">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="youtube">Youtube:</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube"
                                           value="{{old('youtube')}}" placeholder="informe seu canal do yotube">
                                </div>
                            @endif
                        </div>

                        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </div>
                    </form>
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

        jQuery('#divcache').hide();
        jQuery('#divestilos').hide();
        jQuery('#divvideo').hide();
        jQuery('#divcategoria').hide();
        jQuery('#divsubcategoria').hide();
        jQuery('#type').on('change', function (e) {
            var selected = jQuery('#type option:selected').val();
            if(selected==1){
                jQuery('#divcache').show();
                jQuery('#divestilos').show();
                jQuery('#divvideo').show();
                jQuery('#divcategoria').hide();
                jQuery('#divsubcategoria').hide();
                jQuery('#fotosprofissionais').hide();
            }
            if(selected==2){
                jQuery('#divcache').hide();
                jQuery('#divestilos').hide();
                jQuery('#divvideo').hide();
                jQuery('#divcategoria').show();
                jQuery('#divsubcategoria').show();
                jQuery('#fotosprofissionais').show();
            }
            if(selected==''){
                jQuery('#divcache').hide();
                jQuery('#divestilos').hide();
                jQuery('#divvideo').hide();
                jQuery('#divcategoria').hide();
                jQuery('#divsubcategoria').hide();
                jQuery('#fotosprofissionais').hide();
            }
        });
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
        jQuery('#categoria').on('changed.bs.select', function (e) {
            var selected = jQuery('#categoria option:selected').val();
            jQuery.get('/categoria/'+selected, function (filtros) {
                jQuery('select[id=subcategoria]').empty();
                jQuery('select[id=subcategoria]').append('<option value=>Selecione a subcategoria</option>');
                jQuery.each(filtros, function (key,value) {
                    jQuery('select[id=subcategoria]').append('<option value=' + value.id + '>' + value.name + '</option>');
                });
                jQuery('#subcategoria').selectpicker('refresh');
            });
        });

        CKEDITOR.replace( 'description' );

        jQuery('#type').on('rendered.bs.select', function (e) {
            var selected = jQuery('#type option:selected').val();
            if(selected==1){
                jQuery('#divcache').show();
                jQuery('#divestilos').show();
                jQuery('#divvideo').show();
                jQuery('#divcategoria').hide();
                jQuery('#divsubcategoria').hide();
                jQuery('#fotosprofissionais').hide();

            }
            if(selected==2){
                jQuery('#divcache').hide();
                jQuery('#divestilos').hide();
                jQuery('#divvideo').hide();
                jQuery('#divcategoria').show();
                jQuery('#divsubcategoria').show();
                jQuery('#fotosprofissionais').show();
            }
            if(selected==''){
                jQuery('#divcache').hide();
                jQuery('#divestilos').hide();
                jQuery('#divvideo').hide();
                jQuery('#divcategoria').hide();
                jQuery('#divsubcategoria').hide();
                jQuery('#fotosprofissionais').hide();
            }
        });
    </script>
@endsection
