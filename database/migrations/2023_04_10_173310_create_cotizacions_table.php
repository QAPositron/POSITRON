<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->bigincrements('id_cotizacion')->unique();
            
            $table->integer('codigo_cotizacion')->nullable();

            $table-> unsignedBigInteger('empresa_id');
            $table-> foreign('empresa_id')->references('id_empresa')->on('empresas')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')->references('id_sede')->on('sedes')->onDelete('cascade')->onUpdate('cascade');

            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->string('periodoLec', 50);
            $table->integer('lecturas_ano');

            $table->string('obsq_transEnvio', 50)->nullable();
            $table->string('obsq_transRecole', 50)->nullable();

            $table->integer('desc_cortesia')->nullable();
            $table->integer('desc_prontopago')->nullable();

            $table->decimal('valorTotalSDPeriodo', 30,0)->nullable();
            $table->decimal('valorTotalSDAño', 30,0)->nullable();

            $table->decimal('descCortesiaPeriodo', 30,0)->nullable();
            $table->decimal('descCortesiaAño', 30,0)->nullable();

            $table->decimal('descProntopagoPeriodo', 30,0)->nullable();
            $table->decimal('descProntopagoAño', 30,0)->nullable();

            $table->decimal('servTransEnvioPeriodo', 30,0)->nullable();
            $table->decimal('servTransEnvioAño', 30,0)->nullable();

            $table->decimal('servTransRecoPeriodo', 30,0)->nullable();
            $table->decimal('servTransRecoAño', 30,0)->nullable();

            $table->decimal('valorTotalPeriodo', 30,0)->nullable();
            $table->decimal('valorTotalAño', 30,0)->nullable();

            $table->integer('promedioDosimMes')->nullable();
            $table->string('pago_anticipado', 50)->nullable();
            $table->string('pago_unmes', 50)->nullable();
            $table->text('obs')->nullable();

            /* $table-> unsignedBigInteger('producto_id')->nullable();
            $table-> foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade')->onUpdate('cascade'); */

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
        Schema::dropIfExists('cotizacions');
    }
}
