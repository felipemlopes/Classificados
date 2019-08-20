@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')
        <div class="content col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;padding-left: 0;padding-right: 0; height: 100%;">
            <div class="col-sm-5 col-md-4 col-lg-4 topsidebar" style="margin: 0;padding-left: 0;padding-right: 0;">
                <div id="contacts">
                    <ul>
                        @if($conversations)
                            @foreach($conversations as $c)
                                @if($conversation)
                                    @if($c->id==$conversation->id)
                                        <li class="contact active">
                                        <a href="{{route('message.show',$conversation->id)}}">
                                            <div class="wrap">
                                                <div class="meta">
                                                    @if($conversation->user_one==Auth::User()->id)
                                                        <p class="name">
                                                            {{$conversation->usertwo->first_name.' '.$conversation->usertwo->last_name}}
                                                            @if($conversation->hasUnseenMessages())
                                                                <span class="badge">{{$conversation->countUnseenMessages()}}</span>
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p class="name">
                                                            {{$conversation->userone->first_name.' '.$conversation->userone->last_name}}
                                                            @if($conversation->hasUnseenMessages())
                                                                <span class="badge">{{$conversation->countUnseenMessages()}}</span>
                                                            @endif
                                                        </p>
                                                    @endif
                                                    @if($conversation->messages->last())
                                                        <p class="preview">{{$conversation->messages->last()->message}}</p>
                                                    @else
                                                        <p class="preview">...</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @else
                                        @if($c->messages->last())
                                        <li class="contact">
                                            <a href="{{route('message.show',$c->id)}}">
                                                <div class="wrap">
                                                    <div class="meta">
                                                        @if($c->user_one==Auth::User()->id)
                                                            <p class="name">
                                                                {{$c->usertwo->first_name.' '.$c->usertwo->last_name}}
                                                                @if($c->hasUnseenMessages())
                                                                    <span class="badge">{{$c->countUnseenMessages()}}</span>
                                                                @endif
                                                            </p>
                                                        @else
                                                            <p class="name">
                                                                {{$c->userone->first_name.' '.$c->userone->last_name}}
                                                                @if($c->hasUnseenMessages())
                                                                    <span class="badge">{{$c->countUnseenMessages()}}</span>
                                                                @endif
                                                            </p>
                                                        @endif
                                                        <p class="preview">{{$c->messages->last()->message}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                    @endif
                                @else
                                    @if($c->messages->last())
                                        <li class="contact">
                                            <a href="{{route('message.show',$c->id)}}">
                                                <div class="wrap">
                                                    <div class="meta">
                                                        @if($c->user_one==Auth::User()->id)
                                                            <p class="name">
                                                                {{$c->usertwo->first_name.' '.$c->usertwo->last_name}}
                                                                @if($c->hasUnseenMessages())
                                                                    <span class="badge">{{$c->countUnseenMessages()}}</span>
                                                                @endif
                                                            </p>
                                                        @else
                                                            <p class="name">
                                                                {{$c->userone->first_name.' '.$c->userone->last_name}}
                                                                @if($c->hasUnseenMessages())
                                                                    <span class="badge">{{$c->countUnseenMessages()}}</span>
                                                                @endif
                                                            </p>
                                                        @endif
                                                        <p class="preview">{{$c->messages->last()->message}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div id="frame" class="col-sm-7 col-md-8 col-lg-8" style="margin: 0;">
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
                        <form id="form-message" @submit.prevent="">
                            <input type="text" name="message" placeholder="Escreva a sua mensagem..." v-model="message"/>
                            @csrf
                            <input type="hidden" name="conversation" value="{{$conversation->id}}">
                            <button class="submit" @click="submitMessage()"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection



@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
