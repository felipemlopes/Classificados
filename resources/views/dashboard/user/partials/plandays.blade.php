<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Adicionar dias premium</label>
                <input type="text" class="form-control" id="days"
                       name="days">
            </div>
        </div>
        <div class="col-md-12">
        @if ($edit)
            <button type="submit" class="btn btn-primary" id="update-login-details-btn">
                <i class="fa fa-refresh"></i>
                Atualizar
            </button>
        @endif
        </div>
    </div>
</div>
