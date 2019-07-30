<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','embedded_type','embedded_id','estado_id','cidade_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertisements';

    protected $dates = [
        'created_at',
        'updated_at',
    ];








    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */
    public function getType()
    {
        if($this->embedded_type=='App\Models\Artist'){
            return 'Artista';
        }elseif($this->embedded_type=='App\Models\Professional'){
            return 'Profissional';
        }else{
            return '-';
        }
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

    public function embedded()
    {
        return $this->morphTo();
    }
    public function musicalstyles()
    {
        return $this->morphTo()->musicalstyles();
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cidade', 'cidade_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id');
    }


    /*
   |--------------------------------------------------------------------------
   | SCOPES
   |--------------------------------------------------------------------------
   */
    public function scopeArtist($query)
    {
        return $query->where('embedded_type', '=', 'App\Models\Artist');
    }

    public function scopeProfessional($query)
    {
        return $query->where('embedded_type', '=', 'App\Models\Professional');
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
