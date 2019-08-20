<?php

namespace App\Observers;

use App\Models\Advertisement;
use App\Models\Payment;
use App\Models\PlanSubscription;
use Carbon\Carbon;

class PagamentoObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Models\Payment  $pagamento
     * @return void
     */
    public function created(Payment $pagamento)
    {
        //
    }

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Models\Payment  $pagamento
     * @return void
     */
    public function updated(Payment $pagamento)
    {

        if($pagamento->paymentable_type=="App\Models\Advertisement"){
            $dias = setting('days_ads_premium');
            $data = Carbon::now()->addDays($dias);
            $anuncio = Advertisement::find($pagamento->recurso_id);
            if($pagamento->status==3){
                $anuncio->is_paid = true;
                $anuncio->featured_until = $data;
                $anuncio->save;
            }
            if($pagamento->status==4){
                $anuncio->is_paid = true;
                $anuncio->featured_until = $data;
                $anuncio->save;
            }
        }
        if($pagamento->paymentable_type=="App\Models\PlanSubscription"){
            if($pagamento->status==2){
                $subscription = PlanSubscription::find($pagamento->paymentable_id);
                $subscription->is_paid = true;
                $subscription->save();
            }
            if($pagamento->status==3){
                $subscription = PlanSubscription::find($pagamento->paymentable_id);
                $subscription->is_paid = true;
                $subscription->save();
            }
        }

    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Models\Payment  $pagamento
     * @return void
     */
    public function deleted(Payment $pagamento)
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Models\Payment  $pagamento
     * @return void
     */
    public function restored(Payment $pagamento)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $pagamento
     * @return void
     */
    public function forceDeleted(Payment $pagamento)
    {
        //
    }
}