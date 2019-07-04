<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionSubsciptionsTable extends Migration
{    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_subsciptions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->unique(['user_id','question_id']);

           $table->foreign('question_id')
      ->references('id')->on('questions')
      ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_subsciptions');
    }
}
