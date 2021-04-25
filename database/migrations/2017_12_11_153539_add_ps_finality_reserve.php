<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPsFinalityReserve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserve', function (Blueprint $table) {
            $table->string('reserve_finality' , 25);
            $table->longText('reserve_ps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reserve', function (Blueprint $table) {
            //
        });
    }
}
