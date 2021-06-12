<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesEvaluationImmobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references_evaluation_immobile', function (Blueprint $table) {
            $table->increments('references_evaluation_immobile_id');
            //$table->integer('id_clientes');
            //$table->integer('id_evaluations');
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
        Schema::drop('references_evaluation_immobile');
    }
}
