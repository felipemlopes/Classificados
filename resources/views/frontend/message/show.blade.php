@extends('frontend.layouts.masterteste')

@section('css')
@endsection

@section('content')
    <div class="container" style="padding-bottom: 50px !important;">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
        <h1 class="text-center">{{$conversation->advertisement->embedded->title}}</h1>
        <div id="chat" class="chat">
            <div class="messages">
                <ul>
                    @if($messages)
                        @foreach($messages as $message)
                            @if($message->user_id == Auth::User()->id)
                                <li class="sent">
                                    <p>{{$message->message}}</p>
                                </li>
                            @else
                                <li class="replies">
                                    <p>{{$message->message}}</p>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="message-input">
                <div class="wrap">
                    @if($conversation)
                        <form id="form-message">
                            <input type="text" id="message-input-form" name="message" class="form-control" placeholder="Digite a sua mensagem..." v-model="message"/>
                            @csrf
                            <input type="hidden" id="conversation_id" name="conversation" value="{{$conversation->id}}">
                            <button class="submit" onclick="submitMessage()"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        jQuery("#form-message").submit(function(e){
            e.preventDefault();
        });
        function submitMessage() {
            var message = jQuery('#message-input-form').val();
            var conversation = jQuery('#conversation_id').val();
            var csrftoken = jQuery('input[name=_token]').val();
            if(message.trim() == '') {
                return false;
            }
            jQuery('<li class="sent"><p>' + message + '</p></li>').appendTo(jQuery('.messages ul'));
            jQuery('.message-input input').val(null);
            jQuery(".messages").animate({ scrollTop: jQuery(document).height() }, "fast");

            axios.post(`${this.conversation}/send`, {
                _token: csrftoken,
                conversation: conversation,
                message: message,
            })
                .then(response => {
                })
                .catch(error => {
                });
            jQuery('#conversation_id').val(conversation);
        }
    </script>
@endsection
