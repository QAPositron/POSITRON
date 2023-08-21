<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovedadmesescontdosisededeptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedadmesescontdosisededeptos', function (Blueprint $table) {
            $table->bigincrements('id_novedadmesescontdosi')->unique();

            $table-> unsignedBigInteger('mescontdosisededepto_id');
            $table-> foreign('mescontdosisededepto_id')->references('id_mescontdosisededepto')->on('mesescontdosisedeptos')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('trabajadordosimetro_id')->nullable();
            $table-> foreign('trabajadordosimetro_id')->references('id_trabajadordosimetro')->on('trabajadordosimetros')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('dosicontrol_id')->nullable();
            $table-> foreign('dosicontrol_id')->references('id_dosicontrolcontdosisedes')->on('dosicontrolcontdosisedes')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('dosiarea_id')->nullable();
            $table-> foreign('dosiarea_id')->references('id_dosiareacontdosisedes')->on('dosiareacontdosisedes')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('contdosisededepto_id')->nullable();
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('novcontdosisededepto_id')->nullable();
            $table-> foreign('novcontdosisededepto_id')->references('id_novcontdosisededepto')->on('novcontdosisededeptos')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('mes_asignacion');
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
        Schema::dropIfExists('novedadmesescontdosisededeptos');
    }
}
