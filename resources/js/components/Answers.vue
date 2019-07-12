<template>
    <div>
        <div v-for="(answer,index) in items">
            <answer :data="answer" @deleted="remove(index)"></answer>
        </div>

    </div>
</template>

<script>
    import Answer from './Answer.vue';
    export default {
        props: ['data'],
        components: { Answer},
        data() {
            return {
                items: this.data,
               
            }
        },
        methods: {
          remove(index){
            this.items.splice(index,1);
            this.$emit('remove');
            flash('Answer deleted')
          }
        }
    }
</script>