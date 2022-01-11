<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosDosimetriaEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_dosimetria_empresas', function (Blueprint $table) {

            $table->bigincrements('id_contrato_dosimetria_emp')->unique();

            $table-> unsignedBigInteger('empresa_id');
            $table-> foreign('empresa_id')->references('id_empresa')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            
            
            $table->integer('numtotal_dosi_cuerpo_entero')->nullable();
            $table->integer('numtotal_dosi_control')->nullable();
            $table->integer('numtotal_dosi_ambiental')->nullable();
            $table->integer('numtotal_dosi_ezclip')->nullable();
            
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
        Schema::dropIfExists('contratos_dosimetria_empresas');
    }
}
