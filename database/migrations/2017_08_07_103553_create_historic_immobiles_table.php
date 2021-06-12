<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricImmobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_immobiles', function (Blueprint $table) {
            $table->increments('historic_immobiles_id');
            $table->string('historic_immobiles_type_immobile' , 30);
            $table->string('historic_immobiles_ref_immobile' , 30);
            $table->integer('historic_immobiles_id_user');
            $table->string('historic_immobiles_finality' , 30);
            $table->string('historic_immobiles_date_exit' , 30);
            $table->string('historic_immobiles_date_devolution' , 30);
            $table->string('historic_immobiles_key_number' , 30);
            $table->string('historic_immobiles_visitor_name' , 30);
            $table->string('historic_immobiles_code_key' , 30);
            
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
        Schema::drop('historic_immobiles');
    }
}
