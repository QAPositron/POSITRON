<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->bigIncrements('id_sede');
            
            $table-> unsignedBigInteger('empresas_id');
            $table-> foreign('empresas_id')->references('id_empresa')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('nombre_sede', 40);

            $table-> unsignedBigInteger('municipiocol_id');
            $table-> foreign('municipiocol_id')->references('id_municipiocol')->on('colmunicipios')->onDelete('cascade')->onUpdate('cascade');

            $table->string('direccion_sede', 30);
            $table->timestamps(); // crea dos coulmas create_at y update_at cada que re introduce y se actualiza un registro se guarada la fecha y hora en que se realizo el registro
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
}
