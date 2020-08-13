<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            //$table->id();
            $table->increments('id');
            $table->string('name_card_holder');
            $table->string('last_name_card_holder');
            $table->string('card_number');
            $table->integer('cvt');
            $table->integer('expiration_month');
            $table->integer('expiration_year');
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
        Schema::dropIfExists('cards');
    }
}
