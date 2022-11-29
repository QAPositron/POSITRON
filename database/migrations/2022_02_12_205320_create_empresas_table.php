<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigincrements('id_empresa')->unique();
            $table->string('nombre_empresa', 40)->unique();
            $table->integer('num_iden_empresa')->unique();
            $table->integer('DV')->nullable();
            $table->string('telefono_empresa', 10);
            $table->string('email_empresa')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('direccion_empresa', 40);
            $table->string('nombre_representantelegal', 50);
            $table->string('tipo_iden_representantelegal', 50);
            $table->integer('cedula_representantelegal');
            
            $table-> unsignedBigInteger('municipiocol_id');
            $table-> foreign('municipiocol_id')->references('id_municipiocol')->on('colmunicipios')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('pais_empresa' , 40);
            $table->string('tipo_empresa', 40);
            $table->string('tipo_identificacion_empresa', 40);
            $table->integer('actividad_economica_empresa');
            $table->string('respo_iva_empresa');
            $table->string('respo_fiscal_empresa');
           
            $table->timestamps(); // crea dos coulmas create_at y update_at cada q
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
