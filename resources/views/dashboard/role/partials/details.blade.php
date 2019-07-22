<div class="panel panel-default">
    <div class="panel-heading">Detalhes do papel</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="Nome do papel" value="{{ $edit ? $role->name : old('name') }}">
                </div>
            </div>


            <div class="col-md-12">
                @if($edit)
                    @foreach($permissions as $permission)
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input name="permissions[]" type="checkbox" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked="checked"':''}}>
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
