<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosiareacontdosisedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('dosiareacontdosisedes', function (Blueprint $table) {
            $table->bigincrements('id_dosiareacontdosisedes')->unique();

            $table-> unsignedBigInteger('areadepartamentosede_id');
            $table-> foreign('areadepartamentosede_id')->references('id_areadepartamentosede')->on('areadepartamentosedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosimetro_id');
            $table-> foreign('dosimetro_id')->references('id_dosimetro')->on('dosimetros')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contratodosimetriasede_id');
            $table-> foreign('contratodosimetriasede_id')->references('id_contratodosimetriasede')->on('contratodosimetriasedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contdosisededepto_id');
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('mes_asignacion');
            $table->string('dosimetro_uso', 10);
            $table->date('primer_dia_uso')->nullable();
            $table->date('ultimo_dia_uso')->nullable();
            $table->date('fecha_dosim_enviado')->nullable();
            $table->date('fecha_dosim_recibido')->nullable();
            $table->date('fecha_dosim_devuelto')->nullable();
            /* $table->string('ocupacion', 50)->nullable(); */
            $table->string('energia', 50)->nullable();
            $table->date('zero_level_date')->nullable();
            $table->date('measurement_date')->nullable(); 
            ///// EL DIA 12 DE ABIRL DEL 2023 SE CREO EL PRIMER CLIENTE CON DOSIMETROS AMBIENTAL O AREA PERO SE UTILIZARON DOSIMETROS CUERPO ENTERO, POR ELLO SE DEBIO MODIFICAR LA MIGRACION Y PONER LOS PARAMETROS DE CE///////
            $table->double('Hp007_calc_dose', 8, 5)->nullable();
            $table->double('Hp007_background_dose', 8, 5)->nullable();
            $table->double('Hp007_raw_dose', 8, 5)->nullable();
            $table->double('Hp007_dif_dosicont', 8, 5)->nullable();
            $table->double('Hp10_calc_dose', 8, 5)->nullable();
            $table->double('Hp10_background_dose', 8, 5)->nullable();
            $table->double('Hp10_raw_dose', 8, 5)->nullable();
            $table->double('Hp10_dif_dosicont', 8, 5)->nullable();
            /*$table->double('Cu_calc_dose', 8, 5)->nullable();
            $table->double('Cu_background_dose', 8, 5)->nullable();
            $table->double('Cu_raw_dose', 8, 5)->nullable();
            $table->double('Pb/Sn_calc_dose', 8, 5)->nullable();
            $table->double('Pb/Sn_background_dose', 8, 5)->nullable();
            $table->double('Pb/Sn_raw_dose', 8, 5)->nullable();
            $table->double('EzClip_calc_dose', 8, 5)->nullable();
            $table->double('EzClip_background_dose', 8, 5)->nullable();
            $table->double('EzClip_raw_dose', 8, 5)->nullable();
            $table->double('Hp3_calc_dose', 8, 5)->nullable();
            $table->double('Hp3_background_dose', 8, 5)->nullable();
            $table->double('Hp3_raw_dose', 8, 5)->nullable(); */
            $table->double('H_10_calc_dose', 8, 5)->nullable();
            $table->date('verification_date')->nullable();
            $table->date('verification_required_on_or_before')->nullable();
            $table->integer('remaining_days_available_for_use')->nullable();
            $table->string('nota1', 50)->nullable();
            $table->string('nota2', 50)->nullable();
            $table->string('nota3', 50)->nullable();
            $table->string('nota4', 50)->nullable();
            $table->string('nota5', 50)->nullable();
            $table->string('nota6', 50)->nullable();
            $table->string('DNL', 50)->nullable();
            $table->string('EU', 50)->nullable();
            $table->string('DPL', 50)->nullable();
            $table->string('DSU', 50)->nullable();
            $table->string('revision_salida', 50)->nullable();
            $table->string('revision_entrada', 50)->nullable();
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
        Schema::dropIfExists('dosiareacontdosisedes');
    }
}
