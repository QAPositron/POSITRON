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
            $table->text('nombre_deptocol');
            $table->text('abreviatura_deptocol');
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
