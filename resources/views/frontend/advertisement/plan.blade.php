@extends('frontend.layouts.master')


@section('content')
    <div class="row">

        <h1 class="text-center">Deseja destacar o seu naúncio?</h1>
        <div class="text-center">
            <p>Pelo valor de R${{setting('price_ads_premium')}}</p>
            <p>por {{setting('days_ads_premium')}} dias</p>
        </div>
        <div class="text-center">
            <a href="{{ route('advertisement.edit.plan.yes',$advertisement->id) }}" class="btn btn-primary">Sim</a>
            <a href="{{ route('advertisement.edit.plan.no',$advertisement->id) }}" class="btn btn-primary">Não</a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
