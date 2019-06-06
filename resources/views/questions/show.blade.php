@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="card-header"> asked
                    <h3>{{$question->qnop}}<h3><a>{{$question->qtitle}}</a></h4>
                     <p>{{$question->qdetails}}</p>
                     <hr>
                </div>

                <div class="card-body">
                    @foreach($question->answers as $answer)
                    <div class="card-header">
                        {{$answer->owner->name}} said {{$answer->created_at->diffForHumans()}}
                    </div>
                    
                    <p>{{$answer->ans}}</p>
                    @endforeach
                    
                </div>
             
               
        
        </div>
    </div>
</div>
@endsection
