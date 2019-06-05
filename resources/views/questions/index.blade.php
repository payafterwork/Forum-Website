@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions</div>

                <div class="card-body">
                    @foreach($questions as $question)
                     <h4><a href="{{$question->path()}}">{{$question->qtitle}}</a></h4>
                     <p>{{$question->qdetails}}</p>
                     <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
