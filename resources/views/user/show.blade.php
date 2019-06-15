@extends('layouts.app')

@section('content')
<div class="container">
  
  {{$profileUser->name}}
  created account
  <small>{{$profileUser->created_at->diffForHumans()}}</small>


 @foreach($questions as $question)
            <div class="panel panel-default" style="background-color:white; ">             
            	
     

                <div class="card-body">

                This Q was published {{$question->created_at->diffforHumans()}} by <a href="#">{{$question->creator->name}}</a> and currently has {{$question->answers_count}}
                     {{str_plural('answer',$question->answers_count)}}  
                
                    <div class="card-header">{{$question->creator->name}} asked
                    <h3>{{$question->qnop}}<h3><a href="{{$question->path()}}">{{$question->qtitle}}</a></h4>
                     <p>{{$question->qdetails}}</p>
                     <hr>
                    </h3>
                    </div>
             </div>
             



</div>
       
   @endforeach     

 {{$questions->links()}}  
      

@endsection
