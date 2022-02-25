@extends('layouts.app')
@section('content')

    <div class="container">
<br>
        <form class="row g-3 d-flex justify-content-center" id="message_form">
            <div class="row d-flex justify-content-center">
            <div class="col-6">
                <input type="hidden" id="current_user" value="{{auth()->user()->id}}">
                <input type="hidden" id="current_user_name" value="{{auth()->user()->name}}">
                <input type="hidden"  name="receiver_id" id="receiver_id" value="{{$user->id}}">
                <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                    <input type="text" id="message_input" class="form-control" autocomplete="off" placeholder="Shkruaj {{$user->name}}">
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-primary send_message">Dergo</button>
                <button type="submit" class="btn btn-danger leave-channel">Largohu</button>

            </div>

            </div>

        </form>

        <div class="messages" style="margin-top:25px">

            @foreach($user_messages as $message)

                    <div class="message" data-id="{{$message->id}}"> <strong>{{\App\Models\User::find($message->sender_id)->name}}</strong>: {{$message->name}} @if(auth()->user()->id == $message->sender_id)<span id="remove" style="color:red; cursor: pointer">(Fshij)</span> @endif</div>

                @endforeach
        </div>
    <div class="messages">

    </div>
    </div>
@endsection

