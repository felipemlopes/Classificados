<div class="panel panel-default">
    <div class="panel-heading">Geral</div>
    <div class="panel-body">
        <form action="{{route('dashboard.settings.auth.update')}}" method="post">
            @csrf
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input name="forgot_password" type="checkbox" value="1" {!! setting('forgot_password') ? 'checked' : '' !!}>
                        Habilitar a opção "esqueci minha senha"
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
