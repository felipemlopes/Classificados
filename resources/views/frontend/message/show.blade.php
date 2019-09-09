@extends('frontend.layouts.masterteste')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--<div class="container secao">
                <a href="{{ url()->previous() }}" class="btn btn-primary voltar">Voltar</a>
            </div>
            <div class="container secao">
                <h1 class="text-center">Mensagens</h1>
            </div>--}}

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box box-minhaconta box-mensagens" style="padding-bottom: 10px;">
                <div class="col-sm-12 col-md-12 col-lg-12 menu-minhaconta">
                    <ul class="list-inline text-center">
                        <li class="li-menuminhaconta">
                            <a href="{{ route('myaccount.index') }}" class="link-myaccount">
                                <i class="fa fa-home"></i> Minha conta</a>
                        </li>
                        <li class="li-menuminhaconta">
                            <a href="{{ route('message.index') }}" class="link-myaccount active">
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
                            <a href="{{ route('myaccount.settings') }}" class="link-myaccount">
                                <i class="fa fa-cog"></i> Configurações</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12 secao-minhaconta">
                    <div class="container secao">
                        <h3 class="text-center">Mensagens</h3>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-left" data-sort-ignore="true" colspan="3">
                                {{$conversation->advertisement->embedded->title}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="3">
                                <div class="text-left"><strong>Remetente Nome:</strong>
                                    {{$conversation->sender->first_name.' '.$conversation->sender->last_name}}
                                </div>
                                <hr>
                                <p class="text-left">{{$messages->first()->message}}</p>
                                <div class="text-left">
                                    Relacionado ao anúncio:
                                    @if($conversation->advertisement->embedded_type=='App\Models\Artist')
                                        <a href="{{route('artist.show',$conversation->advertisement->id)}}">Clique aqui para ver</a>
                                    @else
                                        <a href="{{route('professional.show',$conversation->advertisement->id)}}">Clique aqui para ver</a>
                                    @endif
                                </div>
                                <hr>
                                <div class="text-left">
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalmessage">
                                        <i class="icon-reply"></i>
                                        Resposta
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @foreach($messages as $message)
                            @if($messages->first()->id!=$message->id)
                                <tr>
                                    <td style="width:88%;">
                                        <div class="text-left" style="word-break:break-all;">
                                            <strong>
                                                <i class="icon-reply"></i>
                                                {{$message->user->first_name.' '.$message->user->last_name}}:
                                            </strong>
                                            <br>
                                            {{$message->message}}
                                            <br>
                                            <div class="text-left">
                                                Relacionado ao anúncio:
                                                @if($conversation->advertisement->embedded_type=='App\Models\Artist')
                                                    <a href="{{route('artist.show',$conversation->advertisement->id)}}">Clique aqui para ver</a>
                                                @else
                                                    <a href="{{route('professional.show',$conversation->advertisement->id)}}">Clique aqui para ver</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalmessage">
                                                <i class="icon-reply"></i>
                                                Resposta
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="modalmessage" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Fechar</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="icon-mail-2"></i>
                        Envie uma resposta
                    </h4>
                </div>
                <form role="form" method="POST" action="{{route('message.send',$conversation->advertisement_id)}}" id="formmessage">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group required ">
                            <label for="message" class="control-label">Mensagem
                            </label>
                            <textarea id="message" name="message" class="form-control required" placeholder="Sua mensagem..." rows="5"></textarea>
                        </div>
                        <input type="hidden" id="advertisement_id" value="{{$conversation->advertisement_id}}">
                    </div>
                </form>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary pull-right" id="sendmessage">Enviar mensagem</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        jQuery("#formmessage").submit(function(e){
            e.preventDefault();
        });
        jQuery('#sendmessage').on('click', function (e) {


            var advertisement = jQuery('#advertisement_id').val();
            var message = jQuery('#message').val();
            var csrftoken = jQuery('input[name=_token]').val();

            axios.post(`/mensagens/${advertisement}/send`, {
                _token: csrftoken,
                message: message,
            })
                .then(response => {
                    jQuery('#message').val('');
                    jQuery('#modalmessage').modal('hide');
                    location.reload();
                })
                .catch(error => {
                });
        });
    </script>
@endsection
