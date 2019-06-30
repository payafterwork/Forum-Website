@extends('layouts.app')

@section('content')
<div class="container">
  
  {{$profileUser->name}}
  created account
  <small>{{$profileUser->created_at->diffForHumans()}}</small>


 @forelse($activities as $activity)
            <div class="panel panel-default" style="background-color:white; ">             
                
     @include("profiles.activities.{$activity->type}");

            </div>
            @empty 
            <p>No activity for this user.</p>
       
   @endforelse     

 {{$activities->links()}}  
      

@endsection