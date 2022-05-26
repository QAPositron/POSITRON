<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personasedes', function (Blueprint $table) {
            $table->bigIncrements('id_personasede');

            $table-> unsignedBigInteger('persona_id');
            $table-> foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('sede_id');
            $table-> foreign('sede_id')->references('id_sede')->on('sedes')->onDelete('cascade')->onUpdate('cascade');            
            
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
        Schema::dropIfExists('personasedes');
    }
}
