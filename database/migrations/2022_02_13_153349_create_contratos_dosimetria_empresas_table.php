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

            $table->bigincrements('id_contratodosimetria_emp')->unique();

            $table-> unsignedBigInteger('empresa_id');
            $table-> foreign('empresa_id')->references('id_empresa')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('nombre_empresa')->unique();
            $table->integer('num_iden_empresa')->unique();
            $table->integer('numtotal_dosi_torax')->nullable();
            $table->integer('numtotal_dosi_cristalino')->nullable();
            $table->integer('numtotal_dosi_dedo')->nullable();
            $table->integer('numtotal_dosi_muñeca')->nullable();
            $table->integer('numtotal_dosi_control_torax')->nullable();
            $table->integer('numtotal_dosi_control_cristalino')->nullable();
            $table->integer('numtotal_dosi_control_dedo')->nullable();
            $table->integer('numtotal_dosi_ambiental')->nullable();
            $table->integer('numtotal_dosi_caso')->nullable();
            
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
