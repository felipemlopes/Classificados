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
                            <a href="{{ route('myaccount.payments') }}" class="link-myaccount">
                                <i class="fa fa-usd"></i> Pagamentos</a>
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

                    <table class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th class="text-left" style="width:88%">Conversas</th>
                            <th style="width:10%">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($conversations))
                            @foreach($conversations as $conversation)
                                <tr>
                                    <td class="text-left">
                                        <div style="word-break:break-all;">
                                            <strong>Recebido em:</strong> {{ date('d/m/Y H:i', strtotime(Auth::User()->created_at)) }}
                                            <br>
                                            <strong>Assunto:</strong> {{$conversation->advertisement->embedded->title}}
                                            <br>
                                            <strong>Começado por:</strong> {{$conversation->sender->first_name.' '.$conversation->sender->last_name}}
                                        </div>
                                    </td>
                                    <td class="action-td">
                                        <div>
                                            <p>
                                                <a class="btn btn-primary btn-sm" href="{{route('message.show',$conversation->id)}}">
                                                    <i class="icon-eye"></i> Ver </a>
                                            </p>
                                            <p>
                                                <a class="btn btn-secondary btn-sm excluir" id="deletebtn{{$conversation->id}}"
                                                   onclick="deleteads({{$conversation->id}})" href="{{route('conversation.delete',$conversation->id)}}">
                                                    <i class="fa fa-trash"></i> Deletar
                                                </a>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td>
                                    <em>Você não possui mensagens</em>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="container">
                        <div class="row">
                            <div class="text-center">
                                {{ $conversations->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
    <script>
        jQuery('.excluir').click(function(e){
            e.preventDefault();
        });
        function deleteads(id){
            swal({
                title: 'Você tem certeza?',
                text: "Isso vai excluir permanentemente a conversa !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then(function(teste) {
                if(teste.value){
                    window.location.href = jQuery('#deletebtn'+id).attr('href');
                }else{
                }
            })
        }
    </script>
@endsection
