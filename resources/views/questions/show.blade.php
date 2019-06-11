@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="card-header">{{$question->creator->name}} asked
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
                <div class="class-body">
                   @if (auth()->check())
            <div class="card">
               <div class="card-header">

                 <form method="POST" action="{{ $question->path().'/answers'}}">
                  {{ csrf_field() }}
                  <div class="from-group">
                    
                   <textarea class="form-control" name="ans" id="body" rows="5" placeholder="Add your answer"></textarea><br>
                   <button class="btn btn-default" type="submit">POST</button>
                  </div>
                 </form>
               </div>                   
              

            </div>
          @else
            <p><a href="{{ route('login')}}">Sign in</a> to add answer.</p>
          @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection