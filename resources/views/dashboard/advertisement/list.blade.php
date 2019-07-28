@extends('dashboard.layouts.master')

@section('page-title', 'Anúncios')
@section('content_header')
<h1>
    Anúncios
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Anúncios</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
        @can('Criar anúncios')
        <a href="{{ route('dashboard.advertisement.create') }}" class="btn btn-success" id="add-user">
            <i class="glyphicon glyphicon-plus"></i>
            Adicionar anúncio
        </a>
        @endcan
    </div>
    <div class="col-md-5 col-xs-3">

    </div>
    <form method="GET" action="" accept-charset="UTF-8" id="ads-form">
        <div class="col-md-2 col-xs-3">
            <select name="tipo" id="tipo" class="form-control">
                <option value="">Tipo</option>
                <option value="1" {{app('request')->input('tipo')==1?'selected':''}}>Artistas</option>
                <option value="2" {{app('request')->input('tipo')==2?'selected':''}}>Profissionais</option>
            </select>
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ app('request')->input('search') }}" placeholder="Procure por anúncios...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-users-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (app('request')->input('search') != '' || app('request')->input('tipo')!='')
                        <a href="{{ route('dashboard.advertisement.list') }}" class="btn btn-danger" type="button" >
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
                <h3 class="box-title">Lista de anúncios cadastrados</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="users-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Usuário</th>
                                <th>Link</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            @if (count($advertisements))
                            @foreach ($advertisements as $advertisement)
                            <tr>
                                <td>{{ $advertisement->embedded->title }}</td>
                                <td>{{ $advertisement->getType() }}</td>
                                <td>{{ $advertisement->user->email }}</td>
                                <td>
                                    @if($advertisement->embedded_type=='App\Models\Artist')
                                        <a href="{{ route('artist.show',$advertisement->id) }}" target="_blank">
                                            {{ route('artist.show',$advertisement->id) }}
                                        </a>
                                    @else
                                        <a href="{{ route('professional.show',$advertisement->id) }}" target="_blank">
                                            {{ route('professional.show',$advertisement->id) }}
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('Editar anúncios')
                                    <a href="{{ route('dashboard.advertisement.edit', $advertisement->id) }}" class="btn btn-primary btn-circle edit" title="Editar anúncio"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @endcan
                                    @can('Excluir anúncios')
                                    <a href="{{ route('dashboard.advertisement.destroy', $advertisement->id) }}" class="btn btn-danger btn-circle" title="Excluir anúncio"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Por favor confirme"
                                        data-confirm-text="Tem certeza que deseja excluir esse anúncio?"
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
                        {{ $advertisements->links() }}
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
        $("#tipo").change(function () {
            $("#ads-form").submit();
        });
    </script>
@stop
