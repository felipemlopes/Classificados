<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PlanSubscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','plan_id','user_id','payment_method','is_paid','starts_on','expires_on','cancelled_on'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plan_subscriptions';

    protected $dates = [
        'created_at',
        'updated_at',
        'starts_on',
        'expires_on',
        'cancelled_on',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'is_recurring' => 'boolean',
    ];



    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */
    /**
     * Cancel this subscription.
     *
     * @return self $this
     */
    public function cancel()
    {
        $this->update([
            'cancelled_on' => Carbon::now(),
        ]);
        return $this;
    }
    /**
     * Checks if the current subscription has started.
     *
     * @return bool
     */
    public function hasStarted()
    {
        return (bool) Carbon::now()->greaterThanOrEqualTo(Carbon::parse($this->starts_on));
    }
    /**
     * Checks if the current subscription has expired.
     *
     * @return bool
     */
    public function hasExpired()
    {
        return (bool) Carbon::now()->greaterThan(Carbon::parse($this->expires_on));
    }
    /**
     * Checks if the current subscription is cancelled (expiration date is in the past & the subscription is cancelled).
     *
     * @return bool
     */
    public function isCancelled()
    {
        return (bool) $this->cancelled_on != null;
    }
    /**
     * Checks if the current subscription is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool) ($this->hasStarted() && ! $this->hasExpired());
    }
    /**
     * Checks if the current subscription is pending cancellation.
     *
     * @return bool
     */
    public function isPendingCancellation()
    {
        return (bool) ($this->isCancelled() && $this->isActive());
    }
    /**
     * Get the remaining days in this subscription.
     *
     * @return int
     */
    public function remainingDays()
    {
        if ($this->hasExpired()) {
            return (int) 0;
        }
        return (int) Carbon::now()->diffInDays(Carbon::parse($this->expires_on));
    }


    /*
   |--------------------------------------------------------------------------
   | RELATIONS
   |--------------------------------------------------------------------------
   */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }

    public function paymentable()
    {
        return $this->morphOne('App\Models\Payment', 'paymentable');
    }


    /*
   |--------------------------------------------------------------------------
   | SCOPES
   |--------------------------------------------------------------------------
   */
    public function scopeCancelled($query)
    {
        return $query->whereNotNull('cancelled_on');
    }
    public function scopeNotCancelled($query)
    {
        return $query->whereNull('cancelled_on');
    }
    public function scopePaid($query)
    {
        return $query->where('is_paid', true);
    }
    public function scopeUnpaid($query)
    {
        return $query->where('is_paid', false);
    }
    public function scopeExpired($query)
    {
        return $query->where('expires_on', '<', Carbon::now()->toDateTimeString());
    }
    public function scopeActive($query)
    {
        return $query->where('starts_on', '<', Carbon::now()->toDateTimeString())->where('expires_on', '>', Carbon::now());
    }


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

}
