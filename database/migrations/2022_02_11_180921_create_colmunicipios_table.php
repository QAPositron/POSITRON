<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColmunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('colmunicipios', function (Blueprint $table) {
            $table->bigincrements('id_municipiocol')->unique();

            $table-> unsignedBigInteger('departamentocol_id');
            $table-> foreign('departamentocol_id')->references('id_departamentocol')->on('coldepartamentos')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nombre_municol',40);
            $table->string('abrev_municol',40);
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
        Schema::dropIfExists('colmunicipios');
    }
}
