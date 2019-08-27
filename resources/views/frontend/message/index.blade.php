@extends('frontend.layouts.masterteste')

@section('css')
@endsection

@section('content')
    <div class="container">

        <h1 class="text-center">Mensagens</h1>

        <ul class="list-notifications">
            @if(count($conversations))
                @foreach($conversations as $conversation)
                    <li class="notification">
                        <a href="{{route('message.show',$conversation->id)}}" class="notification-link">
                            <h6 class="notification-title">
                                <span>{{ $conversation->advertisement->embedded->title }} {{$conversation->hasUnseenMessages()?"| Nova mensagem":""}}</span>
                            </h6>
                            <p class="notification-desc">
                                @if($conversation->hasMessages())
                                    {{$conversation->messages->last()->message}}
                                @endif
                            </p>
                        </a>
                    </li>
                @endforeach
            @else
                <li class="text-center no-message">
                    <em>Você não possui mensagens</em>
                </li>
            @endif
        </ul>
    </div>
@endsection



@section('scripts')
@endsection
