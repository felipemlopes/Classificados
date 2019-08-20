<?php

namespace App\models;

use App\Notifications\CustomResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password','last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }


    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */
    public function canCreateAdvertisementArtist()
    {
        if($this->hasActiveSubscription()){
            $premium = Plan::first();
            $qtd_ads_art = PlanFeature::where('plan_id',$premium->id)->where('name','qtd_ads_art')->first();
            $count = Advertisement::where('user_id',$this->id)->Artist()->Published()->count();
        }else{
            $qtd_ads_art = setting('qtd_ads_artist_freeaccount');
            $count = Advertisement::where('user_id',$this->id)->Artist()->Published()->count();
        }
        if($count<$qtd_ads_art){
            return true;
        }else{
            return false;
        }
    }

    public function canCreateAdvertisementProfessional()
    {
        if($this->hasActiveSubscription()){
            $premium = Plan::first();
            $qtd_ads_pro = PlanFeature::where('plan_id',$premium->id)->where('name','qtd_ads_pro')->first();
            $count = Advertisement::where('user_id',$this->id)->Professional()->Published()->count();
        }else{
            $qtd_ads_pro = setting('qtd_ads_pro_freeaccount');
            $count = Advertisement::where('user_id',$this->id)->Professional()->Published()->count();
        }
        if($count<$qtd_ads_pro){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Check if the mode has a due, unpaid subscription.
     *
     * @return bool
     */
    public function hasDueSubscription()
    {
        return (bool) $this->lastDueSubscription();
    }
    /**
     * Check if the model has an specific active subscription right now.
     *
     * @return bool Wether the binded model has an active subscription or not.
     */
    public function hasActivePlan($plan_id)
    {
        return (bool) $this->currentSubscription()->paid()->notCancelled()->where('plan_id','=',$plan_id)->first();
    }
    /**
     * Check if the model has subscriptions.
     *
     * @return bool Wether the binded model has subscriptions or not.
     */
    public function hasSubscriptions()
    {
        return (bool) ($this->subscriptions()->count() > 0);
    }
    /**
     * Check if the model has an active subscription right now.
     *
     * @return bool Wether the binded model has an active subscription or not.
     */
    public function hasActiveSubscription()
    {
        return (bool) $this->activeSubscription();
    }
    /**
     * Return the current subscription relatinship.
     *
     */
    public function currentSubscription()
    {
        return $this->subscriptions()
            ->where('starts_on', '<', Carbon::now())
            ->where('expires_on', '>', Carbon::now());
    }
    /**
     * Return the current active subscription.
     *
     */
    public function activeSubscription()
    {
        return $this->currentSubscription()->paid()->notCancelled()->first();
    }
    /**
     * Get the last active subscription.
     *
     */
    public function lastActiveSubscription()
    {
        if (! $this->hasSubscriptions()) {
            return;
        }
        if ($this->hasActiveSubscription()) {
            return $this->activeSubscription();
        }
        return $this->subscriptions()->latest('starts_on')->paid()->notCancelled()->first();
    }
    /**
     * Get the last subscription.
     *
     */
    public function lastSubscription()
    {
        if (! $this->hasSubscriptions()) {
            return;
        }
        if ($this->hasActiveSubscription()) {
            return $this->activeSubscription();
        }
        return $this->subscriptions()->latest('starts_on')->first();
    }
    /**
     * Get the last unpaid subscription, if any.
     *
     */
    public function lastUnpaidSubscription()
    {
        return $this->subscriptions()->latest('starts_on')->notCancelled()->unpaid()->first();
    }

    /**
     * When a subscription is due, it means it was created, but not paid.
     * For example, on subscription, if your user wants to subscribe to another subscription and has a due (unpaid) one, it will
     * check for the last due, will cancel it, and will re-subscribe to it.
     *
     * @return null|PlanSubscription Null or a Plan Subscription instance.
     */
    public function lastDueSubscription()
    {
        if (! $this->hasSubscriptions()) {
            return;
        }
        if ($this->hasActiveSubscription()) {
            return;
        }
        $lastActiveSubscription = $this->lastActiveSubscription();
        if (! $lastActiveSubscription) {
            return $this->lastUnpaidSubscription();
        }
        $lastSubscription = $this->lastSubscription();
        if ($lastActiveSubscription->is($lastSubscription)) {
            return;
        }
        return $this->lastUnpaidSubscription();
    }


    public function extendCurrentSubscriptionWith(int $duration = 30, bool $startFromNow = true, bool $isRecurring = true)
    {
        if (! $this->hasActiveSubscription()) {
            if ($this->hasSubscriptions()) {
                $lastActiveSubscription = $this->lastActiveSubscription();
                $lastActiveSubscription->load(['plan']);
                return $this->subscribeTo($lastActiveSubscription->plan, $duration, $isRecurring);
            }
            return $this->subscribeTo(Plan::first(), $duration, $isRecurring);
        }
        if ($duration < 1) {
            return false;
        }
        $activeSubscription = $this->activeSubscription();
        if ($startFromNow) {
            $activeSubscription->update([
                'expires_on' => Carbon::parse($activeSubscription->expires_on)->addDays($duration),
            ]);
            //event(new \Rennokki\Plans\Events\ExtendSubscription($this, $activeSubscription, $startFromNow, null));
            return $activeSubscription;
        }
        $subscriptionModel = 'App\Models\PlanSubscription';
        $subscription = $this->subscriptions()->save(new $subscriptionModel([
            'plan_id' => $activeSubscription->plan_id,
            'starts_on' => Carbon::parse($activeSubscription->expires_on),
            'expires_on' => Carbon::parse($activeSubscription->expires_on)->addDays($duration),
            'cancelled_on' => null,
            'payment_method' => ($this->subscriptionPaymentMethod) ?: null,
            'is_recurring' => $isRecurring,
        ]));
        //event(new \Rennokki\Plans\Events\ExtendSubscription($this, $activeSubscription, $startFromNow, $subscription));
        return $subscription;
    }

    public function unextendCurrentSubscriptionWith(int $duration = 30, bool $startFromNow = true, bool $isRecurring = true)
    {
        if (! $this->hasActiveSubscription()) {
            if ($this->hasSubscriptions()) {
                $lastActiveSubscription = $this->lastActiveSubscription();
                $lastActiveSubscription->load(['plan']);
                return $this->subscribeTo($lastActiveSubscription->plan, $duration, $isRecurring);
            }
            return $this->subscribeTo(Plan::first(), $duration, $isRecurring);
        }
        if ($duration < 1) {
            return false;
        }
        $activeSubscription = $this->activeSubscription();
        if ($startFromNow) {
            $activeSubscription->update([
                'expires_on' => Carbon::parse($activeSubscription->expires_on)->subDays($duration),
            ]);
            //event(new \Rennokki\Plans\Events\ExtendSubscription($this, $activeSubscription, $startFromNow, null));
            return $activeSubscription;
        }
        $subscriptionModel = 'App\Models\PlanSubscription';
        $subscription = $this->subscriptions()->save(new $subscriptionModel([
            'plan_id' => $activeSubscription->plan_id,
            'starts_on' => Carbon::parse($activeSubscription->expires_on),
            'expires_on' => Carbon::parse($activeSubscription->expires_on)->subDays($duration),
            'cancelled_on' => null,
            'payment_method' => ($this->subscriptionPaymentMethod) ?: null,
            'is_recurring' => $isRecurring,
        ]));
        //event(new \Rennokki\Plans\Events\ExtendSubscription($this, $activeSubscription, $startFromNow, $subscription));
        return $subscription;
    }

    /**
     * Subscribe the binded model to a plan. Returns false if it has an active subscription already.
     * @param Plan $plan The Plan model instance.
     * @param int $duration The duration, in days, for the subscription.
     * @param bool $isRecurring Wether the subscription should auto renew every $duration days.
     * @return PlanSubscription The PlanSubscription model instance.
     * @throws \Exception
     */
    public function subscribeTo($plan, int $duration = 30, bool $isRecurring = true)
    {
        $subscriptionModel = 'App\Models\PlanSubscription';
        if ($duration < 1 || $this->hasActiveSubscription()) {
            return false;
        }
        if ($this->hasDueSubscription()) {
            $this->lastDueSubscription()->delete();
        }
        $subscription = $this->subscriptions()->save(new $subscriptionModel([
            'plan_id' => $plan->id,
            'starts_on' => Carbon::now()->subSeconds(1),
            'expires_on' => Carbon::now()->addDays($duration),
            'cancelled_on' => null,
            'payment_method' => ($this->subscriptionPaymentMethod) ?: null,
            'is_paid' => (bool) ($this->subscriptionPaymentMethod) ? false : true,
            'charging_price' => ($this->chargingPrice) ?: $plan->price,
            'is_recurring' => $isRecurring,
        ]));
        if ($this->subscriptionPaymentMethod == 'paypal') {
            try {
                //$stripeCharge = $this->chargeWithStripe(($this->chargingPrice) ?: $plan->price, ($this->chargingCurrency) ?: $plan->currency);
                $subscription->update([
                    'is_paid' => true,
                ]);
                //event(new \Rennokki\Plans\Events\Stripe\ChargeSuccessful($this, $subscription, $stripeCharge));
            } catch (\Exception $exception) {
                //event(new \Rennokki\Plans\Events\Stripe\ChargeFailed($this, $subscription, $exception));
            }
        }
        //event(new \Rennokki\Plans\Events\NewSubscription($this, $subscription));
        return $subscription;
    }

    /*
   |--------------------------------------------------------------------------
   | RELATIONS
   |--------------------------------------------------------------------------
   */
    public function advertisements()
    {
        return $this->hasMany('App\Models\Advertisement','user_id');
    }

    /**
     * Get Subscriptions relatinship.
     *subscriptions
     */
    public function subscriptions()
    {
        return $this->hasMany('App\Models\PlanSubscription','user_id');
    }



    /*
   |--------------------------------------------------------------------------
   | SCOPES
   |--------------------------------------------------------------------------
   */

    /*
   |--------------------------------------------------------------------------
   | ACCESORS
   |--------------------------------------------------------------------------
   */

    /*
   |--------------------------------------------------------------------------
   | MUTATORS
   |--------------------------------------------------------------------------
   */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
}
