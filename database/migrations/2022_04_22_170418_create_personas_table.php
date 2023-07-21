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
            $table->text('primer_nombre_persona');
            $table->text('segundo_nombre_persona')->nullable();
            $table->text('primer_apellido_persona');
            $table->text('segundo_apellido_persona')->nullable();
            $table->text('genero_persona');
            $table->text('tipo_iden_persona');
            $table->integer('cedula_persona')->unique()->nullable();
            $table->string('correo_persona', 255)->nullable();
            $table->string('telefono_persona', 15)->nullable();
            $table->string('lider_ava', 50)->nullable();
            $table->string('lider_dosimetria', 50)->nullable();
            $table->string('lider_controlescalidad', 50)->nullable();
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
