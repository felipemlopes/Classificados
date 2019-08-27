@extends('frontend.layouts.masterteste')


@section('content')
    <div class="row">

        <h1 class="text-center">Criar anúncio</h1>

        <form action="{{route('advertisement.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                @include('partials.messages')

                <h2>Detalhes do anúncio:</h2>

                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="type">Tipo de anúncio:</label>
                    <select class="form-control selectpicker" id="type" name="type">
                        <option value="">Selecione</option>
                        <option value="1" {{old('type')=='1'?"selected":""}}>Artista</option>
                        <option value="2" {{old('type')=='2'?"selected":""}}>Profissional</option>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{old('title')}}" placeholder="título do anúncio...">
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="description">Descrição:</label>
                    <textarea class="form-control" rows="5" id="description" name="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divcache">
                    <label for="title">Cachê:</label>
                    <input type="text" class="form-control" id="cache" name="cache"
                           value="{{old('cache')}}" placeholder="00,00">

                </div>
                <div id="divestilos">
                    <label class="col-xs-12 col-sm-12 col-md-12">Estilo musical:</label>
                    @foreach($estilos as $estilo)
                        <div class="checkbox col-xs-12 col-sm-12 col-md-12">
                            <label>
                                <input type="checkbox" value="{{$estilo->id}}" name="estilos[]" >{{$estilo->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divvideo">
                    <label for="youtube">video do youtube:</label>
                    <input type="text" class="form-control" id="videoyoutube" name="videoyoutube"
                           value="{{old('videoyoutube')}}" placeholder="informe um link de vídeo do youtube">
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divcategoria">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control selectpicker" id="categoria" name="categoria" @change="onChangeCategoria($event)">
                        <option value="">Selecione a categoria</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}" {{old('categoria')==$categoria->id?"selected":""}}>{{$categoria->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" id="divsubcategoria">
                    <label for="subcategoria">Sub categoria:</label>
                    <select class="form-control selectpicker" id="subcategoria" name="subcategoria">
                        <option value="">Selecione a subcategoria</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                <h2>Local:</h2>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="estado">Estado:</label>
                    <select class="form-control selectpicker" id="estado" name="estado" @change="onChangeEstado($event)">
                        <option value="">Selecione o estado</option>
                        @foreach($estados as $estado)
                            <option value="{{$estado->id}}" {{old('estado')==$estado->id?"selected":""}}>{{$estado->estado}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="cidade">Cidade:</label>
                    <select class="form-control selectpicker" id="cidade" name="cidade">
                        <option value="">Selecione a cidade</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                <h2>Fotos:</h2>

                <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px;">
                    <label class="btn btn-primary" for="my-file-selector">
                        <input name="foto" id="my-file-selector" type="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
                        Procurar foto
                    </label>
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
            </div>



            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 secao">
                <h2>Redes sociais:</h2>

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
            </div>

            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
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

            }
            if(selected==2){
                jQuery('#divcache').hide();
                jQuery('#divestilos').hide();
                jQuery('#divvideo').hide();
                jQuery('#divcategoria').show();
                jQuery('#divsubcategoria').show();
            }
            if(selected==''){
                jQuery('#divcache').hide();
                jQuery('#divestilos').hide();
                jQuery('#divvideo').hide();
                jQuery('#divcategoria').hide();
                jQuery('#divsubcategoria').hide();
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

    </script>
@endsection
