<template>

                <div class="card-body">
                 
                
             <p class="flex">
                          <a href="/profiles/{{$answer->owner->name}}">{{$answer->owner->name}}</a> said {{$answer->created_at->diffForHumans()}}
                        </p>
                        @if (Auth::check())
                            <favourite :answer="{{ $answer }}"></favourite>
                         @endif   
                        <form method="POST" action="/answers/{{$answer->id}}/favourites">
                          {{ csrf_field() }}
                          <button type="submit"{{$answer->isFavourited()?'disabled':''}}> 
                          {{$answer->favourites_count}} {{str_plural('Favourite',$answer->favourites_count)}}</button>
                          
                        </form>
                 
                      <div v-if="editing" class="form-control" >
                            <textarea v-model="ans">
                       
                            </textarea>
                          <button @click="update">update</button>
                           <button @click="editing=false">cancel</button> 
                      </div>
                    <div v-else v-text="ans"> </div>
                  
                  @can('update',$answer)
                    
                    <button @click="editing = true">edit</button>
                <button @click="destroy">Delete</button>
           
                 @endcan
             </div>                  
  
  
</template>
<script>
  export default{
  props: ['data'],
     data(){
        return {
           editing:false,
           ans:this.data.ans
        }
     },
     methods: {
       update(){
          axios.patch('/answers/'+this.data.id,{
             ans: this.ans
          });
           this.editing = false;

           flash('Updated!');
           
        },
        destroy() {
            axios.delete('/answers/' + this.data.id);

            $(this.$el).fadeOut(300, function () {
                flash('Answer deleted async!');
            });
        }
     }
  }
</script> 