<script>
  export default{
  props: ['attributes'],
     data(){
        return {
           editing:false,
           ans:this.attributes.ans
        }
     },
     methods: {
       update(){
          axios.patch('/answers/'+this.attributes.id,{
             ans: this.ans
          })->with('flash','Question created!');

           this.editing = false;
           

       }
     }

  }


</script>