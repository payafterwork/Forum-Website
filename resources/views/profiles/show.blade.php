@extends('layouts.app')

@section('content')
<div class="container">
  
  {{$profileUser->name}}
  @can('update',$profileUser)
     <form method="POST" action="{{ route('avatar',$profileUser)}}" enctype="multipart/form-data">
      {{csrf_field()}}
     <input type="file" name="avatar">
     <button type="submit">Add profilepic</button>
     </form>
     @if ($errors->any()) @foreach ($errors->all() as $error)
     {{ $error }}
      @endforeach @endif
     
  @endcan
  <img src="/storage/{{ $profileUser->avatar_path }}" width="200" height="200">
  created account
  <small>{{$profileUser->created_at->diffForHumans()}}</small>


 @forelse($activities as $activity) 
            <div class="panel panel-default" style="background-color:white; ">             
                
     @include("profiles.activities.{$activity->type}");

            </div>
            @empty 
            <p>{{$profileUser->name}}</p>
            <p>No activity for this user.</p>
       
   @endforelse     

 {{$activities->links()}}  
      

@endsection