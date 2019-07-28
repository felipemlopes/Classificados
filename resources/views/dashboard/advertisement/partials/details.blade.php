<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="row">
            <input type="hidden" name="type" value="{{$advertisement->embedded_type=="App\Models\Artist"?1:2}}">
            <div class="col-md-12">
                @if($advertisement->embedded_type=="App\Models\Artist")
                    <div class="form-group">
                        <label for="name">Título</label>
                        <input type="text" class="form-control" id="title"
                               name="title" placeholder="Título do anúncio" value="{{ $edit ? $advertisement->embedded->title : old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea class="form-control" rows="5" id="description" name="description">{{ $edit ? $advertisement->embedded->description : old('description') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Cachê:</label>
                        <input class="form-control" name="cache" id="cache" value="{{ $edit ? $advertisement->embedded->cache : old('cache') }}">
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
                            <select class="form-control" id="estado" name="estado">
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
                        <textarea class="form-control" rows="5" id="description" name="description">{{ $edit ? $advertisement->embedded->description : old('description') }}
                        </textarea>
                    </div>

                    <div class="form-group" v-show="type==2">
                        <label for="categoria">Categoria:</label>
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="">Selecione</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}" {{$advertisement->embedded->category_id==$categoria->id?"selected":""}}>{{$categoria->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group" v-show="type==2">
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
                            <select class="form-control" id="estado" name="estado">
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
                @endif

            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Atualizar anúncio
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
