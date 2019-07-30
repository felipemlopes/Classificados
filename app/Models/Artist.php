<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title','description','cache','video','facebook',
        'instagram','youtube','imagepath'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */
    public function checkMusicStyle($style_id){
        $styles = ArtistMusicalStyle::where('artist_id',$this->id)->where('music_style_id',$style_id)->count();
        if($styles > 0){
            return true;
        }else{
            return false;
        }
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

    public function musicalstyles()
    {
        return $this->belongsToMany('App\Models\MusicStyle','artist_musical_styles');
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
    public function setCacheAttribute($value) {
        $aux = str_replace(".", "", $value);
        $aux = str_replace(",", ".", $aux);
        $this->attributes['cache'] = $aux;
    }
}
