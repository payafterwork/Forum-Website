<template>
   <div>
    <h1 v-text="user.name"></h1>
  <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
  
     <input type="file" name="avatar" accept="image/*" @change="onChange">
    
     </form>
  <img :src="avatar" width="200" height="200">
  </div>
</template>

<script>
 export default {
        props: ['user'],
        data() {
            return {
                avatar: '/storage/'+this.user.avatar_path
            };
        },
        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },
        methods: {
          onChange(e){ //ONCHANGE means Choosing Image
        
           if(! e.target.files.length) return; 
           //Checks if we file is choosen or not
          
           let avatar = e.target.files[0];
           // Take the first one or the only one

           let reader = new FileReader();
           //Read file reader initialized
          
           reader.readAsDataURL(avatar);
            //Read file as Data URL
          
           reader.onload = e =>{ //Once uploaded
            this.avatar = e.target.result; //Will take file URL and assign it to avatar data which links to the source (line 9) and displays name dynamically
           }
          //PERSIST ON SERVER
          this.persist(avatar); // sending over the file to persist function
          },
          persist(avatar){
                let data = new FormData();
                // Buidling up form data
                data.append('avatar', avatar);
                // Append avatar to it to file object
                axios.post(`/api/users/${this.user.name}/avatar`, data).then(() => flash('Avatar uploaded!'));
                //Posting form data to server
          }
      }

    }
</script>

<style>
    
</style> 