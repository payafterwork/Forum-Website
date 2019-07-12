<script>
  import Answers from '../components/Answers.vue';
export default {
 props: ['initialAnswersCount'],
 components: {Answers},

 data(){
   return {
     answersCount:this.initialAnswersCount
   };
 }

}
</script>