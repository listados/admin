<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTableReserve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve', function (Blueprint $table) {
            $table->increments('reserves_id');
            $table->string('reserves_ref_immobile');
            $table->dateTime('reserves_date_exit');
            $table->dateTime('reserves_date_devolution');
            $table->string('reserves_code_key');
            $table->float('reserves_value_guarante');
            $table->string('reserves_cpf');
            $table->dateTime('reserves_date_return');
            $table->char('reserves_visited' , 2);
            $table->char('reserves_interested' , 2);
            $table->char('reserves_value_immobile' , 2);
            $table->char('reserves_conservation' , 2);
            $table->char('reserves_location' , 2);
            $table->string('reserves_feedback');
            $table->string('reserves_status', 15);
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
        Schema::drop('reserve');
    }
}
