<?php

namespace App\Providers;

use App\Models\Payment;
use App\Models\PlanSubscription;
use App\Observers\PagamentoObserver;
use App\Observers\PlanSubscriptionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        PlanSubscription::observe(PlanSubscriptionObserver::class);
        Payment::observe(PagamentoObserver::class);
    }
}
