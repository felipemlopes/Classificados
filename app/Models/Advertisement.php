<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Trexology\ReviewRateable\Contracts\ReviewRateable;
use Trexology\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;

class Advertisement extends Model implements ReviewRateable
{
    use ReviewRateableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','embedded_type','embedded_id','estado_id','cidade_id', 'suspended'
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
    public function isActiveFeatured()
    {
        if($this->is_published==true and $this->is_paid==true and $this->is_featured==true
            and $this->featured_until > Carbon::now()){
            return true;
        }else{
            return false;
        }
    }

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

    public function getRating(){
        $staro = '<i class="fa fa-star-o staro"></i>';
        $star = '<i class="fa fa-star star"></i>';
        $aux = 5 - $this->averageRating();
        $rating = '';
        for($i = 1; $i <= $this->averageRating(); $i++){
            $rating = $rating.$star;
        }

        if($aux != 0){
            for($i = 1; $i <= $aux; $i++){
                $rating = $rating.$staro;
            }
        }
        return $rating;
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

    public function paymentable()
    {
        return $this->morphOne('App\Models\Payment', 'paymentable');
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

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('featured_until','>',Carbon::now());
    }

    public function scopeUnfeatured($query)
    {
        return $query->where('is_featured', false);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', true);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('is_paid', false);
    }

    public function scopeSuspended($query)
    {
        return $query->where('suspended', true);
    }

    public function scopeNotSuspended($query)
    {
        return $query->where('suspended', false);
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
