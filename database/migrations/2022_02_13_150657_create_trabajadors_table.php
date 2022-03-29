<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->bigIncrements('id_trabajador')->unique();

            $table-> unsignedBigInteger('empresa_id');
            $table-> foreign('empresa_id')->references('id_empresa')->on('empresas')->onDelete('cascade')->onUpdate('cascade');

            $table->string('primer_nombre_trabajador', 15);
            $table->string('segundo_nombre_trabajador', 15)->nullable();
            $table->string('primer_apellido_trabajador', 15);
            $table->string('segundo_apellido_trabajador', 15);
            $table->integer('cedula_trabajador')->unique();
            $table->string('tipo_iden_trabajador', 50);
            $table->string('genero_trabajador', 15);
            $table->string('email_trabajador')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telefono_trabajador', 15);
            $table->string('tipo_trabajador', 15);
            

            $table->timestamps(); // crea dos coulmas create_at y update_at cada que re introduce y se actualiza un registro se guarada la fecha y hora en que se realizo el registro
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajadors');
    }
}
