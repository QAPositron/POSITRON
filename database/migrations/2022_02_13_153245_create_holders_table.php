<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ///////SE IMPLEMENTO EL CODIGO DEL DEL HOLDER COMO STRING PORQUE LOS HOLDERS CRISTALINO CONTIENEN LETRAS////////
        Schema::create('holders', function (Blueprint $table) {
            $table->bigincrements('id_holder')->unique();
            $table->string('codigo_holder')->unique();
            $table->string('tipo_holder', 50);
            $table->string('estado_holder');

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
        Schema::dropIfExists('holders');
    }
}
