<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Conversation;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index()
    {

        $user = Auth::User();
        $conversations = Conversation::with('advertisement', 'advertisement.embedded','messages')->where(
            function ($query) use ($user) {
                $query->where(
                    function ($q) use ($user) {
                        $q->where('advertiser_id', $user->id);
                    }
                )
                    ->orWhere(
                        function ($q) use ($user) {
                            $q->where('sender_id', $user->id);
                        }
                    );
            }
        );
        $conversations = $conversations->has('messages')->paginate(15);

        return view('frontend.message.index', compact('conversations'));
    }

    public function show($id)
    {
        $conversation = Conversation::where('id','=',$id)->firstOrFail();
        if($conversation){
            $messages = $conversation->messages;
        }else{
            return redirect()->back();
        }
        $advertisement = Advertisement::where('id','=',$conversation->advertisement_id)->firstOrFail();
        if(!$advertisement){
            return redirect()->back();
        }
        $conversation->seeAllUnseenMessages();

        return view('frontend.message.show', compact('messages','conversation'));
    }

    public function send(Request $request,$id)
    {
        $advertisement = Advertisement::where('id','=',$id)->firstOrFail();
        if(!$advertisement){
            return false;
        }
        $advertiser = User::find($advertisement->user_id);
        $sender = Auth::User();

        $conversation = Conversation::with('messages')->where(
            function ($query) use ($advertiser, $sender) {
                $query->orwhere(
                    function ($q) use ($advertiser, $sender) {
                        $q->where('sender_id', $advertiser->id)
                            ->where('advertiser_id', $sender->id);
                    }
                )
                    ->orWhere(
                        function ($q) use ($advertiser, $sender) {
                            $q->where('sender_id', $sender->id)
                                ->where('advertiser_id', $advertiser->id);
                        }
                    );
            }
        )->where('advertisement_id','=',$id)->first();

        $messages = null;
        if($conversation){
            $messages = $conversation->messages;
        }else{
            $conversation = new Conversation();
            $conversation->advertisement_id = $advertisement->id;
            $conversation->sender_id = Auth::User()->id;
            $conversation->advertiser_id = $advertisement->user_id;
            $conversation->save();
        }

        $user_id = Auth::User()->id;
        $message = new Message();
        $message->user_id = $user_id;
        $message->conversation_id = $conversation->id;
        $message->message = $request->message;
        $message->save();

        if($message->user_id!=$conversation->sender_id){
            $usernotify = User::find($conversation->sender_id);
            $usernotify->notify(new \App\Notifications\Message($message));
        }else{
            $usernotify = User::find($conversation->advertiser_id);
            $usernotify->notify(new \App\Notifications\Message($message));
        }
        return response()->json(['message'=>$message]);
    }

    public function delete($id){
        $conversation = Conversation::find($id);
        if($conversation->sender_id==Auth::User()->id or $conversation->advertiser_id==Auth::User()->id){
            $conversation->delete();
            return redirect()->route('message.index')->withSuccess('Conversa excluida com sucesso!');
        }else{
            return redirect()->route('message.index')->withErrors('Você não pode excluir essa conversa!');
        }
    }
}
