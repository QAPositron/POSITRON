<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigincrements('id_persona')->unique();
            $table->string('primer_nombre_persona', 15);
            $table->string('segundo_nombre_persona', 15);
            $table->string('primer_apellido_persona', 15);
            $table->string('segundo_apellido_persona', 15);
            $table->string('genero_persona', 15);
            $table->string('tipo_iden_persona', 50);
            $table->integer('cedula_persona')->unique();
            $table->string('correo_persona', 30)->unique();
            $table->string('telefono_persona', 15);
            $table->string('lider_ava', 15)->nullable();
            $table->string('lider_dosimetria', 15)->nullable();
            $table->string('lider_controlescalidad', 15)->nullable();
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
        Schema::dropIfExists('personas');
    }
}
