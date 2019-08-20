@extends('frontend.layouts.master')


@section('css')
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                <ul class="list-inline text-center">
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.index') }}" class="link-myaccount">
                            <i class="fa fa-home"></i> Minha conta</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.advertisement') }}" class="link-myaccount active">
                            <i class="fa fa-tags"></i> Anúncios</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.plan') }}" class="link-myaccount">
                            <i class="fa fa-credit-card"></i> Plano</a>
                    </li>
                    <li class="li-menuminhaconta">
                        <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                            <i class="fa fa-cog"></i> Configurações</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">


                <div class="row tab-search">
                    <div class="col-md-2 col-xs-2">
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
                                        <span class="fa fa-search"></span>
                                    </button>
                                    @if (app('request')->input('search') != '' || app('request')->input('tipo')!='')
                                            <a href="{{ route('myaccount.advertisement') }}" class="btn btn-danger" type="button" >
                                                <span class="fa fa-remove"></span>
                                            </a>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

                @include('partials.messages')

                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Link</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    @if (count($advertisements))
                        @foreach ($advertisements as $advertisement)
                            <tr>
                                <td>{{ $advertisement->embedded->title }}</td>
                                <td>{{ $advertisement->getType() }}</td>
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
                                    <a href="{{ route('myaccount.advertisement.edit', $advertisement->id) }}" class="btn btn-primary btn-circle edit" title="Editar anúncio"
                                       data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('myaccount.advertisement.delete', $advertisement->id) }}" class="btn btn-danger btn-circle" title="Excluir anúncio"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="Por favor confirme"
                                       data-confirm-text="Tem certeza que deseja excluir esse anúncio?"
                                       data-cancel-text="Tem certeza que deseja excluir esse anúncio?"
                                       data-confirm-delete="Sim">
                                        <i class="fa fa-remove"></i>
                                    </a>
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
@endsection


@section('scripts')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/delete.handler.js') }}"></script>
    <script>
        $("#tipo").change(function () {
            $("#ads-form").submit();
        });
    </script>
@endsection
