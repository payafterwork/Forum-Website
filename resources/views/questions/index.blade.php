@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions</div>
               @include('questions._list');
            </div>
        </div>

            <div class="col-md-4">
                @if (count($trending))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Trending Questions
                        </div>

                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach ($trending as $question)
                                    <li class="list-group-item">
                                        <a href="{{ url($question->path) }}">
                                            {{ $question->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div
    </div>
</div>
@endsection
