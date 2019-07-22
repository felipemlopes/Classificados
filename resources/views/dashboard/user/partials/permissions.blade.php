<div class="panel panel-default">
    <div class="panel-heading">Detalhes de permissões</div>
    <div class="panel-body">
        <div class="col-md-12">
            @if($edit)
                @foreach($permissions as $permission)
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input name="permissions[]" type="checkbox" value="{{$permission->id}}" {{$user->hasPermissionTo($permission->name) ? 'checked="checked"':''}}>
                                {{$permission->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($permissions as $permission)
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input name="permissions[]" type="checkbox" value="{{$permission->id}}">
                                {{$permission->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        @if ($edit)
            <button type="submit" class="btn btn-primary" id="update-login-details-btn">
                <i class="fa fa-refresh"></i>
                Atualizar
            </button>
        @endif
    </div>
</div>
