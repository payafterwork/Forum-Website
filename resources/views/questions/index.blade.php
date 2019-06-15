@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions</div>
            
                <div class="card-body">
                    @forelse($questions as $question)
                     <h4><a href="{{$question->path()}}">{{$question->qtitle}}</a></h4>
                     <strong><a href="{{$question->path()}}">{{$question->answers_count}}
                     {{str_plural('answer',$question->answers_count)}}   
                     </strong></a>
                     <p>{{$question->qdetails}}</p>
                     <hr>
                   @empty
                    <p>No questions here!</p>

                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
