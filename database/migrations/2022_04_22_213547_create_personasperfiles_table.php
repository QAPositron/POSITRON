<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasperfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personasperfiles', function (Blueprint $table) {
            $table->bigIncrements('id_personaperfil');

            $table-> unsignedBigInteger('persona_id');
            $table-> foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table->string('perfil_persona', 50);
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
        Schema::dropIfExists('personasperfiles');
    }
}
