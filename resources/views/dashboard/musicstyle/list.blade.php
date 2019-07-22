@extends('dashboard.layouts.master')

@section('page-title', 'Estilos Musicais')
@section('content_header')
<h1>
    Estilos Musicais
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Estilos musicais</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
        @can('Criar estilos musicais')
        <a href="{{ route('dashboard.musicstyle.create') }}" class="btn btn-success" id="add-user">
            <i class="glyphicon glyphicon-plus"></i>
            Adicionar estilo musical
        </a>
        @endcan
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="link-form">
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ app('request')->input('search') }}" placeholder="Procure por estilos musicais...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-users-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (app('request')->input('search') != '')
                        <a href="{{ route('dashboard.musicstyle.list') }}" class="btn btn-danger" type="button" >
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
                <h3 class="box-title">Lista de estilos musicais cadastrados</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="users-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Nome</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            @if (count($styles))
                            @foreach ($styles as $style)
                            <tr>
                                <td>{{ $style->name }}</td>
                                <td class="text-center">
                                    @can('Editar estilos musicais')
                                    <a href="{{ route('dashboard.musicstyle.edit', $style->id) }}" class="btn btn-primary btn-circle edit" title="Editar estilo musical"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @endcan
                                    @can('Excluir estilos musicais')
                                    <a href="{{ route('dashboard.musicstyle.destroy', $style->id) }}" class="btn btn-danger btn-circle" title="Excluir estilo musical"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Por favor confirme"
                                        data-confirm-text="Tem certeza que deseja excluir esse estilo musical?"
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
                        {{ $styles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/delete.handler.js') }}"></script>
@stop
