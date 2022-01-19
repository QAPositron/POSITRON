<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosimetriacontratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosimetriacontratos', function (Blueprint $table) {
            $table->bigincrements('id_contratodosimetria')->unique();
            $table->integer('codigo_contrato')->nullable();

            $table-> unsignedBigInteger('empresa_id');
            $table-> foreign('empresa_id')->references('id_empresa')->on('empresas')->onDelete('cascade')->onUpdate('cascade');

            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->string('periodo_recambio')->nullable();


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
        Schema::dropIfExists('dosimetriacontratos');
    }
}
