@extends('frontend.layouts.masterteste')

@section('page_name', 'Recurso')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box">

                <h3 class="text-center">
                    Pagamento realizado com sucesso!
                </h3>

                <p class="text-center">
                    <img src="{{asset('assets/images/PagSeguro1.png')}}" alt="">
                </p>

            </div>
        </div>
    </div>
@stop
