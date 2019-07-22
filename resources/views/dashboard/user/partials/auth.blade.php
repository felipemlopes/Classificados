<div class="panel panel-default">
    <div class="panel-heading">Detalhes de autenticação</div>
    <div class="panel-body">
        <div class="form-group">
            <label for="password">{{ $edit ? 'Nova senha' : 'Senha' }}</label>
            <input type="password" class="form-control" id="password"
                   name="password" @if ($edit) placeholder="" @endif>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ $edit ? 'Confirmar nova senha' : 'Confirmar senha' }}</label>
            <input type="password" class="form-control" id="password_confirmation"
                   name="password_confirmation">
        </div>
        @if ($edit)
            <button type="submit" class="btn btn-primary" id="update-login-details-btn">
                <i class="fa fa-refresh"></i>
                Atualizar
            </button>
        @endif
    </div>
</div>
