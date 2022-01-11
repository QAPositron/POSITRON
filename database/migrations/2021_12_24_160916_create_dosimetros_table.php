<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosimetrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosimetros', function (Blueprint $table) {
            $table->bigincrements('id_dosimetro')->unique();
            $table->integer('codigo_dosimeter')->unique();
            $table->string('estado_dosimetro');
            $table->string('tecnologia_dosimetro', 30);
            $table->string('tipo_dosimetro', 30);
            $table->date('fecha_ingreso_servicio');
            $table->date('primer_dia_uso')->nullable();
            $table->date('ultimo_dia_uso')->nullable();
            $table->string('ocupacion', 15)->nullable();
            $table->string('periodo_recambio', 30)->nullable();
            $table->string('ubicacion', 30)->nullable();
            $table->string('energia', 30)->nullable();
            $table->date('zero_level_date')->nullable();
            $table->date('measurement_date')->nullable();
            $table->float('Hp007_calc_dose', 8, 5)->nullable();
            $table->float('Hp007_background_dose', 8, 5)->nullable();
            $table->float('Hp007_raw_dose', 8, 5)->nullable();
            $table->float('Hp10_calc_dose', 8, 5)->nullable();
            $table->float('Hp10_background_dose', 8, 5)->nullable();
            $table->float('Hp10_raw_dose', 8, 5)->nullable();
            $table->float('Cu_calc_dose', 8, 5)->nullable();
            $table->float('Cu_background_dose', 8, 5)->nullable();
            $table->float('Cu_raw_dose', 8, 5)->nullable();
            $table->float('Pb/Sn_calc_dose', 8, 5)->nullable();
            $table->float('Pb/Sn_background_dose', 8, 5)->nullable();
            $table->float('Pb/Sn_raw_dose', 8, 5)->nullable();
            $table->float('EzClip_calc_dose', 8, 5)->nullable();
            $table->float('EzClip_background_dose', 8, 5)->nullable();
            $table->float('EzClip_raw_dose', 8, 5)->nullable();
            $table->float('Hp3_calc_dose', 8, 5)->nullable();
            $table->float('Hp3_background_dose', 8, 5)->nullable();
            $table->float('Hp3_raw_dose', 8, 5)->nullable();
            $table->float('H_10_calc_dose', 8, 5)->nullable();
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
        Schema::dropIfExists('dosimetros');
    }
}
