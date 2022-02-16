<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigincrements('id_contacto')->unique();
            $table->string('primer_nombre_contacto', 15);
            $table->string('segundo_nombre_contacto', 15);
            $table->string('primer_apellido_contacto', 15);
            $table->string('segundo_apellido_contacto', 15);
            $table->string('genero_contacto', 15);
            $table->string('tipo_iden_contacto', 50);
            $table->integer('cedula_contacto')->unique();
            $table->string('correo_contacto', 30)->unique();
            $table->string('telefono_contacto', 15);
            $table->string('profesion_contacto', 50);
            $table->string('lider_ava', 15)->nullable();
            $table->string('lider_dosimetria', 15)->nullable();
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
        Schema::dropIfExists('contactos');
    }
}
