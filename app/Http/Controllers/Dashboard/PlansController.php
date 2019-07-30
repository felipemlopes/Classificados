<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\plan\UpdatePlanRequest;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar planos')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $plans = Plan::with('subscriptions')->withCount(['subscriptions' => function (Builder $query) {
            $query->where('starts_on', '<', Carbon::now()->toDateTimeString());
            $query->where('expires_on', '>', Carbon::now());
        }]);
        if ($search <> "") {
            $plans->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }
        $plans = $plans->paginate($peer_page);
        if ($search) {
            $plans->appends(['search' => $search]);
        }
        //dd($plans,$plans[0]->subscriptions_count,$plans[1]->subscriptions_count);
        return view('dashboard.plan.list', compact('plans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($plan_id)
    {
        if(!Auth::user()->can('Editar planos')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $edit = true;
        $plan = Plan::find($plan_id);

        return view('dashboard.plan.edit',compact('edit', 'plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request, $plan_id)
    {
        if(!Auth::user()->can('Editar planos')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $plan = Plan::find($plan_id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->save();

        return redirect()->back()->withSuccess('Plano atualizado com sucesso!');
    }

}
