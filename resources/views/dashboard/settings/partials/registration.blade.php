<div class="panel panel-default">
    <div class="panel-heading">Geral</div>
    <div class="panel-body">
        <form action="{{route('dashboard.settings.auth.update')}}" method="post">
            @csrf
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input name="reg_enabled" type="checkbox" value="1" {!! setting('reg_enabled') ? 'checked' : '' !!}>
                        Permitir cadastro de novos usuários
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input name="tos" type="checkbox" value="1" {!! setting('tos') ? 'checked' : '' !!}>
                        Exigir aceitar os termos de serviço
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-refresh"></i>
                Atualizar configurações
            </button>
        </form>
    </div>
</div>
