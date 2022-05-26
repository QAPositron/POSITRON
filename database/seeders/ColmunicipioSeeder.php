<?php

namespace Database\Seeders;

use App\Models\Colmunicipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColmunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Colmunicipio::truncate(); */
        $muni_amazonas=[
            ['departamentocol_id'=>1, 'nombre_municol' =>'EL ENCANTO', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'LA CHORRERA', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'LA PEDRERA', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'LA VICTORIA','abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'LETICIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'MIRTÍ-PARANÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'P. ALEGRÍA', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'P. ARICA', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'P. NARIÑO', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'P. SANTANDER', 'abrev_municol'=>''],
            ['departamentocol_id'=>1, 'nombre_municol' =>'TARAPACÁ', 'abrev_municol'=>''],
        ];
        Colmunicipio::insert($muni_amazonas);

        $muni_antioquia=[
            ['departamentocol_id'=>2, 'nombre_municol' =>'ABEJORRAL', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ABRIAQUÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ALEJANDRÍA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'AMAGÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'AMALFI', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ANDES', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ANGELÓPOLIS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ANGOSTURA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ANORÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SANTA FE DE ANTIOQUIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'APARTADÓ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ARBOLETES', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LA ARGELIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LA ARMENIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BARBOSA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BELLO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BELMIRA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BETANIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BETULIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BRICEÑO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'BURITICÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CÁCERES', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CAICEDO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CALDAS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CAMPAMENTO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CAÑASGORDAS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CARACOLÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CARAMANTA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CAREPA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CARMEN DE VIBORAL', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CAROLINA DEL PRÍNCIPE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CAUCASIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CHIGORODÓ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CISNEROS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CIUDAD BOLÍVAR', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'COCORNÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CONCEPCIÓN', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'CONCORDIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'COPACABANA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'DABEIBA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'DONMATÍAS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'EBÉJICO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'EL BAGRE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'EL PEÑOL', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'EL RETIRO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'EL SANTUARIO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ENTRERRÍOS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ENVIGADO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'FREDONIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'FRONTINO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GIRALDO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GIRARDOTA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GÓMEZ PLATA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GRANADA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GUADALUPE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GUARNE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'GUATAPÉ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'HELICONIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'HISPANIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ITAGÚI', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ITUANGO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'JARDÍN', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'JERICÓ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LA CEJA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LA ESTRELLA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LA PINTADA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LA UNIÓN', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'LIBORINA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'MACEO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'MARINILLA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'MEDELLÍN', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'MONTEBELLO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'MURINDÓ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'MUTATÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'NARIÑO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'NECHÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'NECOCLÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'OLAYA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'PEQUE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'PUEBLORRICO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'PUERTO BERRÍO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'PUERTO NARE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'PUERTO TRIUNFO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'REMEDIOS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'RIONEGRO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SABANALARGA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SABANETA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SALGAR', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN ANDRÉS DE CUERQUIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN CARLOS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN FRANCISCO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN JERÓNIMO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN JOSÉ DE LA MONTAÑA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN JUAN DE URABÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN LUIS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN ROQUE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN PEDRO DE LOS MILAGROS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN PEDRO DE URABÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN RAFAEL', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN ROQUE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SAN VICENTE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SANTA BÁRBARA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SANTA ROSA DE OSOS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SANTO DOMINGO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SEGOVIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SANSÓN', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'SOPETRÁN', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'TÁMESIS', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'TARAZÁ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'TARSO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'TITIRIBÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'TOLEDO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'TURBO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'URAMITA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'URRAO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'VALDIVIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'VALPARAÍSO', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'VEGACHÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'VENECIA', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'VIGÍA DEL FUERTE', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'YALÍ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'YARUMAL', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'YOLOMBÓ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'YONDÓ', 'abrev_municol'=>''],
            ['departamentocol_id'=>2, 'nombre_municol' =>'ZARAGOZA', 'abrev_municol'=>''],
            
        ];
        Colmunicipio::insert($muni_antioquia);


        /* DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"EL ENCANTO",
            "abrev_municol"        =>"El E/TO",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"LA CHORRERA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"LA PEDRERA",
            "abrev_municol"        =>"LA P/ERA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"LA VICTORIA",
            "abrev_municol"        =>"LA V/RIA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"LETICIA",
            "abrev_municol"        =>"L/CIA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"MIRTÍ-PARANÁ",
            "abrev_municol"        =>"M/TÍ-P/NÁ",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"PUERTO ALEGRÍA",
            "abrev_municol"        =>"P.A/GRÍA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"P. ARICA",
            "abrev_municol"        =>"P.A/CA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"P. NARIÑO",
            "abrev_municol"        =>"P.N/ÑO",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"P. SANTANDER",
            "abrev_municol"        =>"P.S/DER",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "1",
            "nombre_municol"       =>"TARAPACÁ",
            "abrev_municol"        =>"T/CÁ",
        ]);*/

        /* DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ABEJORRAL",
            "abrev_municol"        =>"A/RRAL",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ABRIAQUÍ",
            "abrev_municol"        =>"A/QUÍ",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ALEJANDRÍA",
            "abrev_municol"        =>"A/DRÍA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"AMAGÁ",
            "abrev_municol"        =>"A/GÁ",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"AMALFI",
            "abrev_municol"        =>"A/FI",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ANDES",
            "abrev_municol"        =>"ANDES",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ANGELÓPOLIS",
            "abrev_municol"        =>"A/LIS",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ANGOSTURA",
            "abrev_municol"        =>"A/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ANORÍ",
            "abrev_municol"        =>"ANORÍ",
        ]); 
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SANTA FE DE ANTIOQUIA",
            "abrev_municol"        =>"S.F.ANT",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ANZÁ",
            "abrev_municol"        =>"ANZÁ",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"APARTADÓ",
            "abrev_municol"        =>"A/DÓ",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ARBOLETES",
            "abrev_municol"        =>"A/LES",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LA ARGELIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LA ARMENIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BARBOSA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BELLO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BELMIRA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BETANIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BETULIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BRICEÑO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"BURITICÁ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CÁCERES",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CAICEDO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CALDAS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CAMPAMENTO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CAÑASGORDAS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CARACOLÍ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CARAMANTA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CAREPA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CARMEN DE VIBORAL",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CAROLINA DEL PRÍNCIPE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CAUCASIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CHIGORODÓ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CISNEROS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CIUDAD BOLÍVAR",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"COCORNÁ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CONCEPCIÓN",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"CONCORDIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"COPACABANA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"DABEIBA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"DONMATÍAS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"EBÉJICO",
            "abrev_municol"        =>"LA C/RA",
        ]);DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"EL BAGRE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"EL PEÑOL",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"EL RETIRO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"EL SANTUARIO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ENTRERRÍOS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ENVIGADO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"FREDONIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"FRONTINO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GIRALDO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GIRARDOTA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GÓMEZ PLATA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GRANADA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GUADALUPE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GUARNE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"GUATAPÉ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"HELICONIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"HISPANIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ITAGÚI",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ITUANGO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"JARDÍN",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"JERICÓ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LA CEJA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LA ESTRELLA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LA PINTADA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LA UNIÓN",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"LIBORINA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"MACEO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"MARINILLA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"MEDELLÍN",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"MONTEBELLO",
            "abrev_municol"        =>"LA C/RA",
        ]);DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"MURINDÓ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"MUTATÁ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"NARIÑO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"NECHÍ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"NECOCLÍ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"OLAYA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"PEQUE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"PUEBLORRICO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"PUERTO BERRÍO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"PUERTO NARE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"PUERTO TRIUNFO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"REMEDIOS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"RIONEGRO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SABANALARGA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SABANETA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SALGAR",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN ANDRÉS DE CUERQUIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN CARLOS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN FRANCISCO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN JERÓNIMO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN JOSÉ DE LA MONTAÑA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN JUAN DE URABÁ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN LUIS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN PEDRO DE LOS MILAGROS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN PEDRO DE URABÁ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN RAFAEL",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN ROQUE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SAN VICENTE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SANTA BÁRBARA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SANTA ROSA DE OSOS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SANTO DOMINGO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SEGOVIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SANSÓN",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"SOPETRÁN ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"TÁMESIS",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"TARAZÁ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"TARSO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"TITIRIBÍ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"TOLEDO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"TURBO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"URAMITA",
            "abrev_municol"        =>"LA C/RA",
        ]);

        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"URRAO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"VALDIVIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"VALPARAÍSO",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"VEGACHÍ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"VENECIA",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"VIGÍA DEL FUERTE",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"YALÍ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"YARUMAL",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"YOLOMBÓ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"YONDÓ",
            "abrev_municol"        =>"LA C/RA",
        ]);
        DB::table("colmunicipios")->insert([
            "departamentocol_id"   => "2",
            "nombre_municol"       =>"ZARAGOZA",
            "abrev_municol"        =>"LA C/RA",
        ]);*/

        $muni_arauca=[
            ['departamentocol_id'=>3, 'nombre_municol' =>'ARAUCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'ARAUQUITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'CLAVO NORTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'FORTUL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'PUERTO RONDÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'SARAVENA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'TAME', 'abrev_municol'=>' '],
            ['departamentocol_id'=>3, 'nombre_municol' =>'BARANOA', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($muni_arauca);

        $muni_atlantico=[
            ['departamentocol_id'=>4, 'nombre_municol' =>'BARANOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'BARRANQUILLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'CAMPO DE LA CRUZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'CANDELARIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'GALAPA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'JUAN DE ACOSTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'LURUACO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'MALAMBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'MANATÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'PALMAR DE VARELA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'PIOJÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'POLONUEVO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'PONEDERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'PUERTO COLOMBIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'REPELÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'SABANAGRANDE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'SANTA LUCÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'SANTO TOMÁS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'SOLEDAD', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'SUÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'TUBARÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>4, 'nombre_municol' =>'USIACURÍ', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($muni_atlantico);

        $muni_bolivar=[
            ['departamentocol_id'=>5, 'nombre_municol' =>'ACHÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'ALTOS DEL ROSARIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'ARENAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'ARJONA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'ARROYOHONDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'BARRANCO DE LOBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'BRAZUELO DE PAPAYAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'CALAMAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'CANTAGALLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'CARTAGENA DE INDIAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'CICUCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'CLEMENCIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'CÓRDOBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'EL CARMEN DE BOLÍVAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'EL GUAMO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'EL PEÑÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'HATILLO DE LOBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'MAGANGUÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'MAHATES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'MARGARITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'MARÍA LA BAJA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'MONTECRISTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'MORALES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'NOROSÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'PINILLOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'REGIDOR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'RÍO VIEJO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN CRISTÓBAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN ESTANISLAO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN FERNANDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN JACINTO DEL CAUCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN JUAN NEPOMUCENO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN MARTÍN DE LOBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SAN PABLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SANTA CATALINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SANTA CRUZ DE MOMPOX', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SANTA ROSA DE LIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SANTA ROSA DEL SUR ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SIMITÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'SOPLAVIENTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'TALAIGUA NUEVO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'TIQUISIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'TURBACO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'TURBANÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'VILLANUEVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>5, 'nombre_municol' =>'ZAMBRANO', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($muni_bolivar);

        $muni_boyaca=[
            ['departamentocol_id'=>6, 'nombre_municol' =>'AQUITANIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'ARCABUCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BELÉN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BERBEO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BETÉITIVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BOAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BOYACÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BRICEÑO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BUENAVISTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'BUSBANZÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CALDAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CAMPOHERMOSO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CERINZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHINAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHIQUINQUIRÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHÍQUIZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHISCAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHITARAQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHIVATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CHIVOR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CIÉNEGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CÓMBITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'COPER', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CORRALES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'COVARACHÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CUBARÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CUCAITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'CUÍTIVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'DUITAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'EL COCUY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'EL ESPINO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'FIRAVITOBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'FLORESTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GACHANTIVÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GÁMEZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GARAGOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GUACAMAYAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GUATEQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GUAYATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'GÜICÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'IZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'JENESANO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'JERICÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'LA CAPILLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'LA UVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'LA VICTORIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'LABRANZAGRANDE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MACANAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MARIPÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MIRAFLORES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MONGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MONGUÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MONIQUIRÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MOTAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'MUZO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'NOBSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'NUEVO COLÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'OICATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'OTANCHE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PACHAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PÁEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PAIPA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PAJARITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PANQUEBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PAUNA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PAYA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PAZ DE RÍO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PESCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PISBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'PUERTO BOYACÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'QUÍPAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'RAMIRIQUÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'RÁQUIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'RONDÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SABOYÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SÁCHICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAMACÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAN EDUARDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAN JOSÉ DE PARE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAN LUIS DE GACENO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAN MATEO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAN MIGUEL DE SEMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SAN PABLO DE BORBUR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SANTA MARÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SANTA ROSA DE VITERBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SANTA SOFÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SANTANA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SATIVANORTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SATIVASUR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SIACHOQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SOATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SOCHA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>6, 'nombre_municol' =>'SOCOTÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SOGAMOSO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SOMONDOCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SORA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SORACÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SOTAQUIRÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SUSACÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SUTAMARCHÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'SUTATENZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TASCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TENZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TIBANÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TIBASOSA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>6, 'nombre_municol' =>'TINJACÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TIPACOQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TOCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TOGÜÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TÓPAGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TOTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TUNJA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TUNUNGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TURMEQUÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TUTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'TUTAZÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'ÚMBITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'VENTAQUEMADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'VILLA DE LEYVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'VIRACACHÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>6, 'nombre_municol' =>'ZETAQUIRA', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($muni_boyaca);

        $muni_caldas=[
            ['departamentocol_id'=>7, 'nombre_municol' =>'AGUADAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'ANSERMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'ARANZAZU', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'BELALCÁZAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'CHINCHINÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'FILADELFIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'LA DORADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'LA MERCED', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'MANIZALES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'MANZANARES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'MARMATO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'MARQUETALIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'MARULANDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'NEIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'NORCASIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'PÁCORA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'PALESTINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'PENSILVANIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'RIOSUCIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'RISARALDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'SALAMINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'SAMANÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'SAN JOSÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'SUPÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'VICTORIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'VILLAMARÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>7, 'nombre_municol' =>'VITERBO', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($muni_caldas);

        $muni_caqueta=[
            ['departamentocol_id'=>8, 'nombre_municol' =>'ALBANIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'BELÉN DE LOS ANDAQUIES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'CARTAGENA DEL CHAIRÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'CURILLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'EL DONCELLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'EL PAUJIL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'FLORENCIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'LA MONTAÑITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'MORELIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'PUERTO MILÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'PUERTO RICO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'SAN JOSÉ DEL FRAGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'SAN VICENTE DEL CAGUÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'SOLANO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'SOLITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>8, 'nombre_municol' =>'VALPARAÍSO', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($muni_caqueta);

        $mun_casanare=[
            ['departamentocol_id'=>9, 'nombre_municol' =>'AGUAZUL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'CHÁMEZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'HATO COROZAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'LA SALINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'MANÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'MONTERREY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'NUNCHÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'OROCUÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'PAZ DE ARIPORO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'PORE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'RECETOR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'SABANALARGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'SÁCAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'SAN LUIS DE PALENQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'TÁMARA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'TAURAMENA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'TRINIDAD', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'VILLANUEVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>9, 'nombre_municol' =>'YOPAL', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_casanare);

        $mun_cauca=[
            ['departamentocol_id'=>10, 'nombre_municol' =>'ALMAGUER', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'ARGELIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'BALBOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'BOLÍVAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'BUENOS AIRES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'CAJIBÍO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'CALDONO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'CALOTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'CORINTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'EL TAMBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'FLORENCIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'GUACHENÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'GUAPÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'INZÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'JAMBALÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'LA SIERRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'LA VEGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'LÓPEZ DE MICAY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'MERCADERES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'MIRANDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'MORALES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PADILLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PÁEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PATÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PIAMONTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PIENDAMÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'POPAYÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PUERTO TEJADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'PURACÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'ROSAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SAN SEBASTIÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SANTA ROSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SANTANDER DE QUILICHAO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SILVIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SOTARÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SUÁREZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'SUCRE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'TIMBÍO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'TIMBIQUÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'TORIBÍO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'TOTORÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>10, 'nombre_municol' =>'VILLA RICA', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_cauca);

        $mun_cesar=[
            ['departamentocol_id'=>11, 'nombre_municol' =>'AGUACHICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'AGUSTÍN CODAZZI', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'ASTREA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'BECERRIL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'BOSCONIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'CHIMICHAGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'CHIRIGUANÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'CURUMANÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'EL COPEY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'EL PASO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'GAMARRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'GONZÁLEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'LA GLORIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'LA JAGUA DE IBIRICO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'LA PAZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'MANAURE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'PAILITAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'PELAYA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'PUEBLO BELLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'RÍO DE ORO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'SAN ALBERTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'SAN DIEGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'SAN MARTÍN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'TAMALAMEQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>11, 'nombre_municol' =>'VALLEDUPAR', 'abrev_municol'=>' '],
            
        ];
        Colmunicipio::insert($mun_cesar);

        $mun_choco=[
            ['departamentocol_id'=>12, 'nombre_municol' =>'ACANDÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'ALTO BAUDÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'BAGADÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'BAHÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'BAJO BAUDÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'BOJAYÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'CÉRTEGUI', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'CONDOTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'CANTÓN DE SAN PABLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'EL ATRATO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'EL CARMEN DE ATRATO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'EL CARMEN DEL DARIÉN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'EL LITORAL DE SAN JUAN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'ISTMINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'JURADÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'LLORÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'MEDIO ATRATO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'MEDIO BAUDÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'MEDIO SAN JUAN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'NÓVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'NUQUÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'QUIBDÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'RÍO IRÓ	', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'RÍO QUITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'RIOSUCIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'SAN JOSÉ DEL PALMAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'SIPÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'TADÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'UNGUÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>12, 'nombre_municol' =>'UNIÓN PANAMERICANA', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_choco);

        $mun_cordoba=[
            ['departamentocol_id'=>13, 'nombre_municol' =>'AYAPEL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'BUENAVISTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'CANALETE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'CERETÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'CHIMÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'CHINÚ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'CIÉNAGA DE ORO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'COTORRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'LA APARTADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'LOS CÓRDOBAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'MOMIL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'MONTELÍBANO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'MONTERÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'MOÑITOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'PLANETA RICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'PUEBLO NUEVO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'PUERTO ESCONDIDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'PUERTO LIBERTADOR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'PURÍSIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAHAGÚN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAN ANDRÉS DE SOTAVENTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAN ANTERO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAN BERNARDO DEL VIENTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAN CARLOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAN JOSÉ DE URÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SAN PELAYO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'SANTA CRUZ DE LORICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'TIERRALTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'TUCHÍN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>13, 'nombre_municol' =>'VALENCIA', 'abrev_municol'=>' '],

        ];
        Colmunicipio::insert($mun_cordoba);

        $mun_cundinamarca=[
            ['departamentocol_id'=>14, 'nombre_municol' =>'AGUA DE DIOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ALBÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ANAPOIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ANOLAIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'APULO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ARBELAÉZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'BELTRÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'BITUIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'BOJACÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CABRERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CACHIPAY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CAJICÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CAPARRAPÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CÁQUEZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CARMEN DE CARUPA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CHAGUANÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CHÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CHIPAQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CHOACHÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CHOCONTÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'COGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'COTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'CUCUNUBÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'EL COLEGIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'EL PEÑÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'EL ROSAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'FACATATIVÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'FÓMEQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'FOSCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'FUNZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'FÚQUENE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'FUSAGASUGÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GACHALÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GACHANCIPÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GACHETÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GIRARDOT', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GRANADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUACHETÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUADUAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUASCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUATAQUÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUATAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUAYABAL DE SÍQUIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUAYABETAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'GUTIÉRREZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'JERUSALÉN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'JUNÍN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'LA CALERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'LA MESA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'LA PALMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'LA PEÑA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'LA VEGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'LENGUAZAQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'MACHETÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'MADRID', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'MANTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'MEDINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'MOSQUERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'NARIÑO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'NEMOCÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'NILO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'NIMAIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'NOCAIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PACHO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PAIME', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PANDI', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PARATEBUENO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PASCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PUERTO SALGAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'PULÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'QUEBRADANEGRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'QUETAME', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'QUIPILE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'RICAURTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SAN ANTONIO DEL TEQUENDAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SAN BERNARDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SAN CAYETANO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SAN FRANCISCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SAN JUAN DE RIOSECO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SASAIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SESQUILÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SIBATÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SILVANIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SIMIJACA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SOACHA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SOPÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SUBACHOQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SUESCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SUPATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SUSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'SUTATAUSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TABIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TAUSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TENA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TENJO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TIBACUY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TIBIRITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TOCAIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TOCANCIPÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'TOPAIPÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'UBALÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'UBAQUE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'UBATÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'UNE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ÚTICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VENECIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VERGARA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VIANÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VILLAGÓMEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VILLAPINZÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VILLETA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'VIOTÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'YACOPÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ZIPACÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>14, 'nombre_municol' =>'ZIPAQUIRÁ', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_cundinamarca);

        $mun_discapital = [
            ['departamentocol_id'=>33, 'nombre_municol' =>'BOGOTÁ', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_discapital);

        $mun_guania=[
            ['departamentocol_id'=>15, 'nombre_municol' =>'BARRANCOMINAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'CACAHUAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'INÍRIDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'LA GUADALUPE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'MORICHAL NUEVO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'PANA PANA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'PUERTO COLOMBIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>15, 'nombre_municol' =>'SAN FELIPE', 'abrev_municol'=>' '],
            
        ];
        Colmunicipio::insert($mun_guania);

        $mun_guaviare=[
            ['departamentocol_id'=>16, 'nombre_municol' =>'CALAMAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>16, 'nombre_municol' =>'EL RETORNO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>16, 'nombre_municol' =>'MIRAFLORES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>16, 'nombre_municol' =>'MIRAFLORES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>16, 'nombre_municol' =>'SAN JOSÉ DEL GUAVIARE', 'abrev_municol'=>' '],
            
        ];
        Colmunicipio::insert($mun_guaviare);

        $mun_huila=[
            ['departamentocol_id'=>17, 'nombre_municol' =>'ACEVEDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'AGRADO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'AIPE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'ALGECIRAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'ALTAMIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'BARAYA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'CAMPOALEGRE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'COLOMBIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'ELÍAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'EL PITAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'GARZÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'GIGANTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'GUADALUPE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'HOBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'ÍQUIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'ISNOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'LA ARGENTINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'LA PLATA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'NÁTAGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'NEIVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'OPORAPA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'PAICOL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'PALERMO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'PALESTINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'PITALITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'RIVERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'SALADOBLANCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'SAN AGUSTÍN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'SANTA MARÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'SUAZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'TARQUI', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'TELLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'TERUEL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'TESALIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'TIMANÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'VILLAVIEJA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>17, 'nombre_municol' =>'YAGUARÁ', 'abrev_municol'=>' '],

        ];
        Colmunicipio::insert($mun_huila);

        $mun_guajira = [
            ['departamentocol_id'=>18, 'nombre_municol' =>'ALBANIA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'BARRANCAS', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'DIBULLA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'DISTRACCIÓN', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'EL MOLINO', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'FONSECA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'HATONUEVO', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'LA JAGUA DEL PILAR', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'MAICAO', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'MANAURE', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'RIOHACHA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'SAN JUAN DEL CESAR', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'URIBIA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'URUMITA', 'abrev_municol'=>' '], 
            ['departamentocol_id'=>18, 'nombre_municol' =>'VILLANUEVA', 'abrev_municol'=>' '], 

        ];
        Colmunicipio::insert($mun_guajira);

        $mun_magdalena=[
            ['departamentocol_id'=>19, 'nombre_municol' =>'ALGARROBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'ARACATACA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'ARIGUANÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'CERRO DE SAN ANTONIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'CHIBOLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'CIÉNAGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'CONCORDIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'EL BANCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'EL PIÑÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'EL RETÉN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'FUNDACIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'GUAMAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'NUAVA GRANADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'PEDRAZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'PIJIÑO DEL CARMEN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'PIVIJAY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'PLATO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'PUEBLO VIEJO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'REMOLINO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SABANAS DE SAN ÁNGEL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SALAMINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SAN SEBASTIÁN DE BUENAVISTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SAN ZENÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SANTA ANA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SANTA BÁRBARA DE PINTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SANTA MARTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'SITIONUEVO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'TENERIFE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'ZAPAYÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>19, 'nombre_municol' =>'ZONA BANANERA', 'abrev_municol'=>' '],

        ];
        Colmunicipio::insert($mun_magdalena);

        $mun_meta=[
            ['departamentocol_id'=>20, 'nombre_municol' =>'ACACÍAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'BARRANCA DE UPÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'CABUYARO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'CASTILLA LA NUEVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'CUBARRAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'CUMARAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'EL CALVARIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'EL CASTILLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'EL DORADO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'FUENTE DE ORO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'GRANADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'GUAMAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'LA MACARENA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'LA URIBE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'LEJANÍAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'MAPIRIPÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'MESETAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'PUERTO CONCORDIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'PUERTO GAITÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'PUERTO LLERAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'PUERTO LÓPEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'PUERTO RICO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'RESTREPO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'SAN CARLOS DE GUAROA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'SAN JUAN DE ARAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'SAN JUANITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'SAN MARTÍN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'VILLAVICENCIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>20, 'nombre_municol' =>'VISTA HERMOSA', 'abrev_municol'=>' '],
            
        ];
        Colmunicipio::insert($mun_meta);

        $mun_nariño=[
            ['departamentocol_id'=>21, 'nombre_municol' =>'LA CRUZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LA FLORIDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LA LLANADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LA TOLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LA UNIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LEIVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LINARES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'LOS ANDES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'MAGÜÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'MALLAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'MOSQUERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'NARIÑO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'OLAYA HERRERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'OSPINA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'PASTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'POLICARPA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'POTOSÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'PROVIDENCIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'PUERRES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'PUPIALES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'RICAURTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'ROBERTO PAYÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SAMANIEGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SAN BERNARDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SAN LORENZO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SAN PABLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SAN PEDRO DE CARTAGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SANDONÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SANTA BÁRBARA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SANTACRUZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'SAPUYES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'TAMINANGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'TANGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'TUMACO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>21, 'nombre_municol' =>'TÚQUERRES', 'abrev_municol'=>' '],

            ['departamentocol_id'=>21, 'nombre_municol' =>'YACUANQUER', 'abrev_municol'=>' '],
            
        ];
        Colmunicipio::insert($mun_nariño);        

        $mun_nortesant = [
            ['departamentocol_id'=>22, 'nombre_municol' =>'ÁBREGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'ARBOLEDAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'BOCHALEMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'BUCARASICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CÁCHIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CÁCOTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CHINÁCOTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CHITAGÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CONVENCIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CÚCUTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'CUCUTILLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'DURANIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'EL CARMEN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'EL TARRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'EL ZULIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'GRAMALOTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'HACARÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'HERRÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'LA ESPERANZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'LA PLAYA DE BELÉN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'LABATECA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'LOS PATIOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'LOURDES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'MUTISCUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'OCAÑA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'PAMPLONA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'PAMPLONITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'PUERTO SANTANDER', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'RAGONVALIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'SALAZAR DE LAS PALMAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'SAN CALIXTO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'SAN CAYETANO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'SANTIAGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'SANTO DOMINGO DE SILOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'SARDINATA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'TEORAMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'TIBÚ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'TOLEDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'VILLA CARO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>22, 'nombre_municol' =>'VILLA DEL ROSARIO', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_nortesant);

        $mun_putumayo=[
            ['departamentocol_id'=>23, 'nombre_municol' =>'COLÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'MOCOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'ORITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'PUERTO ASÍS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'PUERTO CAICEDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'PUERTO GUZMÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'PUERTO LEGUÍZAMO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'SAN FRANCISCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'SAN MIGUEL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'SANTIAGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'SIBUNDOY', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'VALLE DEL GUAMUEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>23, 'nombre_municol' =>'VILLAGARZÓN', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_putumayo);

        $mun_quindio=[
            ['departamentocol_id'=>24, 'nombre_municol' =>'ARMENIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'BUENAVISTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'CALARCÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'CIRCASIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'CÓRDOBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'FILANDIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'GÉNOVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'LA TEBAIDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'MONTENEGRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'PIJAO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'QUIMBAYA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>24, 'nombre_municol' =>'SALENTO', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_quindio);

        $mun_risaralda=[
            ['departamentocol_id'=>25, 'nombre_municol' =>'APÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'BALBOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'BELÉN DE UMBRÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'DOSQUEBRADAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'GUÁTICA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'LA CELIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'LA VIRGINIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'MARSELLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'MISTRATÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'PEREIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'PUEBLO RICO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'QUINCHÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'SANTA ROSA DE CABAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>25, 'nombre_municol' =>'SANTUARIO', 'abrev_municol'=>' '],

        ];
        Colmunicipio::insert($mun_risaralda);

        $mun_sanandres=[
            ['departamentocol_id'=>26, 'nombre_municol' =>'PROVIDENCIA Y SANTA CATALINA ISLAS', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_sanandres);

        $mun_santander=[
            ['departamentocol_id'=>27, 'nombre_municol' =>'AGUADA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'ALBANIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'ARATOCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'BARBOSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'BARICHARA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'BARRANCABERMEJA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'BETULIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'BOLÍVAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'BUCARAMANGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CABRERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CALIFORNIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CAPITANEJO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CARCASÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CEPITÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CERRITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CHARALÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CHARTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CHIMA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CHIPATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CIMITARRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CONCEPCIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CONFINES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CONTRATACIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'COROMORO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'CURITÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'EL CARMEN DE CHUCURÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'EL GUACAMAYO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'EL PEÑÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'EL PLAYÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'ENCINO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'ENCISO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'FLORIÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'FLORIDABLANCA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GALÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GÁMBITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GUACA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GUADALUPE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GUAPOTÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GUAVATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'GÜEPSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'HATO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'JESÚS MARÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'JORDÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'LA BELLEZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'LA PAZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'LANDÁZURI', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'LEBRIJA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'LOS SANTOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'MACARAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'MÁLAGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'MATANZA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'MOGOTES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'MOLAGAVITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'OCAMONTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'OIBA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'ONZAGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PALMAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PALMAS DEL SOCORRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PÁRAMO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PIEDECUESTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PINCHOTE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PUENTE NACIONAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PUERTO PARRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'PUERTO WILCHES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'RIONEGRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SABANA DE TORRES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN ANDRÉS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN BENITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN GIL	BANDERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN JOAQUÍN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN JOSÉ DE MIRANDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN JUAN DE GIRÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN MIGUEL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SAN VICENTE DE CHUCURÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SANTA BÁRBARA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SANTA HELENA DEL OPÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SIMACOTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'EL SOCORRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SUAITA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SUCRE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'SURATÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'TONA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'VALLE DE SAN JOSÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'VÉLEZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'VETAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'VILLANUEVA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>27, 'nombre_municol' =>'ZAPATOCA', 'abrev_municol'=>' '],
            
        ];
        Colmunicipio::insert($mun_santander);

        $mun_sucre=[
            ['departamentocol_id'=>28, 'nombre_municol' =>'BUENAVISTA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'CAIMITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'CHALÁN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'COLOSÓ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'COROZAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'COVEÑAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'EL ROBLE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'GALERAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'GUARANDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'LA UNIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'LOS PALMITOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'MAJAGUAL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'MORROA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'OVEJAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAN ANTONIO DE PALMITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAMPUÉS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAN BENITO ABAD', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAN JUAN DE BETULIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAN MARCOS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAN ONOFRE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SAN PEDRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SANTIAGO DE TOLÚ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SINCÉ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SINCELEJO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'SUCRE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>28, 'nombre_municol' =>'TOLÚ VIEJO', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_sucre);

        $mun_tolima=[
            ['departamentocol_id'=>29, 'nombre_municol' =>'NATAGAIMA', 'abrev_municol'=>' '],            
            ['departamentocol_id'=>29, 'nombre_municol' =>'ORTEGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'PALOCABILDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'PIEDRAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'PLANADAS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'PRADO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'PURIFICACIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'RIOBLANCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'RONCESVALLES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'ROVIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'SALDAÑA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'SAN ANTONIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'SAN LUIS', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'SANTA ISABEL', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'SUÁREZ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'VALLE DE SAN JUAN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'VENADILLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'VILLAHERMOSA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>29, 'nombre_municol' =>'VILLARRICA', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_tolima);

        $mun_vallecauca=[
            ['departamentocol_id'=>30, 'nombre_municol' =>'ALCALÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'ANDALUCÍA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'ANSERMANUEVO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'ARGELIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'BOLÍVAR', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'BUENAVENTURA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'BUGA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'BUGALAGRANDE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'CAICEDONIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'CALI', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'CANDELARIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'CARTAGO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'DAGUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'DARIÉN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'EL ÁGUILA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'EL CAIRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'EL CERRITO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'EL DOVIO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'FLORIDA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'GINEBRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'GUACARÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'JAMUNDÍ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'LA CUMBRE', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'LA UNIÓN', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'LA VICTORIA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'OBANDO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'PALMIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'PRADERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'RESTREPO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'RIOFRÍO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'ROLDANILLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'SAN PEDRO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'SEVILLA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'TORO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'TRUJILLO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'TULUÁ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'ULLOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'VERSALLES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'VIJES', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'YOTOCO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'YUMBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>30, 'nombre_municol' =>'ZARZAL', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_vallecauca);

        $mun_vapues=[
            ['departamentocol_id'=>31, 'nombre_municol' =>'CARURÚ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>31, 'nombre_municol' =>'MITÚ', 'abrev_municol'=>' '],
            ['departamentocol_id'=>31, 'nombre_municol' =>'PACOA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>31, 'nombre_municol' =>'PAPUNAUA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>31, 'nombre_municol' =>'TARAIRA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>31, 'nombre_municol' =>'YAVARATÉ', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_vapues);

        $mun_vichada=[
            ['departamentocol_id'=>32, 'nombre_municol' =>'CUMARIBO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>32, 'nombre_municol' =>'LA PRIMAVERA', 'abrev_municol'=>' '],
            ['departamentocol_id'=>32, 'nombre_municol' =>'PUERTO CARREÑO', 'abrev_municol'=>' '],
            ['departamentocol_id'=>32, 'nombre_municol' =>'SANTA ROSALÍA', 'abrev_municol'=>' '],
        ];
        Colmunicipio::insert($mun_vichada);
    }
}
