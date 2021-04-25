<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('keys_id');
            $table->string('keys_type_immobile' , 50);
            $table->string('keys_ref_immobile' , 30);
            $table->string('keys_cep' , 10);
            $table->string('keys_address' , 255);
            $table->string('keys_number' , 10);
            $table->string('keys_complements' , 25);
            $table->string('keys_district' , 150);
            $table->string('keys_city' , 150);
            $table->string('keys_state' , 5);
            $table->string('keys_point_reference' , 255);
            $table->integer('keys_id_user');
            $table->string('keys_finality' , 150);
            $table->string('keys_delivery' , 150);
            $table->timestamp('keys_date_exit');
            $table->timestamp('keys_date_devolution');
            $table->float('keys_value_guarantee' , 10 , 2);
            $table->string('keys_key_number' , 10);
            $table->string('keys_visitor_email' , 80 );
            $table->string('keys_visitor_phone_one' , 25);
            $table->string('keys_visitor_phone_two' , 25);
            $table->string('keys_visitor_cep' , 15);
            $table->string('keys_visitor_address' , 150);
            $table->string('keys_visitor_number' , 10);
            $table->string('keys_visitor_complements' , 25);
            $table->string('keys_visitor_district' , 25);
            $table->string('keys_visitor_city' , 25);
            $table->string('keys_visitor_state' , 10);
            $table->string('keys_visitor_name' , 150);
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
        Schema::drop('keys');
    }
}
