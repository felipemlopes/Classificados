<?php

namespace App\Observers;

use App\Models\Conversation;
use App\Models\Message;
use App\models\User;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        $conversation = Conversation::find($message->conversation_id);
        if($conversation){
            if($message->user_id==$conversation->user_one){
                $user = User::find($conversation->user_two);
                $user->notify(new \App\Notifications\Message($message));
            }else{
                $user = User::find($conversation->user_one);
                $user->notify(new \App\Notifications\Message($message));
            }
        }
    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
