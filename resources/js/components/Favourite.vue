<template>
    <button type="submit" :class="classes" @click="toggle">
        <span class="glyphicon glyphicon-heart">*</span>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['answer'],
        data() {
            return {
                count: this.answer.favouritesCount,
                active: this.answer.isFavourited
            }
        },
        computed: {
            classes() {
                return [
                    'btn',
                    this.active ? 'btn-primary' : 'btn-default'
                ];
            },
            endpoint() {
                return '/answers/' + this.answer.id + '/favourites';
            }
        },
        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },
            create() {
                axios.post(this.endpoint);
                this.active = true;
                this.count++;
                flash('Favourited!');
            },
            destroy() {
                axios.delete(this.endpoint);
                this.active = false;
                this.count--;
                flash('Unfavourited!');
            }
        }
    }
</script> 