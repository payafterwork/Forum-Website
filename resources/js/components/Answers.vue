<template>
    <div>
        <div v-for="(answer,index) in items" :key="answer.id">
            <answer :data="answer" @deleted="remove(index)"></answer>
        </div>

           <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <new-answer @created="add"></new-answer>
    </div>


</template>

<script>
    import Answer from './Answer.vue';
    import NewAnswer from './NewAnswer.vue';
    import collection from '../mixins/collection.js';

 export default {
        components: { Answer, NewAnswer },
        mixins: [collection],
        data() {
            return { dataSet: false };
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },
            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/answers?page=${page}`;
            },
            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0,0);
            }
        }
    }

</script>