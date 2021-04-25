<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeImmobileReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references_evaluation_immobile', function (Blueprint $table) {
            $table->string('references_evaluation_immobile_cod_key' , 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('references_evaluation_immobile', function (Blueprint $table) {
            //
        });
    }
}
