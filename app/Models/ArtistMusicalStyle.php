<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistMusicalStyle extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','artist_id','music_style_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artist_musical_styles';

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
    public function musicstyle()
    {
        return $this->belongsTo('App\Models\MusicStyle', 'music_style_id');
    }

    public function artist()
    {
        return $this->belongsTo('App\Models\Artist', 'artist_id');
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
