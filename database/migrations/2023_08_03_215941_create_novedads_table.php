<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedads', function (Blueprint $table) {
            $table->bigincrements('id_novedad')->unique();

            $table->integer('codigo_novedad')->nullable();
            
            $table-> unsignedBigInteger('contratodosimetria_id');
            $table-> foreign('contratodosimetria_id')->references('id_contratodosimetria')->on('dosimetriacontratos')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('mes_asignacion')->nullable();
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
        Schema::dropIfExists('novedads');
    }
}
