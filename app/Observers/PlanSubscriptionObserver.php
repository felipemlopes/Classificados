<?php

namespace App\Observers;

use App\Models\PlanSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PlanSubscriptionObserver
{
    /**
     * Handle the plan subscription "created" event.
     *
     * @param  \App\Models\PlanSubscription  $planSubscription
     * @return void
     */
    public function created(PlanSubscription $planSubscription)
    {
        //
    }

    /**
     * Handle the plan subscription "updated" event.
     *
     * @param  \App\Models\PlanSubscription  $planSubscription
     * @return void
     */
    public function updated(PlanSubscription $planSubscription)
    {
        if($planSubscription->status=="ACTIVE"){
            $planSubscription->starts_on = Carbon::now();
            $planSubscription->expires_on = Carbon::now()->addDays(30);
            $planSubscription->is_paid = true;
            $planSubscription->save();
        }
        if($planSubscription->status=="PENDING"){
            $planSubscription->is_paid = false;
            $planSubscription->save();
        }
        if($planSubscription->status=="SUSPENDED"){
            $planSubscription->is_paid = false;
            $planSubscription->save();
        }
        if($planSubscription->status=="CANCELLED"){
            $planSubscription->is_paid = false;
            $planSubscription->cancelled_on = Carbon::now();
            $planSubscription->save();
        }
        if($planSubscription->status=="CANCELLED_BY_RECEIVER"){
            $planSubscription->is_paid = false;
            $planSubscription->cancelled_on = Carbon::now();
            $planSubscription->save();
        }
        if($planSubscription->status=="CANCELLED_BY_SENDER"){
            $planSubscription->is_paid = false;
            $planSubscription->cancelled_on = Carbon::now();
            $planSubscription->save();
        }
    }

    /**
     * Handle the plan subscription "deleted" event.
     *
     * @param  \App\Models\PlanSubscription  $planSubscription
     * @return void
     */
    public function deleted(PlanSubscription $planSubscription)
    {
        //
    }

    /**
     * Handle the plan subscription "restored" event.
     *
     * @param  \App\Models\PlanSubscription  $planSubscription
     * @return void
     */
    public function restored(PlanSubscription $planSubscription)
    {
        //
    }

    /**
     * Handle the plan subscription "force deleted" event.
     *
     * @param  \App\Models\PlanSubscription  $planSubscription
     * @return void
     */
    public function forceDeleted(PlanSubscription $planSubscription)
    {
        //
    }
}
