<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambiosnovedadmesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambiosnovedadmeses', function (Blueprint $table) {
            $table->bigincrements('id_cambionovedadmeses')->unique();

            $table-> unsignedBigInteger('novedadmesescontdosidepto_id');
            $table-> foreign('novedadmesescontdosidepto_id')->references('id_novedadmesescontdosi')->on('novedadmesescontdosisededeptos')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('trabajadordosimetro_id')->nullable();
            $table-> foreign('trabajadordosimetro_id')->references('id_trabajadordosimetro')->on('trabajadordosimetros')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('dosicontrol_id')->nullable();
            $table-> foreign('dosicontrol_id')->references('id_dosicontrolcontdosisedes')->on('dosicontrolcontdosisedes')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('dosiarea_id')->nullable();
            $table-> foreign('dosiarea_id')->references('id_dosiareacontdosisedes')->on('dosiareacontdosisedes')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('tipo_novedad');
            $table->text('nota_cambiodosim')->nullable();

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
        Schema::dropIfExists('cambiosnovedadmeses');
    }
}
