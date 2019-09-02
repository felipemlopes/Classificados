<div class="panel panel-default">
    <div class="panel-heading">Detalhes do pagamento</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Referência</label>
                    <span>{{$pagamento->reference}}</span>
                </div>
                <div class="form-group">
                    <label for="name">Valor</label>
                    <span>{{$pagamento->price}}</span>
                </div>
                <div class="form-group">
                    <label for="name">Status</label>
                    <span>{{$pagamento->getStatus()}}</span>
                </div>
                <div class="form-group">
                    <label for="name">Data</label>
                    <span>{{$pagamento->created_at}}</span>
                </div>
                @if($pagamento->paymentable_type=='App\Models\Advertisement')
                    <div class="form-group">
                        <label for="name">Título do anúncio</label>
                        <span>{{$pagamento->paymentable->embedded->title}}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Foto do anúncio</label>
                        <img class="thumbnail no-margin" src="{{asset('uploads/'.$pagamento->paymentable->embedded->imagepath)}}" alt="img" style="height:186px;">
                    </div>
                @else
                    <div class="form-group">
                        <label for="name">Nome do usuário</label>
                        <span>{{$pagamento->paymentable->user->first_name .' '. $pagamento->paymentable->user->last_name}}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Email do usuário</label>
                        <span>{{$pagamento->paymentable->user->email}}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
