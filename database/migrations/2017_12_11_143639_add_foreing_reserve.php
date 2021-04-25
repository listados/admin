<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingReserve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserve', function (Blueprint $table) {
            $table->integer('reserves_id_user')->unsigned();
            $table->foreign('reserves_id_user')->references('id')->on('users')->onDelete('cascade');

            $table->integer('reserves_id_client')->unsigned();
            $table->foreign('reserves_id_client')->references('clients_id')->on('clients')->onDelete('cascade');

            $table->integer('reserves_id_key')->unsigned();
            $table->foreign('reserves_id_key')->references('keys_id')->on('keys')->onDelete('cascade');

            $table->integer('reserves_id_delivery')->unsigned();
            $table->foreign('reserves_id_delivery')->references('deliveries_id')->on('deliveries')->onDelete('cascade');
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
            /*  PARA DESAMARRAR AS CHAVES ESTRANGEIRAS*/
            $table->dropForeign('reserves_id_client_foreign');
            $table->dropColumn('clients_id');

            $table->dropForeign('reserves_id_key_foreign');
            $table->dropColumn('keys_id');

            $table->dropForeign('reserves_id_delivery_foreign');
            $table->dropColumn('deliveries_id');

            $table->dropForeign('reserves_id_user_foreign');
            $table->dropColumn('id');
        });
    }
}
