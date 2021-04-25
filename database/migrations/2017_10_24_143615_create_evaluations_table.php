<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('evaluations_id');
            $table->string('evaluations_visited');
            $table->string('evaluations_interested');
            $table->string('evaluations_value_immobile');
            $table->string('evaluations_conservation');
            $table->string('evaluations_location');
            $table->longText('evaluations_feedback');
            $table->string('evaluations_name_friend');
            $table->string('evaluations_phone_friend');
            $table->string('evaluations_email_friend');
            $table->integer('evaluations_id_key');
            $table->timestamps();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluations');
    }
}
