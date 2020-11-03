<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHijosVacunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hijos_vacunas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hijos');
            $table->unsignedBigInteger('id_vacunas');
            $table->timestamp('fecha_aplicacion')->nullable();
            $table->timestamps();

            $table->foreign('id_hijos')->references('id')->on('hijos');
            $table->foreign('id_vacunas')->references('id')->on('vacunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hijos_vacunas');
    }
}
