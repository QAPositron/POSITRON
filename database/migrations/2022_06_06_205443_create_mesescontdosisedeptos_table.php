<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesescontdosisedeptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('mesescontdosisedeptos', function (Blueprint $table) {
            $table->bigincrements('id_mescontdosisededepto')->unique();

            $table-> unsignedBigInteger('contdosisededepto_id');
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('mes_asignacion');
            $table->integer('dosi_control')->nullable();
            $table->integer('dosi_torax')->nullable();
            $table->integer('dosi_area')->nullable();
            $table->integer('dosi_caso')->nullable();
            $table->integer('dosi_cristalino')->nullable();
            $table->integer('dosi_muñeca')->nullable();
            $table->integer('dosi_dedo')->nullable();
            $table->string('nota_cambiodosim', 1500)->nullable();

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
        Schema::dropIfExists('mesescontdosisedeptos');
    }
}
