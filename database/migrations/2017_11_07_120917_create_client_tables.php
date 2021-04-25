<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('clients_id');
            $table->string('clients_option');
            $table->string('clients_status');
            $table->string('clients_name');
            $table->string('clients_email');
            $table->string('clients_id_user');
            $table->longText('clients_ps');
            $table->string('clients_media');
            $table->date('clients_birth_date');
            $table->string('clients_type');
            $table->string('clients_rg');
            $table->string('clients_cpf');
            $table->string('clients_nationality');
            $table->string('clients_naturalness');
            $table->string('clients_marital_status');
            $table->float('clients_rental_finance' , 10 , 2);
            $table->string('clients_scholarity');
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
        Schema::drop('clients');
    }
}
