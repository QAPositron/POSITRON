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

            $table-> unsignedBigInteger('dosiareacontdosimetro_id')->nullable();
            $table-> foreign('dosiareacontdosimetro_id')->references('id_dosiareacontdosisedes')->on('dosiareacontdosisedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contratodosimetriasede_id')->nullable();
            $table-> foreign('contratodosimetriasede_id')->references('id_contratodosimetriasede')->on('contratodosimetriasedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contdosisededepto_id')->nullable();
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('novcontdosisededepto_id')->nullable();
            $table-> foreign('novcontdosisededepto_id')->references('id_novcontdosisededepto')->on('novcontdosisededeptos')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('contratodosimetria_id')->nullable();
            $table-> foreign('contratodosimetria_id')->references('id_contratodosimetria')->on('dosimetriacontratos')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('observacion_id');
            $table-> foreign('observacion_id')->references('id_observacion')->on('observacions')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('mes_asignacion');
            $table->text('nota_obs9')->nullable();
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
