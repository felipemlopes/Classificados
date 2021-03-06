<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\myaccount\AssinaturaRequest;
use App\Http\Requests\Frontend\myaccount\UpdateAdvertisementImageRequest;
use App\Http\Requests\Frontend\myaccount\UpdateAdvertisementRequest;
use App\Http\Requests\Frontend\myaccount\UpdateDetailsRequest;
use App\Http\Requests\Frontend\myaccount\UpdateLoginDetailsRequest;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Message;
use App\Models\MusicStyle;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanSubscription;
use App\models\User;
use App\Support\PagamentoStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use PagSeguroRecorrente;

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::where('user_id','=',Auth::User()->id)->count();
        $messages = Message::Unseen()->whereHas('conversation', function (Builder $query) {
            $query->orwhere('sender_id',  Auth::User()->id);
            $query->orwhere('advertiser_id',  Auth::User()->id);
        })->count();

        return view('frontend.myaccount.index', compact('advertisements','messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {

        return view('frontend.myaccount.settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settingsupdate(UpdateDetailsRequest $request)
    {
        $user = User::find(Auth::User()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->withSuccess('Configurações atualizadas com sucesso!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settingsupdatepassword(UpdateLoginDetailsRequest $request)
    {
        $user = User::find(Auth::User()->id);
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->withSuccess('Configurações atualizadas com sucesso!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function advertisement()
    {
        $peer_page = 15;
        $search = Input::get('search');
        $type = Input::get('tipo');
        $advertisements = Advertisement::Query();
        $advertisements = $advertisements->where('user_id',Auth::User()->id);
        if ($search <> "") {
            $advertisements->orwhereHasMorph('embedded','*', function (Builder $query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            });
            $advertisements->orwhereHasMorph('embedded','*', function (Builder $query) use ($search) {
                $query->where('description', 'like', "%{$search}%");
            });
        }
        if($type <> ""){
            if($type==1){
                $advertisements->Artist();
            }elseif($type==2){
                $advertisements->Professional();
            }

        }
        $advertisements = $advertisements->paginate($peer_page);
        if ($search) {
            $advertisements->appends(['search' => $search]);
        }
        if ($type) {
            $advertisements->appends(['tipo' => $type]);
        }
        return view('frontend.myaccount.advertisement', compact('advertisements'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementEdit($id)
    {
        $edit = true;
        $publish = false;
        $advertisement = Advertisement::find($id);
        if($advertisement->user_id!=Auth::User()->id){
            return redirect()->back();
        }

        if($advertisement->embedded_type=="App\Models\Artist"){
            $estilos=MusicStyle::all();
            $estados = Estado::all();
            $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();
            return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement','estilos',
                'estados','cidades','publish'));
        }else{
            $categorias = Category::where('parent_id','=',null)->get();
            $subcategorias = Category::where('parent_id','=',$advertisement->embedded->category_id)->get();
            $estados = Estado::all();
            $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();
            return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement',
                'estados','cidades','categorias','subcategorias','publish'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementUpdate(UpdateAdvertisementRequest $request, $id)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement->user_id!=Auth::User()->id){
            return redirect()->back();
        }

        $advertisement->estado_id = $request->estado;
        $advertisement->cidade_id = $request->cidade;
        $advertisement->suspended = false;
        $advertisement->save();

        if($advertisement->embedded_type=="App\Models\Artist"){
            $embedded = $advertisement->embedded;
            $embedded->title = $request->title;
            $embedded->description = $request->description;
            $embedded->cache = $request->cache;
            $embedded->video = $request->videoyoutube;
            $embedded->facebook = $request->facebook;
            $embedded->instagram = $request->instagram;
            $embedded->youtube = $request->youtube;
            $embedded->save();
            $embedded->musicalstyles()->sync($request->estilos);
        }else{
            $embedded = $advertisement->embedded;
            $embedded->title = $request->title;
            $embedded->description = $request->description;
            $embedded->category_id = $request->categoria;
            $embedded->subcategory_id = $request->subcategoria;
            $embedded->facebook = $request->facebook;
            $embedded->instagram = $request->instagram;
            $embedded->youtube = $request->youtube;
            $embedded->save();
        }


        return redirect()->back()->withSuccess('Anúncio atualizado com sucesso!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementUpdateImage(UpdateAdvertisementImageRequest $request, $id)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement->user_id!=Auth::User()->id){
            return redirect()->back();
        }
        $embedded = $advertisement->embedded;
        $aux = $embedded->imagepath;
        $file = Input::file('foto');
        $path = '';
        if($file){
            $path = Storage::disk('public_uploads')->put('/', $file);
            $embedded->imagepath = $path;
            Storage::disk('public_uploads')->delete($aux);
        }
        if($advertisement->embedded_type=="App\Models\Professional"){
            $aux2 = $advertisement->embedded->imagepath2;
            $aux3 = $advertisement->embedded->imagepath3;
            $aux4 = $advertisement->embedded->imagepath4;
            $aux5 = $advertisement->embedded->imagepath5;

            $file2 = Input::file('foto2');
            $path2 = '';
            if($file2){
                $path2 = Storage::disk('public_uploads')->put('/', $file2);
                $embedded->imagepath2 = $path2;
                Storage::disk('public_uploads')->delete($aux2);
            }

            $file3 = Input::file('foto3');
            $path3 = '';
            if($file3){
                $path3 = Storage::disk('public_uploads')->put('/', $file3);
                $embedded->imagepath3 = $path3;
                Storage::disk('public_uploads')->delete($aux3);
            }
            $file4 = Input::file('foto4');
            $path4 = '';
            if($file4){
                $path4 = Storage::disk('public_uploads')->put('/', $file4);
                $embedded->imagepath4 = $path4;
                Storage::disk('public_uploads')->delete($aux4);
            }
            $file5 = Input::file('foto5');
            $path5 = '';
            if($file5){
                $path5 = Storage::disk('public_uploads')->put('/', $file5);
                $embedded->imagepath5 = $path5;
                Storage::disk('public_uploads')->delete($aux5);
            }

        }
        $embedded->save();

        return redirect()->back()->withSuccess('Anúncio atualizado com sucesso!');
    }


    public function advertisementPay($id)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement->user_id!=Auth::User()->id){
            return redirect()->back();
        }
        $valor = setting('price_ads_premium');
        $valor = str_replace(",", ".", $valor);

        return view('frontend.advertisement.pagar', compact('advertisement','valor'));

    }

    public function plan()
    {
        $planos = Plan::all();

        return view('frontend.myaccount.plan', compact('planos'));
    }

    public function planSubscribe($id)
    {
        $plano = Plan::find($id);

        return view('frontend.myaccount.plansubscribe', compact('plano'));
    }

    public function planSubscribePost(AssinaturaRequest $request,$id)
    {
        $plano = Plan::find($id);
        $reference = md5(str_random(15) . microtime());

        $pagseguro = PagSeguroRecorrente::setReference($reference)
            ->setPlan($plano->reference)
            ->setSenderInfo([
                'senderName' => (String)$request->senderName,
                'senderPhone' => (String)$request->senderPhone, //Qualquer formato, desde que tenha o DDD
                'senderEmail' => (String)$request->senderEmail,
                'senderHash' => (String)$request->senderHash,
                'senderCPF' => (String)$request->senderCPF //Ou senderCNPJ se for Pessoa Júridica
            ])
            ->setCreditCardHolder([
                'creditCardHolderName' => (String)$request->creditCardHolderName, //OPCIONAL, se não passar ele usa o que for passado no senderName
                'creditCardHolderBirthDate' => (String)$request->creditCardHolderBirthDate, //Deve estar nesse formato,
                'creditCardHolderPhone' => (String)$request->senderPhone, //OPCIONAL, se não passar ele usa o que for passado no senderPhone
                'creditCardHolderCPF' => (String)$request->creditCardHolderCPF //OPCIONAL, se não passar ele usa o que for passado no senderCPF, se for Jurídica tem que passar
            ])
            ->setSenderAddress([
                'senderAddressStreet' => (String)$request->billingAddressStreet,
                'senderAddressNumber' => (String)$request->billingAddressNumber,
                'senderAddressComplement' => (String)$request->billingAddressComplement, // OPCIONAL
                'senderAddressDistrict' => (String)$request->billingAddressDistrict,
                'senderAddressPostalCode' => (String)$request->billingAddressPostalCode,
                'senderAddressCity' => (String)$request->billingAddressCity,
                'senderAddressState' => (String)$request->billingAddressState
            ])
            ->sendPreApproval([
                'creditCardToken' => (String)$request->creditCardToken
            ]);
        $response = (array)$pagseguro;

        $subscription = new PlanSubscription();
        $subscription->plan_id = $plano->id;
        $subscription->user_id = Auth::User()->id;
        $subscription->charging_price = $plano->price;
        $subscription->is_recurring = true;
        $subscription->reference = $response[0];
        $subscription->status = 'PENDING';
        $subscription->save();

        $pagamento = new Payment();
        $pagamento->paymentable_type = 'App\Models\PlanSubscription';
        $pagamento->paymentable_id = $subscription->id;
        $pagamento->reference = $reference;
        $pagamento->price = $plano->price;
        $pagamento->status = PagamentoStatus::AGUARDANDOPAGAMENTO;
        $pagamento->save();

        return redirect()->route('checkout.sucess');
    }

    public function planCancel()
    {
        $user = Auth::User();
        $subscription = $user->currentSubscription()->first();

        $response = (array)PagSeguroRecorrente::cancelPreApproval($subscription->reference);
        if($response['status']=="ok"){
            $subscription->is_paid = false;
            $subscription->cancelled_on = Carbon::now();
            $subscription->save();
            return redirect()->route('myaccount.plan')->withSuccess('Plano cancelado com sucesso!');
        }

        return redirect()->back()->withErrors('Ocorreu um erro ao tentar cancelar o plano, tente novamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementDelete($id)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement->user_id!=Auth::User()->id){
            return redirect()->back();
        }
        $advertisement->delete();

        return redirect()->route('myaccount.advertisement')->withSuccess('Anúncio excluido com sucesso!');
    }

    public function payments()
    {
        $setting_peerpage = setting('peer_page');
        $peer_page = $setting_peerpage == 0?12:$setting_peerpage;
        $type = Input::get('tipo');

        $payments = Payment::whereHasMorph('paymentable',
            ['App\Models\Advertisement', 'App\Models\PlanSubscription'],
            function (Builder $query) {
            $query->where('user_id', Auth::User()->id);
        });
        if($type <> ""){
            if($type==1){
                $payments->where('paymentable_type','App\Models\Advertisement');
            }elseif($type==2){
                $payments->where('paymentable_type','App\Models\PlanSubscription');
            }

        }
        $payments = $payments->orderBy('created_at', 'desc')->paginate($peer_page);
        if ($type) {
            $payments->appends(['tipo' => $type]);
        }

        return view('frontend.myaccount.payments', compact('payments'));
    }

    public function advertisementPublish($id)
    {
        $edit = true;
        $publish = true;
        $advertisement = Advertisement::find($id);
        if($advertisement->user_id!=Auth::User()->id){
            return redirect()->back();
        }

        if($advertisement->embedded_type=="App\Models\Artist"){
            $estilos=MusicStyle::all();
            $estados = Estado::all();
            $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();
            return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement','estilos',
                'estados','cidades','publish'));
        }else{
            $categorias = Category::where('parent_id','=',null)->get();
            $subcategorias = Category::where('parent_id','=',$advertisement->embedded->category_id)->get();
            $estados = Estado::all();
            $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();
            return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement',
                'estados','cidades','categorias','subcategorias','publish'));
        }
    }
}
