<div class="panel panel-default">
    <div class="panel-heading">Detalhes do usuário</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">Nome</label>
                    <input type="text" class="form-control" id="first_name"
                           name="first_name" placeholder="Nome do usuário" value="{{ $edit ? $user->first_name : old('first_name') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Sobrenome</label>
                    <input type="text" class="form-control" id="last_name"
                           name="last_name" placeholder="Sobrenome do usuário" value="{{ $edit ? $user->last_name : old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email"
                           name="email" placeholder="Email do usuário" value="{{ $edit ? $user->email : old('email') }}">
                </div>

                @if (!$edit)
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="text" class="form-control" id="password"
                               name="password" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar senha</label>
                        <input type="text" class="form-control" id="password_confirmation"
                               name="password_confirmation" placeholder="" value="">
                    </div>
                @endif
            </div>


            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Atualizar
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
