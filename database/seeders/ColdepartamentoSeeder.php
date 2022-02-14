<?php

namespace Database\Seeders;

use App\Models\Coldepartamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColdepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Coldepartamento::truncate(); */

        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "AMAZONAS",
            "abreviatura_deptocol"  => "AMA",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "ANTIOQUIA",
            "abreviatura_deptocol"  => "ANT",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "ARAUCA",
            "abreviatura_deptocol"  => "ARA",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "ATLÁNTICO",
            "abreviatura_deptocol"  => "ATL",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "BOLÍVAR",
            "abreviatura_deptocol"  => "BOL",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "BOYACÁ",
            "abreviatura_deptocol"  => "BOY",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CALDAS",
            "abreviatura_deptocol"  => "CAL",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CAQUETÁ",
            "abreviatura_deptocol"  => "CAQ",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CASANARE",
            "abreviatura_deptocol"  => "CAS",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CAUCA",
            "abreviatura_deptocol"  => "CAU",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CESAR",
            "abreviatura_deptocol"  => "CES",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CHOCÓ",
            "abreviatura_deptocol"  => "CHO",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CÓRDOBA",
            "abreviatura_deptocol"  => "COR",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "CUNDINAMARCA",
            "abreviatura_deptocol"  => "CUN",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "GUAINÍA",
            "abreviatura_deptocol"  => "GUA",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "GUAVIARE",
            "abreviatura_deptocol"  => "GUV",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "HUILA",
            "abreviatura_deptocol"  => "HUI",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "LA GUAJIRA",
            "abreviatura_deptocol"  => "LAG",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "MAGDALENA",
            "abreviatura_deptocol"  => "MAG",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "META",
            "abreviatura_deptocol"  => "MET",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "NARIÑO",
            "abreviatura_deptocol"  => "NAR",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "NORTE DE SANTANDER",
            "abreviatura_deptocol"  => "NSA",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "PUTUMAYO",
            "abreviatura_deptocol"  => "PUT",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "QUINDÍO",
            "abreviatura_deptocol"  => "QUI",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "RISARALDA",
            "abreviatura_deptocol"  => "RIS",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "SAN ANDRÉS Y PROVIDENCIA",
            "abreviatura_deptocol"  => "SAP",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "SANTANDER",
            "abreviatura_deptocol"  => "SAN",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "SUCRE",
            "abreviatura_deptocol"  => "SUC",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "TOLIMA",
            "abreviatura_deptocol"  => "TOL",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "VALLE DEL CAUCA",
            "abreviatura_deptocol"  => "VAC",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "VAUPÉS",
            "abreviatura_deptocol"  => "VAU",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "VICHADA",
            "abreviatura_deptocol"  => "VID",
        ]);
        DB::table("coldepartamentos")->insert([
            "nombre_deptocol"       => "DISTRITO CAPITAL",
            "abreviatura_deptocol"  => "D.C.",
        ]);
    }
}
