<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentosedes', function (Blueprint $table) {
            $table->bigincrements('id_departamentosede')->unique();

            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')->references('id_sede')->on('sedes')->onDelete('cascade')->onUpdate('cascade');

            
            $table->string('nombre_departamento',30);

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
        Schema::dropIfExists('departamentosedes');
    }
}
