<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rezervari extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rezervari', function (Blueprint $table) {
            $table->id('RezervareID');
            $table->unsignedBigInteger('PachetID');
            $table->date('DataRezervare');
            $table->date('DataSosire');
            $table->date('DataPlecare');
            $table->decimal('PretTotal',15,2);
            $table->decimal('Avans',15,2);
            $table->foreign('PachetID')->references('PachetID')->on('PachetRezervare');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Rezervari');
    }
}
