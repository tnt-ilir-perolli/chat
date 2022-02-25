<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Events\sendMessage;
use App\Models\User;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $user_id = auth()->user()->id;
        $receiver_id= $request->receiver_id;
        $user = User::find($receiver_id);
        if (!$user){
            return;
        }

        $message = Message::create(['name'=>$input['name'], 'sender_id'=>$user_id, 'receiver_id'=>$receiver_id]);

        event(new sendMessage($user_id,$receiver_id, $input['name']));
        return response(['id'=>$message->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $current_user = auth()->user()->id;
        $messages_count = $user->messages->count();
        $user_messages = Message::where('receiver_id',$id)->where('sender_id',$current_user)->orWhere(function ($q) use ($id,$current_user){
            $q->where('sender_id',$id)->where('receiver_id',$current_user);
        })->orderBy('id','DESC')->get();

        return view ('messages.show',compact('user', 'user_messages','messages_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        if (auth()->user()->id == $message->sender_id){
            $message->delete();
        }
    }
}
