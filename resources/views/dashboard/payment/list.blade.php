@extends('dashboard.layouts.master')

@section('page-title', 'Pagamentos')
@section('content_header')
<h1>
    Pagamentos
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Pagamentos</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="paymentform">
        <div class="col-md-2 col-xs-4">
            <select name="status" id="status" class="form-control">
                <option value="">Status</option>
                <option value="1">Aguardando pagamento</option>
                <option value="2">Em análise</option>
                <option value="3">Pago</option>
                <option value="4">Disponível</option>
                <option value="5">Em disputa</option>
                <option value="6">Devolvido</option>
                <option value="7">Cancelado</option>
            </select>
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ app('request')->input('search') }}" placeholder="Procure por pagamentos...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-users-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (app('request')->input('search') != '')
                        <a href="{{ route('dashboard.payment.list') }}" class="btn btn-danger" type="button" >
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
                <h3 class="box-title">Lista de pagamentos cadastrados</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="users-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Referência</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Informações</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            @if (count($pagamentos))
                            @foreach ($pagamentos as $pagamento)
                            <tr>
                                <td>{{ $pagamento->reference }}</td>
                                <td>{{ $pagamento->price }}</td>
                                <td>{{ $pagamento->getType() }}</td>
                                <td>
                                    <a href="{{ $pagamento->getLink() }}" target="_blank">Link</a>
                                </td>
                                <td>{{ $pagamento->getStatus() }}</td>
                                <td class="text-center">
                                    @can('Visualizar pagamentos')
                                    <a href="{{ route('dashboard.payment.show', $pagamento->id) }}" class="btn btn-primary btn-circle edit" title="Visualizar pagamento"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-eye"></i>
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
                        {{ $pagamentos->links() }}
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
        $("#status").change(function () {
            $("#paymentform").submit();
        });
    </script>
@stop
