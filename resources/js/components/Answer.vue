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
          });
           this.editing = false;

           flash('Updated!');
           
        },
        destroy() {
            axios.delete('/answers/' + this.attributes.id);

            $(this.$el).fadeOut(300, function () {
                flash('Answer deleted async!');
            });
        }
     }
  }
</script> 