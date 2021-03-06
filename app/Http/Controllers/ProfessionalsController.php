<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Cidade;
use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProfessionalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting_peerpage = setting('peer_page');
        $peer_page = $setting_peerpage == 0?12:$setting_peerpage;
        $category= Input::get('categoria');
        $subcategory= Input::get('subcategoria');
        $state= Input::get('estado');
        $city= Input::get('cidade');
        $qtd_destaque = setting('qtd_ads_destaque');

        $professionals = Advertisement::Professional()->Published()->NotSuspended();
        $destaques = Advertisement::Professional()->Published()->Featured()->Paid()->NotSuspended();
        /*$destaques = $destaques->whereHas('user', function (Builder $query) {
            $query->whereHas('subscriptions', function (Builder $query) {
                $query->where('starts_on', '<', Carbon::now());
                $query->where('expires_on', '>', Carbon::now());
                $query->where('plan_id', '=', 2);
            });
        });*/
        if ($category <> "") {
            $professionals->whereHasMorph('embedded','App\Models\Professional',
                function ($q) use ($category,$subcategory) {
                $q->where('category_id', "=", $category);
                    if ($subcategory <> "") {
                        $q->where('subcategory_id', "=", $subcategory);
                    }
            });
            $destaques->whereHasMorph('embedded','App\Models\Professional',
                function ($q) use ($category,$subcategory) {
                    $q->where('category_id', "=", $category);
                    if ($subcategory <> "") {
                        $q->where('subcategory_id', "=", $subcategory);
                    }
                });
        }
        if ($state <> "") {
            $professionals->where(function ($q) use ($state) {
                $q->where('estado_id', "=", "%{$state}%");
            });
            $destaques->where(function ($q) use ($state) {
                $q->where('estado_id', "=", "%{$state}%");
            });
        }
        if ($city <> "") {
            $professionals->where(function ($q) use ($city) {
                $q->where('cidade_id', "=", "%{$city}%");
            });
            $destaques->where(function ($q) use ($city) {
                $q->where('cidade_id', "=", "%{$city}%");
            });
        }
        $destaques = $destaques->take($qtd_destaque)->inRandomOrder()->get();
        $array = [];
        foreach ($destaques as $key=>$destaque){
            $array[$key]= $destaque->id;
        }
        $professionals = $professionals->orderBy('created_at', 'desc')->whereNotIn('id', $array)->paginate($peer_page);

        if ($category) {
            $professionals->appends(['categoria' => $category]);
        }
        if ($subcategory) {
            $professionals->appends(['subcategoria' => $subcategory]);
        }
        if ($state) {
            $professionals->appends(['estado' => $state]);
        }
        if ($city) {
            $professionals->appends(['cidade' => $city]);
        }

        $categories = Category::where('parent_id','=',null)->get();
        $subcategories = null;
        if ($category) {
            $subcategories = Category::where('parent_id','=',$category)->get();
        }
        $states=Estado::all();
        $cities=Cidade::where('estado_id','=',$state)->get();

        return view('frontend.professionals.index', compact('categories','subcategories',
            'states', 'cities','professionals','destaques'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professional = Advertisement::with('ratings','embedded')->Professional()
            ->where('id','=',$id)->first();
        $professional->increment('visits');
        $professional->save();

        return view('frontend.professionals.show', compact('professional'));
    }
}
