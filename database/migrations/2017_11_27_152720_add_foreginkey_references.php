<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginkeyReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references_evaluation_immobile', function (Blueprint $table) {
            $table->integer('id_evaluations')->unsigned();
            $table->foreign('id_evaluations')->references('evaluations_id')->on('evaluations');

            $table->integer('id_clientes')->unsigned();
            $table->foreign('id_clientes')->references('clients_id')->on('clients');
        });
    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('references_evaluation_immobile', function (Blueprint $table) {
            $table->foreign('id_evaluations')
              ->references('evaluations_id')->on('evaluations')
              ->onDelete('cascade');

            $table->foreign('id_clientes')
              ->references('clients_id')->on('clients')
              ->onDelete('cascade');
        });
    }
}
