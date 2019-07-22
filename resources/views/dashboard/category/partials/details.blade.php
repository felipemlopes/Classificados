<div class="panel panel-default">
    <div class="panel-heading">Detalhes da categoria</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="Nome da categoria" value="{{ $edit ? $category->name : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="name">Categoria pai</label>
                    <select name="parent_id" id="parent_id" class="selectpicker" data-live-search="true" title="Categoria pai...">
                        @foreach($categories as $c)
                            <option value="{{$c->id}}" {{($edit and $category->parent_id) != null ? 'selected': ''}}>{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Atualizar categoria
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
