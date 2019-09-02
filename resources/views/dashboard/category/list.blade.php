@extends('dashboard.layouts.master')

@section('page-title', 'Categorias')
@section('content_header')
<h1>
    Categorias
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Categorias</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
        @can('Criar categorias')
        <a href="{{ route('dashboard.category.create') }}" class="btn btn-success" id="add-user">
            <i class="glyphicon glyphicon-plus"></i>
            Adicionar categoria
        </a>
        @endcan
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="categoryform">
        <div class="col-md-2 col-xs-4">
            <select name="category" id="categoria" class="form-control">
                <option value="">Categoria</option>
                @foreach($categoriaspai as $categoria)
                    <option value="{{$categoria->id}}" {{app('request')->input('category')==$categoria->id?'selected':''}}>{{$categoria->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ app('request')->input('search') }}" placeholder="Procure por categorias...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-users-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (app('request')->input('search') != '')
                        <a href="{{ route('dashboard.category.list') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de categorias cadastradas</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="users-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Nome</th>
                                <th>Pai</th>
                                <th>Anúncios</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            @if (count($categories))
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent_id != null ? $category->parent->name: ''}}</td>
                                <td>{{ $category->parent_id==null?$category->professionals->count():$category->subprofessionals->count() }}</td>
                                <td class="text-center">
                                    @can('Editar categorias')
                                    <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-primary btn-circle edit" title="Editar categoria"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @endcan
                                    @can('Excluir categorias')
                                    <a href="{{ route('dashboard.category.destroy', $category->id) }}" class="btn btn-danger btn-circle" title="Excluir categoria"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Por favor confirme"
                                        data-confirm-text="Tem certeza que deseja excluir essa categoria?"
                                        data-confirm-delete="Sim">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center"><em>Não foram encontrados registros</em></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/delete.handler.js') }}"></script>
    <script>
        $("#categoria").change(function () {
            $("#categoryform").submit();
        });
    </script>
@stop
