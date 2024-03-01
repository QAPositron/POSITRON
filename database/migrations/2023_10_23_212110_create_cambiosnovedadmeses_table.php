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

            $table-> unsignedBigInteger('trabajadordosimetro_ant_id')->nullable();
            $table-> foreign('trabajadordosimetro_ant_id')->references('id_trabajadordosimetro')->on('trabajadordosimetros')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('persona_id')->nullable();
            $table-> foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosicontrol_id')->nullable();
            $table-> foreign('dosicontrol_id')->references('id_dosicontrolcontdosisedes')->on('dosicontrolcontdosisedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosicontrol_ant_id')->nullable();
            $table-> foreign('dosicontrol_ant_id')->references('id_dosicontrolcontdosisedes')->on('dosicontrolcontdosisedes')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('dosiarea_id')->nullable();
            $table-> foreign('dosiarea_id')->references('id_dosiareacontdosisedes')->on('dosiareacontdosisedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosiarea_ant_id')->nullable();
            $table-> foreign('dosiarea_ant_id')->references('id_dosiareacontdosisedes')->on('dosiareacontdosisedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('areadepartamentosede_id')->nullable();
            $table-> foreign('areadepartamentosede_id')->references('id_areadepartamentosede')->on('areadepartamentosedes')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('ubicacion', 50)->nullable();
            $table->integer('mes_asignacion')->nullable();;
            $table->integer('tipo_novedad')->nullable();;
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
