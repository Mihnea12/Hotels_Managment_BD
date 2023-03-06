<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UnitateCazare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UnitateCazare', function (Blueprint $table) {
            $table->id('UnitateID');
            $table->unsignedBigInteger('TipUnitateID');
            $table->string('NumeUnitate',50);
            $table->string('Adresa',50);
            $table->integer('CodPostal');
            $table->foreign('TipUnitateID')->references('TipID')->on('TipUnitate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UnitateCazare');
    }
}
