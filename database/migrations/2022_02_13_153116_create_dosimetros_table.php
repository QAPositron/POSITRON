<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosimetrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosimetros', function (Blueprint $table) {
            $table->bigincrements('id_dosimetro')->unique();
            $table->integer('codigo_dosimeter')->unique();
            $table->string('estado_dosimetro', 15);
            $table->string('tecnologia_dosimetro', 30);
            $table->string('tipo_dosimetro', 30);
            $table->string('uso_dosimetro', 30)->nullable();
            $table->date('fecha_ingreso_servicio');
           
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
        Schema::dropIfExists('dosimetros');
    }
}
