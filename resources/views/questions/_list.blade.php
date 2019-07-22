<div class="card-body">
                    @foreach($questions as $question)
                    
                    @if($question->hasUpdatesFor(auth()->user()))
                     <h4><strong><a href="{{$question->path()}}">{{$question->qtitle}}</a></strong></h4>
                    @else
                    <h4><a href="{{$question->path()}}">{{$question->qtitle}}</a></h4>
                    @endif 
                     <strong><a href="{{$question->path()}}">{{$question->answers_count}}
                     {{str_plural('answer',$question->answers_count)}}   
                     </strong></a>
                     <p>{{$question->qdetails}}</p>
                     {{$question->visits}} views
                     <hr>

                    @endforeach
                </div>
