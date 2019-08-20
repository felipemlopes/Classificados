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
        return view('frontend.myaccount.index', compact('advertisements'));
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
        $advertisement = Advertisement::find($id);

        if($advertisement->embedded_type=="App\Models\Artist"){
            $estilos=MusicStyle::all();
            $estados = Estado::all();
            $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();
            return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement','estilos',
                'estados','cidades'));
        }else{
            $categorias = Category::where('parent_id','=',null)->get();
            $subcategorias = Category::where('parent_id','=',$advertisement->embedded->category_id)->get();
            $estados = Estado::all();
            $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();
            return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement',
                'estados','cidades','categorias','subcategorias'));
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
        $advertisement->estado_id = $request->estado;
        $advertisement->cidade_id = $request->cidade;
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
        $embedded = $advertisement->embedded;
        $aux = $embedded->imagepath;
        $file = Input::file('foto');
        $path = '';
        if($file){
            $path = Storage::disk('public_uploads')->put('/', $file);
        }
        $embedded->imagepath = $path;
        $embedded->save();
        Storage::disk('public_uploads')->delete($aux);

        return redirect()->back()->withSuccess('Anúncio atualizado com sucesso!');
    }


    public function advertisementPay($id)
    {
        $advertisement = Advertisement::find($id);
        $valor = setting('price_ads_premium');
        $valor = str_replace(",", ".", $valor);

        return view('frontend.advertisement.pagar', compact('advertisement','valor'));

    }

    public function plan()
    {
        $plano = Plan::first();

        return view('frontend.myaccount.plan', compact('plano'));
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
        }
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
        $advertisement->delete();

        return redirect()->route('myaccount.advertisement')->withSuccess('Anúncio excluido com sucesso!');
    }


}
