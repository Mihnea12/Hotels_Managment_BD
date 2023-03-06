<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CamereUnitate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CamereUnitate', function (Blueprint $table) {
            $table->unsignedBigInteger('UnitateID');
            $table->unsignedBigInteger('CameraID');
            $table->primary(['UnitateID','CameraID']);
            $table->string('NumeTipCamere',50);
            $table->foreign('UnitateID')->references('UnitateID')->on('UnitateCazare');
            $table->foreign('CameraID')->references('CameraID')->on('Camere');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CamereUnitate');
    }
}
