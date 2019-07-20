@extends('layouts.app')

@section('content')
<div class="container">
  
  
     <!--
 -->
     
 
   <avatar-form :user="{{ $profileUser }}"></avatar-form>
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