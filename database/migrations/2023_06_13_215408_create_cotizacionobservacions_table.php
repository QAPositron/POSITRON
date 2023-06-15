<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionobservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacionobservacions', function (Blueprint $table) {
            $table->bigincrements('id_cotiobs')->unique();

            $table-> unsignedBigInteger('cotizacion_id');
            $table-> foreign('cotizacion_id')->references('id_cotizacion')->on('cotizacions')->onDelete('cascade')->onUpdate('cascade');

            $table->text('obs')->nullable();
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
        Schema::dropIfExists('cotizacionobservacions');
    }
}
