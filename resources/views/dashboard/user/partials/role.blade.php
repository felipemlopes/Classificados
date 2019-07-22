<div class="panel panel-default">
    <div class="panel-heading">Detalhes do papel</div>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                @if($user->roles->count() > 0)
                    @foreach($roles as $role)
                        <div class="radio">
                            <label>
                                <input type="radio" name="roles" value="{{$role}}" {{$user->roles->first()->name == $role? 'checked' : ''}}>
                                {{$role}}
                            </label>
                        </div>
                    @endforeach
                @else
                    @foreach($roles as $role)
                        <div class="radio">
                            <label>
                                <input type="radio" name="roles" value="{{$role}}">
                                {{$role}}
                            </label>
                        </div>
                    @endforeach
                @endif
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
