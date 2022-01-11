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
            $table->bigincrements('id_contrato_dosimetria')->unique();
            $table->integer('codigo_contrato')->nullable();
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
