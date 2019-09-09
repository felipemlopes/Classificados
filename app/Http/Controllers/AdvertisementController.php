<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\Anuncio\CreateAnuncioRequest;
use App\Http\Requests\Frontend\Anuncio\CreateReviewRequest;
use App\Http\Requests\Frontend\Anuncio\PagarAnuncioRequest;
use App\Models\Advertisement;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\MusicStyle;
use App\Models\Payment;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PagSeguro;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estilos = MusicStyle::all();
        $estados = Estado::all();
        $categorias = Category::where('parent_id','=',null)->get();
        $edit=false;

        return view('frontend.advertisement.index', compact('estilos','estados','categorias','edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnuncioRequest $request)
    {
        /*if($request->type==1){
            if(!Auth::User()->canCreateAdvertisementArtist()){
                if(Auth::User()->hasActiveSubscription()){
                    return redirect()->back()->withErrors('Você atingiu o limite de anúncios ativos.');
                }else{
                    return redirect()->back()->withErrors('Você atingiu o limite de anúncios ativos, assine o plano empresarial para aumentar o limite');
                }
            }
        }else{
            if(!Auth::User()->canCreateAdvertisementProfessional()){
                if(Auth::User()->hasActiveSubscription()){
                    return redirect()->back()->withErrors('Você atingiu o limite de anúncios ativos.');
                }else{
                    return redirect()->back()->withErrors('Você atingiu o limite de anúncios ativos, assine o plano empresarial para aumentar o limite');
                }
            }
        }*/

        $type = $request->type;
        $file = Input::file('foto');
        $path = '';
        if($file){
            $path = Storage::disk('public_uploads')->put('/', $file);
        }
        if($type==1){
            $artist = new Artist();
            $artist->title = $request->title;
            $artist->description = $request->description;
            $artist->cache = $request->cache;
            $artist->video = $request->videoyoutube;
            $artist->facebook = $request->facebook;
            $artist->instagram = $request->instagram;
            $artist->youtube = $request->youtube;
            $artist->imagepath = $path;
            $artist->save();
            $artist->musicalstyles()->sync($request->estilos);

            $advertisement = new Advertisement();
            $advertisement->user_id = Auth::User()->id;
            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->embedded_type = 'App\Models\Artist';
            $advertisement->embedded_id = $artist->id;
            $advertisement->save();

            return redirect()->route('advertisement.plan',$advertisement->id);
        }else{
            $professional = new Professional();
            $professional->title = $request->title;
            $professional->description = $request->description;
            $professional->category_id = $request->categoria;
            $professional->subcategory_id = $request->subcategoria;
            $professional->facebook = $request->facebook;
            $professional->instagram = $request->instagram;
            $professional->youtube = $request->youtube;
            $professional->imagepath = $path;
            $file2 = Input::file('foto2');
            $path2 = '';
            if($file2){
                $path2 = Storage::disk('public_uploads')->put('/', $file2);
            }
            $file3 = Input::file('foto3');
            $path3 = '';
            if($file3){
                $path3 = Storage::disk('public_uploads')->put('/', $file3);
            }
            $file4 = Input::file('foto4');
            $path4 = '';
            if($file4){
                $path4 = Storage::disk('public_uploads')->put('/', $file4);
            }
            $file5 = Input::file('foto5');
            $path5 = '';
            if($file5){
                $path5 = Storage::disk('public_uploads')->put('/', $file5);
            }
            $professional->imagepath2 = $path2;
            $professional->imagepath3 = $path3;
            $professional->imagepath4 = $path4;
            $professional->imagepath5 = $path5;
            $professional->save();

            $advertisement = new Advertisement();
            $advertisement->user_id = Auth::User()->id;
            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->embedded_type = 'App\Models\Professional';
            $advertisement->embedded_id = $professional->id;
            $advertisement->save();

            return redirect()->route('advertisement.plan',$advertisement->id);
        }
    }

    public function plan($id)
    {
        $advertisement = Advertisement::find($id);

        return view('frontend.advertisement.plan', compact('advertisement'));
    }

    public function back($id)
    {
        $advertisement = Advertisement::find($id);
        $estilos = MusicStyle::all();
        $estados = Estado::all();
        $cidades = Cidade::where('estado_id','=',$advertisement->estado_id)->get();
        $categorias = Category::where('parent_id','=',null)->get();
        $categorias = Category::where('parent_id','=',null)->get();
        if($advertisement->embedded_type=='App\Models\Professional'){
            $subcategorias = Category::where('parent_id','=',$advertisement->embedded->category_id)->get();
        }else{
            $subcategorias=null;
        }

        $edit= true;

        return view('frontend.advertisement.index', compact('estilos','estados','cidades','categorias','subcategorias','edit','advertisement'));

    }

    public function choosePlan(Request $request,$id)
    {
        if($request->plantype==1){
            $advertisement = Advertisement::find($id);
            $advertisement->is_published = true;
            $advertisement->save();

            if($advertisement->embedded_type=="App\Models\Artist"){
                return redirect()->route('artist.index')->withSuccess('Anúncio criado com sucesso!');
            }else{
                return redirect()->route('professional.index')->withSuccess('Anúncio criado com sucesso!');
            }
        }elseif($request->plantype==2){
            $advertisement = Advertisement::find($id);
            $advertisement->is_published = true;
            $advertisement->is_featured = true;
            $advertisement->save();
            $valor = setting('price_ads_premium');
            $valor = str_replace(",", ".", $valor);

            return view('frontend.advertisement.pagar', compact('advertisement','valor'));
        }else{
            return redirect()->back()->withErrors('Selecione o tipo de anúncio!');
        }
    }

    public function update(CreateAnuncioRequest $request, $id)
    {
        $advertisement = Advertisement::find($id);

        $aux = $advertisement->embedded->imagepath;
        $file = Input::file('foto');
        $path = '';
        if($request->hasFile('foto')){
            $path = Storage::disk('public_uploads')->put('/', $file);
        }
        $type = $request->type;
        if($type==1 and $advertisement->embedded_type=="App\Models\Artist"){
            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->save();

            $artist = Artist::find($advertisement->embedded_id);
            $artist->title = $request->title;
            $artist->description = $request->description;
            $artist->cache = $request->cache;
            $artist->video = $request->videoyoutube;
            $artist->facebook = $request->facebook;
            $artist->instagram = $request->instagram;
            $artist->youtube = $request->youtube;
            if($path!=''){
                $artist->imagepath = $path;
            }
            $artist->save();
            $artist->musicalstyles()->sync($request->estilos);
            if($request->hasFile('foto')){
                Storage::disk('public_uploads')->delete($aux);
            }

            return redirect()->route('advertisement.plan',$advertisement->id);
        }elseif($type==2 and $advertisement->embedded_type=="App\Models\Professional"){
            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->save();

            $aux2 = $advertisement->embedded->imagepath2;
            $aux3 = $advertisement->embedded->imagepath3;
            $aux4 = $advertisement->embedded->imagepath4;
            $aux5 = $advertisement->embedded->imagepath5;

            $professional = Professional::find($advertisement->embedded_id);
            $professional->title = $request->title;
            $professional->description = $request->description;
            $professional->category_id = $request->categoria;
            $professional->subcategory_id = $request->subcategoria;
            $professional->facebook = $request->facebook;
            $professional->instagram = $request->instagram;
            $professional->youtube = $request->youtube;
            if($path!=''){
                $professional->imagepath = $path;
            }
            $file2 = Input::file('foto2');
            $path2 = '';
            if($file2){
                $path2 = Storage::disk('public_uploads')->put('/', $file2);
            }
            $file3 = Input::file('foto3');
            $path3 = '';
            if($file3){
                $path3 = Storage::disk('public_uploads')->put('/', $file3);
            }
            $file4 = Input::file('foto4');
            $path4 = '';
            if($file4){
                $path4 = Storage::disk('public_uploads')->put('/', $file4);
            }
            $file5 = Input::file('foto5');
            $path5 = '';
            if($file5){
                $path5 = Storage::disk('public_uploads')->put('/', $file5);
            }
            if($path2!=''){
                $professional->imagepath2 = $path2;
            }
            if($path3!=''){
                $professional->imagepath3 = $path3;
            }
            if($path4!=''){
                $professional->imagepath4 = $path4;
            }
            if($path5!=''){
                $professional->imagepath5 = $path5;
            }
            $professional->save();

            if($request->hasFile('foto')){
                Storage::disk('public_uploads')->delete($aux);
            }
            if($request->hasFile('foto2')){
                Storage::disk('public_uploads')->delete($aux2);
            }
            if($request->hasFile('foto3')){
                Storage::disk('public_uploads')->delete($aux3);
            }
            if($request->hasFile('foto4')){
                Storage::disk('public_uploads')->delete($aux4);
            }
            if($request->hasFile('foto5')){
                Storage::disk('public_uploads')->delete($aux5);
            }

            return redirect()->route('advertisement.plan',$advertisement->id);
        }elseif($type==1 and $advertisement->embedded_type=="App\Models\Professional"){
            $professional = Professional::find($advertisement->embedded_id);
            if($path==''){
                $path = $professional->imagepath;
            }
            $professional->delete();
            $artist = new Artist();
            $artist->title = $request->title;
            $artist->description = $request->description;
            $artist->cache = $request->cache;
            $artist->video = $request->videoyoutube;
            $artist->facebook = $request->facebook;
            $artist->instagram = $request->instagram;
            $artist->youtube = $request->youtube;
            $artist->imagepath = $path;
            $artist->save();
            $artist->musicalstyles()->sync($request->estilos);

            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->embedded_type='App\Models\Artist';
            $advertisement->embedded_id=$artist->id;
            $advertisement->save();

            return redirect()->route('advertisement.plan',$advertisement->id);
        }elseif($type==2 and $advertisement->embedded_type=="App\Models\Artist"){
            $artist = Artist::find($advertisement->embedded_id);
            if($path==''){
                $path = $artist->imagepath;
            }
            $artist->delete();
            $professional = new Professional();
            $professional->title = $request->title;
            $professional->description = $request->description;
            $professional->category_id = $request->categoria;
            $professional->subcategory_id = $request->subcategoria;
            $professional->facebook = $request->facebook;
            $professional->instagram = $request->instagram;
            $professional->youtube = $request->youtube;
            $professional->imagepath = $path;
            $file2 = Input::file('foto2');
            $path2 = '';
            if($file2){
                $path2 = Storage::disk('public_uploads')->put('/', $file2);
            }
            $file3 = Input::file('foto3');
            $path3 = '';
            if($file3){
                $path3 = Storage::disk('public_uploads')->put('/', $file3);
            }
            $file4 = Input::file('foto4');
            $path4 = '';
            if($file4){
                $path4 = Storage::disk('public_uploads')->put('/', $file4);
            }
            $file5 = Input::file('foto5');
            $path5 = '';
            if($file5){
                $path5 = Storage::disk('public_uploads')->put('/', $file5);
            }
            $professional->imagepath2 = $path2;
            $professional->imagepath3 = $path3;
            $professional->imagepath4 = $path4;
            $professional->imagepath5 = $path5;
            $professional->save();

            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->embedded_type='App\Models\Professional';
            $advertisement->embedded_id=$professional->id;
            $advertisement->save();

            return redirect()->route('advertisement.plan',$advertisement->id);
        }
    }

    public function pagar(PagarAnuncioRequest $request, $id)
    {
        $valor = setting('price_ads_premium');
        $valor = str_replace(",", ".", $valor);
        $anuncio = Advertisement::find($id);
        if($anuncio->is_featured!=true){
            $anuncio->is_published = true;
            $anuncio->is_featured = true;
            $anuncio->save();
        }

        $reference = md5(str_random(15) . microtime());
        $pagseguro = PagSeguro::setReference($reference)
            ->setSenderInfo([
                'senderName' => (String)$request->senderName, //Deve conter nome e sobrenome
                'senderPhone' => (String)$request->senderPhone, //Código de área enviado junto com o telefone
                'senderEmail' => (String)$request->senderEmail,
                'senderHash' => (String)$request->senderHash,
                'senderCPF' => (String)$request->senderCPF //Ou CNPJ se for Pessoa Júridica
            ])
            ->setCreditCardHolder([
                'creditCardHolderName' => (String)$request->creditCardHolderName, //Deve conter nome e sobrenome
                'creditCardHolderPhone' => (String)$request->senderPhone, //Código de área enviado junto com o telefone
                'creditCardHolderCPF' => (String)$request->creditCardHolderCPF, //Ou CNPJ se for Pessoa Júridica
                'creditCardHolderBirthDate' => (String)$request->creditCardHolderBirthDate,
            ])
            ->setBillingAddress([
                'billingAddressStreet' => (String)$request->billingAddressStreet,
                'billingAddressNumber' => (String)$request->billingAddressNumber,
                'billingAddressDistrict' => (String)$request->billingAddressDistrict,
                'billingAddressPostalCode' => (String)$request->billingAddressPostalCode,
                'billingAddressCity' => (String)$request->billingAddressCity,
                'billingAddressState' => (String)$request->billingAddressState
            ])
            ->setItems([
                [
                    'itemId' => (string)$anuncio->id,
                    'itemDescription' => 'Anúncio de classificados em destaque',
                    'itemAmount' => $valor, //Valor unitário
                    'itemQuantity' => '1',
                ],
            ])
            ->send([
                'paymentMethod' => 'creditCard',
                'creditCardToken' => (String)$request->creditCardToken,
                'installmentQuantity' => (String)$request->installmentQuantity,
                'installmentValue' => $request->installmentValue,
            ]);
        $response = (array)$pagseguro;

        $pagamento = new Payment();
        $pagamento->paymentable_type = 'App\Models\Advertisement';
        $pagamento->paymentable_id = $anuncio->id;
        $pagamento->reference = $reference;
        $pagamento->price = $valor;
        $pagamento->status = $response['status'];
        $pagamento->save();

        return redirect()->route('checkout.sucess');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReviewArtista(CreateReviewRequest $request,$id)
    {
        $artist = Advertisement::with('embedded')->Artist()
            ->where('id','=',$id)->first();
        $user = Auth::User();
        $rating = $artist->rating([
            'title' => $request->title,
            'body' => $request->body, //optional
            'anonymous' => 0, //optional
            'rating' => $request->rating,
        ], $user);

        return redirect()->route('artist.show',$artist->id)->withSuccess('Avaliação feita com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReviewProfessional(CreateReviewRequest $request,$id)
    {
        $professional = Advertisement::with('ratings','embedded')->Professional()
            ->where('id','=',$id)->first();
        $user = Auth::User();
        $rating = $professional->rating([
            'title' => $request->title,
            'body' => $request->body, //optional
            'anonymous' => 0, //optional
            'rating' => $request->rating,
        ], $user);

        return redirect()->route('professional.show',$professional->id)->withSuccess('Avaliação feita com sucesso!');
    }
}
