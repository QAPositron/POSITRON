<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactosedes', function (Blueprint $table) {
            $table->bigincrements('id_contactosede')->unique();

            $table-> unsignedBigInteger('contacto_id');
            $table-> foreign('contacto_id')->references('id_contacto')->on('contactos')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('contactosedes');
    }
}
