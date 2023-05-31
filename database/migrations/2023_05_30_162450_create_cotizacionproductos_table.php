<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacionproductos', function (Blueprint $table) {
            $table->bigincrements('id_cotiprod')->unique();

            $table-> unsignedBigInteger('cotizacion_id');
            $table-> foreign('cotizacion_id')->references('id_cotizacion')->on('cotizacions')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('producto_id');
            $table-> foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade')->onUpdate('cascade');

            $table->text('conceptoProd');
            $table->integer('cantidadProd');
            $table->decimal('costoUndProd', 10,0);
            $table->integer('ivaProd');
            $table->decimal('costoPeriodoProd', 10,0);
            $table->decimal('costoAñoProd', 10,0);

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
        Schema::dropIfExists('cotizacionproductos');
    }
}
