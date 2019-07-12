<template>
              <div :id="'answer'+id" class="card-body">
            <p class="flex">
                       <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a> said {{data.created_at}} ..
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
                 <div v-else v-text="ans"> </div>

               <div v-if="canUpdate">
                 <button @click="editing = true">edit</button>
                              <button @click="destroy">Delete</button>
               </div>
              
                           </div>   
</template>
<script>
  export default{
  props: ['data'],
     data(){
        return {
           editing:false,
           ans:this.data.ans,
           id: this.data.id

        }
     },
        computed: {
             signedIn(){
               return window.App.signedIn;
             },
             canUpdate(){
            return this.authorize(user => this.data.user_id == user.id);
            // return this.data.user_id == window.App.user_id;
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
     
        }
     }
  }
</script> 

