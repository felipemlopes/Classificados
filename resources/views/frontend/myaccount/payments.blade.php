@extends('frontend.layouts.masterteste')


@section('css')
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box box-minhaconta">
                <div class="col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                    <ul class="list-inline text-center">
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.index') }}" class="link-myaccount">
                                <i class="fa fa-home"></i> Minha conta</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('message.index') }}" class="link-myaccount">
                                <i class="fa fa-envelope"></i> Mensagens</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.advertisement') }}" class="link-myaccount">
                                <i class="fa fa-tags"></i> Anúncios</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.plan') }}" class="link-myaccount">
                                <i class="fa fa-credit-card"></i> Plano</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.payments') }}" class="link-myaccount active">
                                <i class="fa fa-usd"></i> Pagamentos</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                                <i class="fa fa-cog"></i> Configurações</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">
                    <div class="row tab-search secao">
                        <form method="GET" action="" accept-charset="UTF-8" id="payment-form">
                            <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 col-md-offset-10 col-lg-offset-10" style="margin-bottom: 10px;">
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="">Tipo</option>
                                    <option value="1" {{app('request')->input('tipo')==1?'selected':''}}>Anúncios</option>
                                    <option value="2" {{app('request')->input('tipo')==2?'selected':''}}>Plano</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    @include('partials.messages')

                    <table class="table table-hover table-striped">
                        <tbody>
                        <tr>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Data</th>
                        </tr>
                        @if (count($payments))
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>
                                        @if($payment->paymentable_type=='App\Models\Advertisement')
                                            <p>Anúncio em destaque</p>
                                        @else
                                            <span>Plano {{$payment->paymentable->plan->name}}</span>
                                        @endif
                                    </td>
                                    <td>R${{ $payment->price }}</td>
                                    <td class="text-center">
                                        {{ date('d/m/Y', strtotime($payment->created_at)) }}
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
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        jQuery("#tipo").change(function () {
            jQuery("#payment-form").submit();
        });
    </script>
@endsection
