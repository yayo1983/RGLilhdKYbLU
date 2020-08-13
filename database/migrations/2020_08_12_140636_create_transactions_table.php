<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_establishment')->unsigned();
            $table->foreign('id_establishment')->references('id')->on('establisments');
            $table->bigInteger('id_card')->unsigned();
            $table->foreign('id_card')->references('id')->on('cards');
            $table->bigInteger('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('clients');
            $table->bigInteger('id_pago_facil')->unsigned();
            $table->foreign('id_pago_facil')->references('id')->on('pago_facils');
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
        Schema::dropIfExists('transactions');
    }
}
