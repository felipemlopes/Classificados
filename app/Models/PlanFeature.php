<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','plan_id','name','limit'
    ];

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
}
