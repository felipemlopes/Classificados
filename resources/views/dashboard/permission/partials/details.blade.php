<div class="panel panel-default">
    <div class="panel-heading">Detalhes da permissão</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="Nome da permissão" value="{{ $edit ? $permission->name : old('name') }}">
                </div>
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Atualizar permissão
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
