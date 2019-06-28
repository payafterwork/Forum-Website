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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                       <span class="flex">
                            <a href="#">{{ $question->creator->name }}</a> posted:
                           {{ $question->title }}
                       </span>

                        <span>{{ $question->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="panel-body">
                    {{ $question->body }}
                </div>
            </div>
        @endforeach

        {{ $questions->links() }}
    </div>
@endsection 