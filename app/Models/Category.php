<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{



    public function Children()
    {
        return $this->hasMany('App\Models\Category','parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
}
