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
        'user_one','user_two','advertisement_id'
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
    public function userone()
    {
        return $this->belongsTo('App\Models\User',  'user_one');
    }
    /*
   * make a relation between second user from conversation
   *
   * return collection
   * */
    public function usertwo()
    {
        return $this->belongsTo('App\Models\User',  'user_two');
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
