<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratodosimetriasededeptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('contratodosimetriasededeptos', function (Blueprint $table) {
            $table->bigincrements('id_contdosisededepto')->unique();

            
            $table-> unsignedBigInteger('contratodosimetriasede_id');
            $table-> foreign('contratodosimetriasede_id')->references('id_contratodosimetriasede')->on('contratodosimetriasedes')->onDelete('cascade')->onUpdate('cascade');

            
            $table-> unsignedBigInteger('departamentosede_id');
            $table-> foreign('departamentosede_id')->references('id_departamentosede')->on('departamentosedes')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('mes_actual')->nullable();
            /* $table->text('ocupacion')->nullable(); */
            $table->integer('dosi_control_torax')->nullable();
            $table->integer('dosi_control_cristalino')->nullable();
            $table->integer('dosi_control_dedo')->nullable();
            $table->integer('dosi_torax')->nullable();
            $table->integer('dosi_area')->nullable();
            $table->integer('dosi_caso')->nullable();
            $table->integer('dosi_cristalino')->nullable();
            $table->integer('dosi_muñeca')->nullable();
            $table->integer('dosi_dedo')->nullable();
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
        Schema::dropIfExists('contratodosimetriasededeptos');
    }
}
