@extends('layouts.app')

@section('content')
<question-view inline-template>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-body">
                This Q was published {{$question->created_at->diffforHumans()}} by <a href="/user/{{$question->creator->name}}">{{$question->creator->name}}</a> and currently has {{$question->answers_count}}
                     {{str_plural('answer',$question->answers_count)}}  
                </div>

                <div class="card-body">
                   @can('update',$question)
                   <form action="{{$question->path()}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit">DELETE</button>
                     
                   </form>
                   @endcan
                    <div class="card-header">{{$question->creator->name}} asked
                    <h3>{{$question->qnop}}<h3><a href="{{$question->path()}}">{{$question->qtitle}}</a></h4>
                     <p>{{$question->qdetails}}</p>
                     <hr>
                </div>

               <answers :data="{{$question->answers}}"></answers>
                <!--  @foreach($question->answers as $answer)
                   <?php $answers = $question->answers()->paginate(1); ?>

                    @endforeach
 -->
    
                    {{$answers->links()}}
               
                   <div class="card-body">     @if (auth()->check())
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
</question-view>
@endsection