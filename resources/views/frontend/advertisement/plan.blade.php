@extends('frontend.layouts.masterteste')


@section('content')
    <div class="container divplano">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 15px;">
                <h1 class="text-center">Selecione o tipo de anuncio que você deseja</h1>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 15px;">
                @include('partials.messages')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box" style="padding-bottom: 10px;">
                <form action="{{route('advertisement.finish',$advertisement->id)}}" method="post">
                    <div class="">
                            @csrf
                            <table class="table table-hover">
                                <tr>
                                    <td class="text-left">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="plantype" value="1">
                                                Anúncio grátis por {{setting('days_ads_free')}} dias
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        R$ 0,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="plantype" value="2">
                                                Anúncio em destaque por {{setting('days_ads_premium')}} dias
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        R${{setting('price_ads_premium')}}
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('advertisement.edit',$advertisement->id) }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
