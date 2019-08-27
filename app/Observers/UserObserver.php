<?php

namespace App\Observers;

use App\Models\Advertisement;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $conversations = Conversation::where(
            function ($query) use ($user) {
                $query->where(
                    function ($q) use ($user) {
                        $q->where('user_two', Auth::User()->id);
                    }
                )
                    ->orWhere(
                        function ($q) use ($user) {
                            $q->where('user_one', Auth::User()->id);
                        }
                    );
            }
        )->delete();

        $advertisements = Advertisement::where('user_id', Auth::User()->id)->delete();

    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
