<template>
 <div v-for="answer in items">
  <answer :data="answer"> </answer>
 </div>
</template>

<script>
    import Answer from './Answer.vue'
    export default {
        props: ['data'],
          components: { Answers },
        data() {
            return {
                items: this.data
            }
        }
    };
</script>

