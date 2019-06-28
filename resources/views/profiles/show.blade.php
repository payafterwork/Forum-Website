@extends('layouts.app')

@section('content')
   

    <div class="container">
        <div class="page-header">
            <h1>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>
 @foreach ($questions as $question)
            <div style="background: white;padding-bottom:15px; " class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                       <span class="flex">
                            <a href="/profiles/{{$question->creator->name}}">{{ $question->creator->name }}</a> posted: <a href="{{$question->path()}}">
                           {{ $question->qtitle }}</a>
                       </span>

                        <span>{{ $question->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="panel-body">
                    {{ $question->qdetails }}
                </div>
            </div>
        @endforeach

        {{ $questions->links() }}
    </div>
@endsection 