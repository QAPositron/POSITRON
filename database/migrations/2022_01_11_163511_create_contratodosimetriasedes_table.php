<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratodosimetriasedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratodosimetriasedes', function (Blueprint $table) {
            $table->bigincrements('id_contratodosimetriasede')->unique();
            
            $table-> unsignedBigInteger('sede_id');
            $table-> foreign('sede_id')->references('id_sede')->on('sedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contratodosimetria_id');
            $table-> foreign('contratodosimetria_id')->references('id_contrato_dosimetria')->on('dosimetriacontratos')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('dosi_cuerpo_entero')->nullable();
            $table->integer('dosi_ambiental')->nullable();
            $table->integer('dosi_ezclip')->nullable();
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
        Schema::dropIfExists('contratodosimetriasedes');
    }
}
