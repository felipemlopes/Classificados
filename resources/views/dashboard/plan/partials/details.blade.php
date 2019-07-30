<div class="panel panel-default">
    <div class="panel-heading">Detalhes do plano</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="Nome da categoria" value="{{ $edit ? $plan->name : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="name">Preço</label>
                    <input class="form-control" name="price" id="price" value="{{ $edit ? $plan->price : old('price') }}">
                </div>
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Atualizar plano
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
