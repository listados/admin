<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDevolutionReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references_evaluation_immobile', function (Blueprint $table) {
            $table->char('references_evaluation_immobile_devolution', 1);
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
