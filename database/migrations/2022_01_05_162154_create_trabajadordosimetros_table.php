<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadordosimetrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadordosimetros', function (Blueprint $table) {
            $table->bigincrements('id_trabajador_dosimetro')->unique();

            $table-> unsignedBigInteger('trabajador_id');
            $table-> foreign('trabajador_id')->references('id_trabajador')->on('trabajadors')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosimetro_id');
            $table-> foreign('dosimetro_id')->references('id_dosimetro')->on('dosimetros')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('holder_id');
            $table-> foreign('holder_id')->references('id_holder')->on('holders')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('trabajadordosimetros');
    }
}
