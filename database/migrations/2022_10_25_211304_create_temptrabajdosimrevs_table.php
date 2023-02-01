<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemptrabajdosimrevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('temptrabajdosimrevs', function (Blueprint $table) {
            $table->bigincrements('id_temptrabajdosimrev')->unique();
            
            $table-> unsignedBigInteger('trabajcontdosimetro_id');
            $table-> foreign('trabajcontdosimetro_id')->references('id_trabajadordosimetro')->on('trabajadordosimetros')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contratodosimetriasede_id');
            $table-> foreign('contratodosimetriasede_id')->references('id_contratodosimetriasede')->on('contratodosimetriasedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('persona_id')->nullable();
            $table-> foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosimetro_id');
            $table-> foreign('dosimetro_id')->references('id_dosimetro')->on('dosimetros')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('holder_id')->nullable();
            $table-> foreign('holder_id')->references('id_holder')->on('holders')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contdosisededepto_id')->nullable();
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');

            
            $table->integer('mes_asignacion');
            $table->string('dosimetro_uso',50);
            $table->date('primer_dia_uso')->nullable();
            $table->date('ultimo_dia_uso')->nullable();
            $table->date('fecha_dosim_enviado')->nullable();
            $table->date('fecha_dosim_recibido')->nullable();
            $table->date('fecha_dosim_devuelto')->nullable();
            $table->string('ocupacion', 50)->nullable();
            $table->string('ubicacion', 50)->nullable();
            $table->string('energia', 50)->nullable();
            
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
        Schema::dropIfExists('temptrabajdosimrevs');
    }
}
