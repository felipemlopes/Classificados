<div class="panel panel-default">
    <div class="panel-heading">Detalhes do plano</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="Nome da categoria" value="{{ $edit ? $plan->name : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="name">Preço</label>
                    <input class="form-control" name="price" id="price" value="{{ $edit ? $plan->price : old('price') }}">
                </div>
                <div class="form-group">
                    <label for="qtd_ads_art">Quantidade de anúncios de artistas ativos</label>
                    <input class="form-control" name="qtd_ads_art" id="qtd_ads_art" value="{{ $edit ? $qtd_ads_art->limit : old('qtd_ads_art') }}">
                </div>
                <div class="form-group">
                    <label for="qtd_ads_pro">Quantidade de anúncios de profissionais ativos</label>
                    <input class="form-control" name="qtd_ads_pro" id="qtd_ads_pro" value="{{ $edit ? $qtd_ads_pro->limit : old('qtd_ads_pro') }}">
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
