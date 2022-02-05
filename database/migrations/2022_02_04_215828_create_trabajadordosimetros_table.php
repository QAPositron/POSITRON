<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadordosimetrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('trabajadordosimetros', function (Blueprint $table) {
            $table->bigincrements('id_trabajadordosimetro')->unique();
            
            $table-> unsignedBigInteger('contratodosimetriasede_id');
            $table-> foreign('contratodosimetriasede_id')->references('id_contratodosimetriasede')->on('contratodosimetriasedes')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('trabajador_id');
            $table-> foreign('trabajador_id')->references('id_trabajador')->on('trabajadors')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('dosimetro_id');
            $table-> foreign('dosimetro_id')->references('id_dosimetro')->on('dosimetros')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('holder_id')->nullable();
            $table-> foreign('holder_id')->references('id_holder')->on('holders')->onDelete('cascade')->onUpdate('cascade');

            $table-> unsignedBigInteger('contdosisededepto_id')->nullable();
            $table-> foreign('contdosisededepto_id')->references('id_contdosisededepto')->on('contratodosimetriasededeptos')->onDelete('cascade')->onUpdate('cascade');

            
            $table->integer('mes_asignacion');
            $table->string('dosimetro_uso',10);
            $table->date('primer_dia_uso')->nullable();
            $table->date('ultimo_dia_uso')->nullable();
            $table->date('fecha_dosim_enviado')->nullable();
            $table->date('fecha_dosim_recibido')->nullable();
            $table->date('fecha_dosim_devuelto')->nullable();
            $table->string('ocupacion', 30)->nullable();
            $table->string('ubicacion', 30)->nullable();
            $table->string('energia', 30)->nullable();
            $table->date('zero_level_date')->nullable();
            $table->date('measurement_date')->nullable();
            $table->float('Hp007_calc_dose', 8, 3)->nullable();
            $table->float('Hp007_background_dose', 8, 3)->nullable();
            $table->float('Hp007_raw_dose', 8, 3)->nullable();
            $table->float('Hp10_calc_dose', 8, 3)->nullable();
            $table->float('Hp10_background_dose', 8, 3)->nullable();
            $table->float('Hp10_raw_dose', 8, 3)->nullable();
            $table->float('Cu_calc_dose', 8, 3)->nullable();
            $table->float('Cu_background_dose', 8, 3)->nullable();
            $table->float('Cu_raw_dose', 8, 3)->nullable();
            $table->float('Pb/Sn_calc_dose', 8, 3)->nullable();
            $table->float('Pb/Sn_background_dose', 8, 3)->nullable();
            $table->float('Pb/Sn_raw_dose', 8, 3)->nullable();
            $table->float('EzClip_calc_dose', 8, 3)->nullable();
            $table->float('EzClip_background_dose', 8, 3)->nullable();
            $table->float('EzClip_raw_dose', 8, 3)->nullable();
            $table->float('Hp3_calc_dose', 8, 3)->nullable();
            $table->float('Hp3_background_dose', 8, 3)->nullable();
            $table->float('Hp3_raw_dose', 8, 3)->nullable();
            $table->float('H_10_calc_dose', 8, 3)->nullable();
            $table->date('verification_date')->nullable();
            $table->date('verification_required_on_or_before')->nullable();
            $table->integer('remaining_days_available_for_use')->nullable();
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
        Schema::dropIfExists('trabajadordosimetros');
    }
}
