<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{



    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
}
