<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id','advertiser_id','advertisement_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversations';

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /*
   |--------------------------------------------------------------------------
   | FUNCTIONS
   |--------------------------------------------------------------------------
   */
    public function hasMessages(){
        Return (bool) $this->messages()->count();
    }
    public function hasUnseenMessages(){
        Return (bool) $this->messages()->Unseen()->first();
    }
    public function countUnseenMessages(){
        Return (bool) $this->messages()->Unseen()->count();
    }
    public function seeAllUnseenMessages(){
        Return (bool) $this->messages()->Unseen()->update([
            'is_seen'=> true
        ]);
    }





    /*
   |--------------------------------------------------------------------------
   | RELATIONS
   |--------------------------------------------------------------------------
   */
    /*
     * make a relation between message
     *
     * return collection
     * */
    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'conversation_id')
            ->with('sender');
    }
    /*
     * make a relation between first user from conversation
     *
     * return collection
     * */
    public function sender()
    {
        return $this->belongsTo('App\Models\User',  'sender_id');
    }
    /*
   * make a relation between second user from conversation
   *
   * return collection
   * */
    public function advertiser()
    {
        return $this->belongsTo('App\Models\User',  'advertiser_id');
    }

    public function advertisement()
    {
        return $this->belongsTo('App\Models\Advertisement',  'advertisement_id');
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
