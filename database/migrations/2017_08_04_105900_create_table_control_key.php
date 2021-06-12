<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableControlKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_keys', function (Blueprint $table) {
            $table->increments('control_keys_id');
            $table->string('control_keys_type_immobile' , 50);
            $table->string('control_keys_ref_immobile' , 30);
            $table->string('control_keys_cep' , 10);
            $table->string('control_keys_address' , 255);
            $table->string('control_keys_number' , 10);
            $table->string('control_keys_complements' , 25);
            $table->string('control_keys_district' , 150);
            $table->string('control_keys_city' , 150);
            $table->string('control_keys_state' , 5);
            $table->string('control_keys_point_reference' , 255);
            $table->integer('control_keys_id_user');
            $table->string('control_keys_finality' , 150);
            $table->string('control_keys_delivery' , 150);
            $table->timestamp('control_keys_date_exit');
            $table->timestamp('control_keys_date_devolution');
            $table->float('control_keys_value_guarantee' , 10 , 2);
            $table->string('control_keys_key_number' , 10);
            $table->string('control_keys_visitor_email' , 80 );
            $table->string('control_keys_visitor_phone_one' , 25);
            $table->string('control_keys_visitor_phone_two' , 25);
            $table->string('control_keys_visitor_cep' , 15);
            $table->string('control_keys_visitor_address' , 150);
            $table->string('control_keys_visitor_number' , 10);
            $table->string('control_keys_visitor_complements' , 25);
            $table->string('control_keys_visitor_district' , 25);
            $table->string('control_keys_visitor_city' , 25);
            $table->string('control_keys_visitor_state' , 10);
            $table->string('control_keys_visitor_name' , 150);
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
        //
    }
}
