@extends('frontend.layouts.master')


@section('content')
    <div class="row" id="app">

        <h1 class="text-center">Criar anúncio</h1>



        <form action="{{route('advertisement.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-xs-12 col-sm-12 col-md-8  col-md-offset-2">
                @include('partials.messages')

                <h2>Detalhes do anúncio:</h2>

                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="type">Tipo de anúncio:</label>
                    <select class="form-control" id="type" name="type" v-model="type">
                        <option value="">Selecione</option>
                        <option value="1" {{old('type')==1?"selected":""}}>Artista</option>
                        <option value="2" {{old('type')==2?"selected":""}}>Profissional</option>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{old('title')}}" placeholder="título do anúncio...">
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="description">Descrição:</label>
                    <textarea class="form-control" rows="5" id="description" name="description">{{old('description')}}
                    </textarea>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" v-show="type==1">
                    <label for="title">Cachê:</label>
                    <!--<input type="text" class="form-control" id="cache" name="cache" v-model="cache" v-bind="money"
                           value="{{--old('cache')--}}" >-->
                    <money v-model="cache"
                           v-bind="money"
                           class="form-control"
                           name="cache"
                           value="{{old('cache')}}"></money>

                </div>
                <div v-show="type==1">
                    <label class="col-xs-12 col-sm-12 col-md-12">Estilo musical:</label>
                    @foreach($estilos as $estilo)
                        <div class="checkbox col-xs-12 col-sm-12 col-md-12">
                            <label>
                                <input type="checkbox" value="{{$estilo->id}}" name="estilos[]" >{{$estilo->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" v-show="type==1">
                    <label for="youtube">video do youtube:</label>
                    <input type="text" class="form-control" id="videoyoutube" name="videoyoutube"
                           value="{{old('videoyoutube')}}" placeholder="informe um link de vídeo do youtube">
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" v-show="type==2">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control" id="categoria" name="categoria">
                        <option value="">Selecione</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}" {{old('categoria')==$categoria->id?"selected":""}}>{{$categoria->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12" v-show="type==2">
                    <label for="subcategoria">Sub categoria:</label>
                    <select class="form-control" id="subcategoria" name="subcategoria">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                <h2>Local:</h2>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="estado">Estado:</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="">Selecione</option>
                        @foreach($estados as $estado)
                            <option value="{{$estado->id}}" {{old('estado')==$estado->id?"selected":""}}>{{$estado->estado}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="cidade">Cidade:</label>
                    <select class="form-control" id="cidade" name="cidade">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                <h2>Fotos:</h2>

                <div style="padding-bottom:10px;">
                    <label class="btn btn-primary" for="my-file-selector">
                        <input name="foto" id="my-file-selector" type="file" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
                        Procurar foto
                    </label>
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
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

            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script>


        $('#estado').on('change', function (e) {
            var selected = $('#estado option:selected').val();
            $.get('/cidades/'+selected, function (filtros) {
                $('select[id=cidade]').empty();
                $('select[id=cidade]').append('<option value=>Selecione</option>');
                $.each(filtros, function (key,value) {
                    $('select[id=cidade]').append('<option value=' + value.id + '>' + value.cidade + '</option>');
                });
            });
        });

        $('#categoria').on('change', function (e) {
            var selected = $('#categoria option:selected').val();
            $.get('/categoria/'+selected, function (filtros) {
                $('select[id=subcategoria]').empty();
                $('select[id=subcategoria]').append('<option value=>Selecione</option>');
                $.each(filtros, function (key,value) {
                    $('select[id=subcategoria]').append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
        });
    </script>
@endsection
