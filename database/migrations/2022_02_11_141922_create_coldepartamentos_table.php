<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coldepartamentos', function (Blueprint $table) {
            $table->bigincrements('id_departamentocol')->unique();
            $table->string('nombre_deptocol',25);
            $table->string('abreviatura_deptocol',25);
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
        Schema::dropIfExists('coldepartamentos');
    }
}
