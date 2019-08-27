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
                        $q->where('user_two', $user->id);
                    }
                )
                    ->orWhere(
                        function ($q) use ($user) {
                            $q->where('user_one', $user->id);
                        }
                    );
            }
        );
        $conversations = $conversations->has('messages')->get();

        return view('frontend.message.index', compact('conversations'));
    }

    public function create($id)
    {

        $advertisement = Advertisement::where('id','=',$id)->firstOrFail();
        if(!$advertisement){
            return redirect()->back();
        }
        $user1 = User::find($advertisement->user_id);
        $user2 = Auth::User();

        $conversation = Conversation::with('messages')->where(
            function ($query) use ($user1, $user2) {
                $query->orwhere(
                    function ($q) use ($user1, $user2) {
                        $q->where('user_one', $user1->id)
                            ->where('user_two', $user2->id);
                    }
                )
                    ->orWhere(
                        function ($q) use ($user1, $user2) {
                            $q->where('user_one', $user2->id)
                                ->where('user_two', $user1->id);
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
            $conversation->user_one = Auth::User()->id;
            $conversation->user_two = $advertisement->user_id;
            $conversation->save();
        }

        return redirect()->route('message.show',$conversation->id);
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

    public function send(Request $request)
    {
        $user_id = Auth::User()->id;
        $message = new Message();
        $message->user_id = $user_id;
        $message->conversation_id = $request->conversation;
        $message->message = $request->message;
        $message->save();

        //envia email dizendo que o usuario recebeu uma mensagem

        return response()->json(['message'=>$message]);
    }
}
