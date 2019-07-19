<template>
  
         <div class="card-body" v-if="signedIn">           <div class="card">
               <div class="card-header">

                  <div class="from-group">
                    
                   <textarea class="form-control" name="ans" id="body" rows="5" placeholder="Add your answer" v-model="ans" required></textarea><br>
                   <button class="btn btn-default" type="submit" @click="addAnswer">POST</button>
                  </div>
               </div>                   
             

            </div>

        </div >
         <div v-else>
           <p ><a href="/login">Sign in</a> to add answer.</p>
        </div> 

</template>

<script>
 import 'jquery.caret';
 import 'at.js';

 export default {
 props: ['endpoint'],
   data(){
   return {
		ans: '',
		

   };

   }, mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("/api/users", {name: query}, function(usernames) {
                            callback(usernames)
                        });                       
                    }
                }
            });
      },
        computed:{
      
      signedIn(){
               return window.App.signedIn;
             }
   },
   methods: {
     addAnswer(){
       axios.post(location.pathname + '/answers',{ans: this.ans}).then(response=>{
        this.ans = '';
        flash('Answer posted');
        this.$emit('created',response.data);
       }
       )
     }
   }
 }
</script>