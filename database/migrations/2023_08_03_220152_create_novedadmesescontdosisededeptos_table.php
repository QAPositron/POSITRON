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
            $table->integer('codigo_novedad')->nullable();

            $table-> unsignedBigInteger('mescontdosisededepto_id')->nullable();
            $table-> foreign('mescontdosisededepto_id')->references('id_mescontdosisededepto')->on('mesescontdosisedeptos')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('contratodosimetria_id');
            $table-> foreign('contratodosimetria_id')->references('id_contratodosimetria')->on('dosimetriacontratos')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('contdosisededepto_id')->nullable();
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');
            
            $table-> unsignedBigInteger('novcontdosisededepto_id')->nullable();
            $table-> foreign('novcontdosisededepto_id')->references('id_novcontdosisededepto')->on('novcontdosisededeptos')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('mes_asignacion');
            
            
            
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
