@extends('frontend.layouts.masterteste')

@section('page_name', 'Pagar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container secao">
                <a href="{{ url()->previous() }}" class="btn btn-primary voltar">Voltar</a>
            </div>
            <div class="container secao">
                @include('partials/messages')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box" style="padding-bottom: 10px">
                <div class="">
                    <form action="{{route('advertisement.plan.pay',$advertisement->id)}}" method="post" id="form">
                @csrf
                <input type="hidden" name="itemAmount1" value="{{ $valor }}">
                <input type="hidden" name="senderHash" id="senderHash">

                <div class="col-md-offset-2 col-md-8 secao">
                    <h2 class="text-center">Métodos de pagamento</h2>
                    <div id="payment_methods" class="center-align text-center">
                        <img src="{{asset('assets/images/bandeiras-pagseguro.png')}}" style="height: 150px;">
                    </div>
                </div>


                <div class="col-md-offset-2 col-md-8">
                    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <h3 class="col-xs-12 col-sm-12 col-md-12">Preço: R${{ $valor }}</h3>
                    </div>

                    <h4 class="text-center">
                        <p>
                            <b>Preencha suas informações</b>
                        </p>
                    </h4>
                    <div class="">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-md-12 form-group">
                                <label class="control-label" for="senderName">
                                    Nome completo<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" id="senderName" name="senderName">
                                </div>
                            </div>
                        </div>
                        @if(config('pagseguro.sandbox'))
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-md-12 form-group">
                                    <label class="control-label" for="senderEmail">
                                        Email<strong class="text-danger"> *</strong>
                                    </label>
                                    <div class="">
                                        <input type="text" class="form-control" id="senderEmail" name="senderEmail" value="">
                                    </div>
                                </div>
                            </div>
                        @else
                            <input type="hidden" class="form-control" id="senderEmail" name="senderEmail" value="{{Auth::User()->email}}">
                        @endif
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-md-12 form-group">
                                <label class="control-label" for="senderPhone">
                                    Telefone<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" id="senderPhone" name="senderPhone">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-md-12 form-group">
                                <label class="control-label" for="senderCPF">
                                    CPF<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" id="senderCPF" name="senderCPF">
                                </div>
                            </div>
                        </div>

                    </div>

                    <h4 class="text-center">
                        <p>
                            <b>Informaçõesde pagamento</b>
                        </p>
                    </h4>

                    <div>
                        <input type="hidden" name="creditCardToken" id="creditCardToken">
                        <input type="hidden" name="installmentValue" id="installmentValue">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                <label class="control-label" for="creditCardHolderName">
                                    Nome impresso no cartão<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" id="creditCardHolderName" name="creditCardHolderName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                <label class="control-label" for="cardNumber">
                                    Número do cartão<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                                </div>
                                <div id="card_brand">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                <label class="control-label">
                                    Data de validade<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <select class="form-control col-sm-2 selectpicker" id="expirationMonth" name="expirationMonth" style="margin-left:5px;">
                                                <option value="">Mês</option>
                                                @for($m = 1; $m <= 12; $m++)
                                                    <option value="{{ (strlen($m) == 1) ? '0' . $m : $m }}">{{ (strlen($m) == 1) ? '0' . $m : $m }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-xs-6">
                                            <select class="form-control selectpicker" id="expirationYear" name="expirationYear">
                                                <option value="">Ano</option>
                                                @for($y = date("Y"); $y <= date("Y")+30; $y++)
                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-sm-7 form-group">
                                <label class="control-label" for="cvv">
                                    Código de segurança<strong class="text-danger"> *</strong>
                                </label>
                                <div class="">
                                    <input type="text" class="form-control" id="cvv" name="cvv">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>CPF do Titular<strong class="text-danger"> *</strong></label>
                                    <input type="text" id="creditCardHolderCPF" name="creditCardHolderCPF" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Data de Nasc. do Titular<strong class="text-danger"> *</strong></label>
                                    <input type="text" id="creditCardHolderBirthDate" name="creditCardHolderBirthDate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Parcelas<strong class="text-danger"> *</strong></label>
                                    <select name="installmentQuantity" id="installmentQuantity" class="form-control">
                                        <option value="" selected>Parcelamento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <h4 class="text-center">
                        <p>
                            <b>Endereço da fatura</b>
                        </p>
                    </h4>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressPostalCode">
                                CEP<strong class="text-danger"> *</strong>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressPostalCode" name="billingAddressPostalCode" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressStreet">
                                Rua<strong class="text-danger"> *</strong>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressStreet" name="billingAddressStreet">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressNumber">
                                Número<strong class="text-danger"> *</strong>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressNumber" name="billingAddressNumber">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressComplement">
                                Complemento
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressComplement" name="billingAddressComplement">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressDistrict">
                                Bairro<strong class="text-danger"> *</strong>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressDistrict" name="billingAddressDistrict">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressState">
                                Estado<strong class="text-danger"> *</strong>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressState" name="billingAddressState">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="billingAddressCity">
                                Cidade<strong class="text-danger"> *</strong>
                            </label>
                            <div class="">
                                <input type="text" class="form-control" id="billingAddressCity" name="billingAddressCity">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a onclick="pagar()" class="btn btn-success btn-lg btn-block">
                            Pagar
                        </a>
                    </div>

                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    @if (env('PAGSEGURO_SANDBOX')=='true')
        <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    @else
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    @endif

    <script src="{{asset('/js/jquery.mask.min.js')}}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#billingAddressPostalCode').mask('00000-000');
            jQuery('#senderPhone').mask('(00)00000-0000');
            jQuery('#creditCardHolderBirthDate').mask('00/00/0000');
            jQuery('#senderCPF').mask('000.000.000-00', {reverse: true});
            jQuery('#creditCardHolderCPF').mask('000.000.000-00', {reverse: true});
        });
    </script>
    <script src="/js/pagseguro.js"></script>
    <script>
        const paymentData = {
            brand: '',
            amount: {{ $valor }},
        };

        PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');

        /*pagSeguro.getPaymentMethods(paymentData.amount)
            .then(function (urls) {
                let html = '';
                urls.forEach(function (url) {
                    html += '<img src="' + url + '" class="credit_card">'
                });
                jQuery('#payment_methods').html(html);
            });*/
        /*PagSeguroDirectPayment.getPaymentMethods({
            amount: 500.00,
            success: function(response) {
                // Retorna os meios de pagamento disponíveis.
            },
            error: function(response) {
                // Callback para chamadas que falharam.
            },
            complete: function(response) {
                // Callback para todas chamadas.
            }
        });*/



        jQuery('#senderName').on('change', function () {
            pagSeguro.getSenderHash().then(function(data) {
                jQuery('#senderHash').val(data);
            })
        });

        jQuery('#billingAddressPostalCode').on('change', function () {
            let cep = jQuery(this).val();
            cep = cep.replace("-", "");
            if (cep.length == 8) {
                jQuery.get('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(function (res) {
                        jQuery('#billingAddressDistrict').val(res.bairro);
                        jQuery('#billingAddressCity').val(res.localidade);
                        jQuery('#billingAddressStreet').val(res.logradouro);
                        jQuery('#billingAddressState').val(res.uf);
                    })
            }
        });

        jQuery('#cardNumber').on('change', function() {
            if (jQuery(this).val().length >= 6) {
                let bin = jQuery(this).val();
                PagSeguroDirectPayment.getBrand({
                    cardBin: 411111,
                    success: function(response) {
                        paymentData.brand = response.brand.name;
                        let url = 'https://stc.pagseguro.uol.com.br//public/img/payment-methods-flags/42x20/';
                        jQuery('#card_brand').html('<img src="' + url+response.brand.name+'.png' + '" class="credit_card">')
                        PagSeguroDirectPayment.getInstallments({
                            amount: paymentData.amount,
                            maxInstallmentNoInterest: 0,
                            brand: response.brand.name,
                            success: function(response){
                                let html = '';
                                response.installments[paymentData.brand].forEach(function (item) {
                                    html = html + '<option value="' + item.quantity + '">' + item.quantity + 'x R$' + item.installmentAmount + ' - total R$' + item.totalAmount + '</option>';
                                });
                                jQuery('#installmentQuantity').html(html);
                                jQuery('#installmentValue').val(response.installments[paymentData.brand][0].installmentAmount);
                                jQuery('#installmentQuantity').on('change', function () {
                                    let value = response[jQuery('#installmentQuantity').val() - 1].installmentAmount;
                                    jQuery('#installmentValue').val(value);
                                });
                            },
                            error: function(response) {
                            },
                            complete: function(response){
                            }
                        });
                    },
                    error: function(response) {
                    },
                    complete: function(response) {
                    }
                });
            }
        });

        function pagar(){
            gerarCreditToken();
        }
        function gerarCreditToken(){
            PagSeguroDirectPayment.createCardToken({
                cardNumber: jQuery("input#cardNumber").val(),
                brand: paymentData.brand,
                cvv: jQuery("input#cvv").val(),
                expirationMonth: jQuery("#expirationMonth option:selected").val(),
                expirationYear: jQuery("#expirationYear option:selected").val(),
                success: function(response) {
                    jQuery('#creditCardToken').val(response.card.token);
                    jQuery( "#cardNumber" ).prop( "disabled", true );
                    jQuery( "#expirationMonth" ).prop( "disabled", true );
                    jQuery( "#expirationYear" ).prop( "disabled", true );
                    jQuery( "#cvv" ).prop( "disabled", true );
                    jQuery('#form').submit();
                },
                error: function(response) {
                },
                complete: function(response) {
                }
            });
        }
    </script>
@endsection
