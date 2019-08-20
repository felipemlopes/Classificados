@extends('frontend.layouts.master')

@section('page_name', 'Recurso')

@section('content')
    <div class="row">
        <div class="col-sm-offset-1 col-md-offset-1 col-sm-10 col-md-10 login-box">

            <h3 class="text-center">
                Pagamento realizado com sucesso!
            </h3>

            <p class="text-center">
                <img src="{{asset('assets/images/PagSeguro1.png')}}" alt="">
            </p>

        </div>
    </div>
@stop
