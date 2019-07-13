<template>
    <div>
        <div v-for="(answer,index) in items">
            <answer :data="answer" @deleted="remove(index)"></answer>
        </div>
    <new-answer :endpoint="endpoint" @created="add"></new-answer>
    </div>
</template>

<script>
    import Answer from './Answer.vue';
    import NewAnswer from './NewAnswer.vue';
  
    export default {
        props: ['data'],
        components: { Answer, NewAnswer},
        data() {
            return {
                items: this.data,
                endpoint: location.pathname+'/answers'
               
            };
        },
        methods: {
          add(answer){
          this.items.push(answer);
            this.$emit('added');
          
          },
          remove(index){
            this.items.splice(index,1);
            this.$emit('remove');
            flash('Answer deleted')
          }
        }
    }
</script>