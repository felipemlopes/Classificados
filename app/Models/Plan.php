<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','price'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */


    /*
   |--------------------------------------------------------------------------
   | RELATIONS
   |--------------------------------------------------------------------------
   */
    public function subscriptions()
    {
        return $this->hasMany('App\Models\PlanSubscription','plan_id');
    }

    public function features()
    {
        return $this->hasMany('App\Models\PlanFeature','plan_id');
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
    public function setPriceAttribute($value) {
        $aux = str_replace(".", "", $value);
        $aux = str_replace(",", ".", $aux);
        $this->attributes['price'] = $aux;
    }


}
