<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('personasroles', function (Blueprint $table) {
            $table->bigIncrements('id_personarol');

            $table-> unsignedBigInteger('persona_id');
            $table-> foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('rol_id');
            $table-> foreign('rol_id')->references('id_rol')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('personasroles');
    }
}
