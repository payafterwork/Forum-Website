<template>
 <div class="alert alert-success alert-flash fade show" role="alert" v-show="show">
  {{body}}
</div>
</template>

<script>
    export default {
    props: ['message'],
        data(){
         return {
         body: '',
         show: false
         }
        },
        created(){
       if(this.message){
         this.body = this.message;
         this.show=true;

         setTimeout(()=>{
           this.show =false;
         },3000);
       }
    }

    };

    </script>

<style>
  .alert-flash{
  position: fixed;
    bottom: 100px;
    right: 25px;
  }
</style>
 
