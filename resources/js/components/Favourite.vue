 <template>

<button type="submit" @click="toggle"> 
<span class="glyphicon glyphicon-heart"></span> 
<span v-text="favouritesCount"></span>
</button>
                          

</template>

<script>
    export default {
    props: ['message'],
        data(){
         return {
         favouritesCount: this.answer.favouritesCount
         }
        },
        methods: {
         toggle(){
           if(this.isFavourited){
             axios.delete('/answers'+this.answer.id+'/favourites');

           }else{
             axios.post('/answers/'.this.answer.id+'/favourites');
           }
         }
        }
    }


    </script>

<style>
  .alert-flash{
  position: fixed;
    bottom: 100px;
    right: 25px;
  }
</style>
 
