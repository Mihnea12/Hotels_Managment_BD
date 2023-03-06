<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PachetRezervare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PachetRezervare', function (Blueprint $table) {
            $table->id('PachetID');
            $table->unsignedBigInteger('UnitateID');
            $table->string('Transport', 50);
            $table->integer('NumarPersoane');
            $table->integer('NumarNoptiCazare');
            $table->decimal('PretNoapte',15,2);
            $table->foreign('UnitateID')->references('UnitateID')->on('UnitateCazare');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PachetRezervare');
    }
}
