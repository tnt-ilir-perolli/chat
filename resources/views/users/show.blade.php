@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($users as $user)
    <div class="media mt-4">
      <a href="{{route('user.show',$user->id)}}" style="text-decoration: none; color:black"><div class="media-body">
            <h5 class="mt-0">{{$user->name}}</h5>
           {{$user->email}}
        </div>
      </a>
    </div>
        @endforeach
    </div>
@endsection
