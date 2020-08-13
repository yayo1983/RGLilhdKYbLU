<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestPagoFacilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestpagofacils', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('autorizado');
            $table->integer('autorizacion')->nullable();
            $table->string('transaccion')->nullable();
            $table->string('texto')->nullable();
            $table->text('error')->nullable();
            $table->string('empresa')->nullable();
            $table->dateTime('transIni')->nullable();
            $table->dateTime('transFin')->nullable();
            $table->string('TipoTC')->nullable();
            $table->text('data');
            $table->text('dataVal');
            $table->string('pf_message');
            $table->string('status');
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
        Schema::dropIfExists('request_pago_facil');
    }
}
