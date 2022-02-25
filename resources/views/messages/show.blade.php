@extends('layouts.app')
@section('content')
    <div class="container">

        <form class="row g-3 d-flex justify-content-center"id="message_form">
            <div class="row d-flex justify-content-center">
            <div class="col-6">
                <input type="hidden" id="current_user" value="{{auth()->user()->id}}">
                <input type="hidden" id="receiver_id" name="receiver_id" value="{{$user->id}}">
                <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>

                    <input type="text" id="message_input" class="form-control" autocomplete="off" placeholder="Shkruaj {{$user->name}}">

            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </form>
        <div class="messages" style="margin-top:25px">

        </div>
    <div class="messages">

    </div>
    </div>
@endsection

