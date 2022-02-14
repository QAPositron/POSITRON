<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorsedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadorsedes', function (Blueprint $table) {
            $table->bigincrements('id_trabajadoresede')->unique();

            $table-> unsignedBigInteger('trabajador_id');
            $table-> foreign('trabajador_id')->references('id_trabajador')->on('trabajadors')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('sede_id');
            $table-> foreign('sede_id')->references('id_sede')->on('sedes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('trabajadorsedes');
    }
}
