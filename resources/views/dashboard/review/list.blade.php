@extends('dashboard.layouts.master')

@section('page-title', 'Avaliações')
@section('content_header')
<h1>
    Avaliações
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Avaliações</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="categoryform">
        <div class="col-md-2 col-xs-4">
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ app('request')->input('search') }}" placeholder="Procure por avaliações...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-users-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (app('request')->input('search') != '')
                        <a href="{{ route('dashboard.review.list') }}" class="btn btn-danger" type="button" >
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
                <h3 class="box-title">Lista de avaliações</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="users-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Anúncio</th>
                                <th>Avaliação</th>
                                <th>Usuário</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            @if (count($reviews))
                            @foreach ($reviews as $review)
                            <tr>
                                <td>

                                    @if($review->reviewrateable->embedded_type=='App\Models\Artist')
                                        <a href="{{ route('artist.show',$review->reviewrateable->id) }}" target="_blank">
                                            <img class="thumbnail no-margin" src="{{asset('uploads/'.$review->reviewrateable->embedded->imagepath)}}" alt="img" style="width:50px;">
                                            <p>{{ route('artist.show',$review->reviewrateable->id) }}</p>
                                        </a>
                                    @else
                                        <a href="{{ route('professional.show',$review->reviewrateable->id) }}" target="_blank">
                                            <img class="thumbnail no-margin" src="{{asset('uploads/'.$review->reviewrateable->embedded->imagepath)}}" alt="img" style="width:50px;">
                                            <p>{{ route('professional.show',$review->reviewrateable->id) }}</p>
                                        </a>
                                    @endif


                                </td>
                                <td>
                                    <span style="font-weight: bold;">{{ $review->title }}</span>
                                    <p>{{ $review->body }}</p>
                                </td>
                                <td>
                                    <a href="{{route('dashboard.user.edit',$review->author->id)}}" target="_blank">
                                        {{ $review->author->email }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    @can('Editar reviews')
                                    <a href="{{ route('dashboard.review.edit', $review->id) }}" class="btn btn-primary btn-circle edit" title="Editar avaliação"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @endcan
                                    @can('Excluir reviews')
                                    <a href="{{ route('dashboard.review.destroy', $review->id) }}" class="btn btn-danger btn-circle" title="Excluir avaliação"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Por favor confirme"
                                        data-confirm-text="Tem certeza que deseja excluir essa avaliação?"
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
                        {{ $reviews->links() }}
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
