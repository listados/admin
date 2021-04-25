<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobiles', function (Blueprint $table) {
            $table->increments('immobiles_id');
            $table->string('immobiles_cep' , 20);
            $table->string('immobiles_address' , 120);
            $table->string('immobiles_number' , 10);
            $table->string('immobiles_complement' , 150);
            $table->string('immobiles_district' , 100);
            $table->string('immobiles_city' , 50);
            $table->string('immobiles_state' , 10);
            $table->string('immobiles_reference_point' , 255);
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
        Schema::drop('immobiles');
    }
}
