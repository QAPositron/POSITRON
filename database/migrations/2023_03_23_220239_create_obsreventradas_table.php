<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObsreventradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obsreventradas', function (Blueprint $table) {
            $table->bigincrements('id_obsreventrada')->unique();
            
            $table-> unsignedBigInteger('trabajcontdosimetro_id')->nullable();
            $table-> foreign('trabajcontdosimetro_id')->references('id_trabajadordosimetro')->on('trabajadordosimetros')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosicontrol_id')->nullable();
            $table-> foreign('dosicontrol_id')->references('id_dosicontrolcontdosisedes')->on('dosicontrolcontdosisedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contratodosimetriasede_id');
            $table-> foreign('contratodosimetriasede_id')->references('id_contratodosimetriasede')->on('contratodosimetriasedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contdosisededepto_id');
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('mes_asignacion');
            $table->integer('numero_obs')->nullable();
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
        Schema::dropIfExists('obsreventradas');
    }
}
