<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title','description','category_id','facebook',
        'instagram','youtube','imagepath'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professionals';

    protected $dates = [
        'created_at',
        'updated_at',
    ];




    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */
    public function hasSocialNetworks()
    {
        return (bool) $this->facebook!="" or $this->instagram!="" or $this->youtube!=""? true: false;
    }


    /*
   |--------------------------------------------------------------------------
   | RELATIONS
   |--------------------------------------------------------------------------
   */
    public function embedded()
    {
        return $this->morphOne('App\Models\Advertisement', 'embedded');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Category', 'subcategory_id');
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


}
