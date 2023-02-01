<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreadepartamentosedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('areadepartamentosedes', function (Blueprint $table) {
            $table->bigincrements('id_areadepartamentosede')->unique();
            
            $table-> unsignedBigInteger('departamentosede_id');
            $table-> foreign('departamentosede_id')->references('id_departamentosede')->on('departamentosedes')->onDelete('cascade')->onUpdate('cascade');

            $table->text('nombre_area');
            $table->text('descripcion')->nullable();
            
            
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
        Schema::dropIfExists('areadepartamentosedes');
    }
}
