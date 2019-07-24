<template>
              <div :id="'answer-'+id"
              class="card-body" 
              :class="isBest ? 'panel-success':'panel-default'">
            <p class="flex">
                       <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a> said <span v-text="ago"></span> ..
                     </p>
                     
                     <div v-if="signedIn">
                         <favourite :answer="data"></favourite>
                     </div>
                       
                   <div v-if="editing" class="form-control" >
                         <textarea v-model="ans">
                    
                         </textarea>
                       <button @click="update">update</button>
                        <button @click="editing=false">cancel</button> 
                   </div>
                 <div v-else v-html="ans"> </div>

               <div v-if="canUpdate">
                 <button @click="editing = true">edit</button>
                <button @click="destroy">Delete</button>
               
               </div>
               <button @click="markBestAnswer" v-show="! isBest">Best Answer</button>
              
              
                           </div>   
</template>
<script>
 import Favourite from './Favourite.vue';
 import moment from 'moment';
 
  export default{
  props: ['data'],
     data(){
        return {
           editing:false,
           ans:this.data.ans,
           id: this.data.id,
           isBest: this.data.isBest,
        }
     },
        computed: {
             ago(){
             return moment(this.data.created_at).fromNow();
             },
             signedIn(){
               return window.App.signedIn;
             },
             canUpdate(){
            return this.authorize(user => this.data.user_id == user.id);
            // return this.data.user_id == window.App.user_id;
             },
             created(){ 
            window.events.$on('best-answer-selected', id => {
               this.isBest = (id === this.id); 
            });
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
            this.$emit('deleted',this.data.id);
     
        },
        markBestAnswer(){
                axios.post('/answers/' + this.data.id + '/best');
                window.events.$emit('best-answer-selected', this.data.id);

        }
     }
  }
</script> 

<style>
.panel-success{
  background-color:green;
}
</style>