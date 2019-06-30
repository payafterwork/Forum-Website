@extends('layouts.app')

@section('content')
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
                 @foreach($question->answers as $answer)
<answer :attributes="{{$answer}}" inline-template v-cloak>
                <div class="card-body">
                 
                  <?php $answers = $question->answers()->paginate(1); ?>
                   
                    <div class="card-header">
                        <p class="flex">
                          <a href="/user/{{$answer->owner->name}}">{{$answer->owner->name}}</a> said {{$answer->created_at->diffForHumans()}}
                          </p>
                          
                        <form method="POST" action="/answers/{{$answer->id}}/favourites">
                          {{ csrf_field() }}
                          <button type="submit"{{$answer->isFavourited()?'disabled':''}}> 
                          {{$answer->favourites_count}} {{str_plural('Favourite',$answer->favourites_count)}}</button>
                          
                        </form>
                    </div>
                    
                    <p>
                      <div v-if="editing" class="form-control" >
                      <textarea v-model="ans">
                       
                      </textarea>
                  <button @click="update">update</button>
                  <button @click="editing=false">cancel</button> 
                    </div>
                    <div v-else v-text="ans">
                    </div>
                  
                  </p>


                    @can('update',$answer)
                    
                    <button @click="editing = true">edit</button>
                   <form action="/answers/{{$answer->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <button type="submit">DELETE</button>
                     
                   </form>
                   
                   @endcan
                    @endforeach
</answer>                    
                    {{$answers->links()}}

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
</div>
@endsection