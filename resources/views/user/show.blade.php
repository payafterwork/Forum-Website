@extends('layouts.app')

@section('content')
<div class="container">
  
  {{$profileUser->name}}
  created account
  <small>{{$profileUser->created_at->diffForHumans()}}</small>


 @foreach($activities as $activity)
            <div class="panel panel-default" style="background-color:white; ">             
            	
     @include("user.activities.{$activity->type}");

            


</div>
       
   @endforeach     

 {{$activities->links()}}  
      

@endsection
