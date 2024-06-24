<style>
    @page {
        margin: 0cm 0cm;
    } 
    body{
        /* background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 13px;
        margin-top: 1cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 0.5cm;
    }
    header{
        position: fixed;
        top: 1cm;
        left: 2cm;
        right: 2cm;
        height: 90px;
        /* background: blue; */
    }
    footer{
        position: fixed;
        bottom: 2cm; 
        left: 2cm; 
        right: 2cm;
        height: 1.5cm;
        margin-top: 100px;
        text-align:center;
        color:#01584d;
        /* background: yellowgreen; */
       
    }
    footer p {
        margin: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
       
        /* background: yellow; */
    }
    main{
        position: relative;
        top: 125px;
        left: 0cm;
        right: 0cm;
        margin-bottom: 4.5cm;
        display:block;
       /*  background: yellow; */
    }
    main p {
        margin: 0px;
        padding-top: 2px;
        padding-bottom:2px;
        line-height: 130%;
    }
</style> 
<body>  
    <header>
        <table width="100%" style="border-collapse:collapse; position:absolute;" cellpadding="3">
            <tr>
                <td rowspan="4" style="text-align:center; width: 150px; border:0.1px solid black;">
                    <img src="{{asset('imagenes/LOGO_QA_VERDE.png')}}" width="165">
                </td>
                <td rowspan="4" style="text-align:center; border:0.1px solid black;">
                    SISTEMA INTEGRADO DE GESTION DE CALIDAD <br><br>
                    <label style="color:#1A9980;"><b>FORMATO HISTORIAL DOSIMETRICO PERSONAL</b></label>
                </td>
                <td style="text-align:center; border:0.1px solid black;">Código: <label style="color: #1A9980;"><b>QA-DP-F003</b></label></td>
            </tr>
            <tr>
                <td style="text-align:center; border:0.1px solid black;">Página: <label style="color: #1A9980;"><b>1 de 1</b></label></td>
            </tr>
            <tr>
                <td style="text-align:center; border:0.1px solid black;">Versión: <label style="color: #1A9980;"><b>1.0</b></label></td>
            </tr>
            <tr>
                <td style="text-align:center; border:0.1px solid black;">Vigente a partir de:<br><label style="color: #1A9980;"><b>01 marzo 2023</b></label></td>
            </tr>
        </table>
    </header>
    <footer>
        <p>____________________________________________________________________________________________</p>
        <p>Servicio de dosimetría personal mediante tecnología de BeOSL. Lic. QAP-001 2023 de Min. Minas y Energía.</p>
        <p >Servicios en protección radiológica y controles de calidad - Res. 09472 de 2020 de Sec. Salud Santander</p>
        <p style="top:30px;">dosimetria.qapositron@gmail.com – 301 449 5401 – 310 607 9375 – 304 338 6581</p>
        <p>E-mail: dosimetria@qapositron.com</p>
        <p>www.qapositron.com</p>
    </footer>
    <main>
        <table width="100%" style="border-collapse:collapse;" cellpadding="3">
            <tr>
                <th colspan="4" style=" background-color: #1A9980; color:white">1.  INFORMACIÓN TOE</th>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right; width: 150px; background-color:#ECEFEE;">Nombres y apellidos:</td>
                <td style="border:0.1px solid black;">{{$persona->primer_nombre_persona}} {{$persona->segundo_nombre_persona}} {{$persona->primer_apellido_persona}} {{$persona->segundo_apellido_persona}}</td>
                <td style="border:0.1px solid black; text-align: right; width: 120px; background-color:#ECEFEE;">Fecha de ingreso:</td>
                <td style="border:0.1px solid black;">{{$fechainiciodositrabaj->primer_dia_uso}}</td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right; width: 150px; background-color:#ECEFEE;">Cédula:</td>
                <td style="border:0.1px solid black;">{{$persona->cedula_persona}}</td>
                <td style="border:0.1px solid black; text-align: right; width: 120px; background-color:#ECEFEE;">Fecha de retiro:</td>
                <td style="border:0.1px solid black;">
                    
                </td>
            </tr>
        </table>
        <br>
        <table width="100%" style="border-collapse:collapse;" cellpadding="3">
            <tr>
                <th colspan="4" style=" background-color: #1A9980; color:white">2. RESUMEN DE DOSIMETRÍA PERSONAL</th>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE; width: 170px;">Dosis (mSv)</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Tejido Profundo <br>Hp(10) mSv</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Cristalino <br>Hp(3) mSv</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Extremidades o piel <br>Hp(0.07) mSv</td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right; background-color:#ECEFEE; width: 170px;">Último mes:</td>
                <td style="border:0.1px solid black; text-align: center;">
                    @if($ultimadositrabaj->ubicacion != 'CRISTALINO' &&  $ultimadositrabaj->Hp10_dif_dosicont >= 0)
                        {{$ultimadositrabaj->Hp10_dif_dosicont}}
                    @else
                        0
                    @endif
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @if($ultimadositrabaj->ubicacion == 'CRISTALINO' && $ultimadositrabaj->Hp3_dif_dosicont >= 0)
                        {{$ultimadositrabaj->Hp3_dif_dosicont}}
                    @else
                        0
                    @endif
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @if($ultimadositrabaj->ubicacion != 'CRISTALINO' && $ultimadositrabaj->Hp007_dif_dosicont >= 0)
                        {{$ultimadositrabaj->Hp007_dif_dosicont}}
                    @else
                        0
                    @endif
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right; background-color:#ECEFEE; width: 170px;">Dosis 12 meses anteriores:</td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $date1 = new DateTime($finiperiodo);
                        $sumaHp10calcdosex1 = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @php
                            $date2 = new DateTime($asig->primer_dia_uso);
                            $diferencia = $date2->diff($date1);
                            $diff = $diferencia->format('%y');
                            if($diff < 1 && $asig->ubicacion != 'CRISTALINO' && $asig->Hp10_dif_dosicont >= 0){
                                $sumaHp10calcdosex1 += $asig->Hp10_dif_dosicont;
                            }
                        @endphp
                    @endforeach
                    {{$sumaHp10calcdosex1}}
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $date1 = new DateTime($finiperiodo);
                        $sumaHp3calcdosex1 = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @php
                            $date2 = new DateTime($asig->primer_dia_uso);
                            $diferencia = $date2->diff($date1);
                            $diff = $diferencia->format('%y');
                            if($diff < 1 && $asig->ubicacion == 'CRISTALINO' && $asig->Hp3_dif_dosicont >= 0){
                                $sumaHp3calcdosex1 += $asig->Hp3_dif_dosicont;
                            }
                        @endphp
                    @endforeach
                    {{$sumaHp3calcdosex1}}
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $date1 = new DateTime($finiperiodo);
                        $sumaHp007calcdosex1 = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @php
                            $date2 = new DateTime($asig->primer_dia_uso);
                            $diferencia = $date2->diff($date1);
                            $diff = $diferencia->format('%y');
                            if($diff < 1 && $asig->ubicacion != 'CRISTALINO' && $asig->Hp007_dif_dosicont >= 0){
                                $sumaHp007calcdosex1 += $asig->Hp007_dif_dosicont;
                            }
                        @endphp
                    @endforeach
                    {{$sumaHp007calcdosex1}}
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right; background-color:#ECEFEE; width: 170px;">Dosis en cinco años:</td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $date1 = new DateTime($finiperiodo);
                        $sumaHp10calcdosex5 = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @php
                            $date2 = new DateTime($asig->primer_dia_uso);
                            $diferencia = $date2->diff($date1);
                            $diff = $diferencia->format('%y');
                            if($diff < 5 && $asig->ubicacion != 'CRISTALINO' && $asig->Hp10_dif_dosicont >= 0){
                                $sumaHp10calcdosex5 += $asig->Hp10_dif_dosicont;
                            }
                        @endphp
                    @endforeach
                    {{$sumaHp10calcdosex5}}
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $date1 = new DateTime($finiperiodo);
                        $sumaHp3calcdosex5 = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @php
                            $date2 = new DateTime($asig->primer_dia_uso);
                            $diferencia = $date2->diff($date1);
                            $diff = $diferencia->format('%y');
                            if($diff < 5 && $asig->ubicacion == 'CRISTALINO' && $asig->Hp3_dif_dosicont >= 0){
                                $sumaHp3calcdosex5 += $asig->Hp3_dif_dosicont;
                            }
                        @endphp
                    @endforeach
                    {{$sumaHp3calcdosex5}}
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $date1 = new DateTime($finiperiodo);
                        $sumaHp007calcdosex5 = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @php
                            $date2 = new DateTime($asig->primer_dia_uso);
                            $diferencia = $date2->diff($date1);
                            $diff = $diferencia->format('%y');
                            if($diff < 5 && $asig->ubicacion != 'CRISTALINO' && $asig->Hp007_dif_dosicont >= 0){
                                $sumaHp007calcdosex5 += $asig->Hp007_dif_dosicont;
                            }
                        @endphp
                    @endforeach
                    {{$sumaHp007calcdosex5}}
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right; background-color:#ECEFEE; width: 170px;">Total dosis históricas:</td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $sumaHp10calcdose = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @if($asig->ubicacion != 'CRISTALINO' && $asig->Hp10_dif_dosicont >= 0)
                            @php
                                $sumaHp10calcdose += $asig->Hp10_dif_dosicont;
                            @endphp
                        @endif    
                    @endforeach
                    {{$sumaHp10calcdose}}
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $sumaHp3calcdose = 0;
                    @endphp
                    @foreach($asignaciones as $asig)
                        @if($asig->ubicacion == 'CRISTALINO' && $asig->Hp3_dif_dosicont >= 0)
                            @php
                                $sumaHp3calcdose += $asig->Hp3_dif_dosicont;
                            @endphp
                        @endif    
                    @endforeach
                    {{$sumaHp3calcdose}}
                </td>
                <td style="border:0.1px solid black; text-align: center;">
                    @php
                        $sumaHp007calcdose = 0;
                    @endphp
                    @foreach ($asignaciones as $asig)
                        @if($asig->ubicacion != 'CRISTALINO' && $asig->Hp007_dif_dosicont >= 0)
                            @php
                                $sumaHp007calcdose += $asig->Hp007_dif_dosicont;
                            @endphp
                        @endif
                    @endforeach
                    {{$sumaHp007calcdose}}
                </td>
            </tr>
        </table>
        <br>
        @php
            $cristalino = 0;
        @endphp
        @foreach($asignaciones as $asig)
            @if($asig->ubicacion == 'CRISTALINO')
                @php
                    $cristalino = 'TRUE';
                @endphp
            @endif
        @endforeach
        {{-- ///////////////REGISTRO PERIODICO DE DOSIS [Hp(10)-mSv]/////////////// --}}
        @if($cristalino == 0)
            <table width="100%" style="border-collapse:collapse;" cellpadding="3">
                <tr>
                    <th colspan="14" style=" background-color: #1A9980; color:white">3. REGISTRO PERIODICO DE DOSIS [Hp(10)-mSv]</th>
                </tr>
                <tr>
                    <td rowspan="2" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">AÑO</td>
                    <td colspan="12" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MESES</td>
                    <td rowspan="2" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ACUMULADO AÑO <br>(mSv)</td>
                </tr>
                <tr>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ENE</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">FEB</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MAR</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ABR</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MAY</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">JUN</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">JUL</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">AGO</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">SEP</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">OCT</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">NOV</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">DIC</td>
                </tr>
                @php
                    $agrupadoporaño = $asignaciones->groupBy(function ($item) {
                        return date('Y', strtotime($item->primer_dia_uso));
                    });
                    $años = $agrupadoporaño->all();
                @endphp   
                @foreach ($años as $key => $año)
                    <tr>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            {{$key}}
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '01' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '02' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '03' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '04' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '05' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '06' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '07' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '08' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '09' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '10' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '11' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '12' && $item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0)
                                    {{$item->Hp10_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @php
                                $sumaHp10 = 0;
                            @endphp 
                            @foreach ($año as $item)
                                @php
                                    if($item->ubicacion != 'CRISTALINO' && $item->Hp10_dif_dosicont >= 0){
                                        $sumaHp10 += $item->Hp10_dif_dosicont;
                                    }
                                @endphp
                            @endforeach
                            {{$sumaHp10}}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                </tr>
            </table>
        @endif
        <br>
        {{--  ////////////REGISTRO PERIODICO DE DOSIS [Hp(3)-mSv]////////////// --}}
        @if($cristalino == 'TRUE')
            <table width="100%" style="border-collapse:collapse;" cellpadding="3">
                <tr>
                    <th colspan="14" style=" background-color: #1A9980; color:white">3. REGISTRO PERIODICO DE DOSIS [Hp(3)-mSv]</th>
                </tr>
                <tr>
                    <td rowspan="2" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">AÑO</td>
                    <td colspan="12" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MESES</td>
                    <td rowspan="2" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ACUMULADO AÑO <br>(mSv)</td>
                </tr>
                <tr>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ENE</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">FEB</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MAR</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ABR</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MAY</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">JUN</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">JUL</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">AGO</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">SEP</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">OCT</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">NOV</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">DIC</td>
                </tr>
                @php
                    $agrupadoporaño = $asignaciones->groupBy(function ($item) {
                        return date('Y', strtotime($item->primer_dia_uso));
                    });
                    $años = $agrupadoporaño->all();
                @endphp   
                @foreach ($años as $key => $año)
                    <tr>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            {{$key}}
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '01' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '02' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '03' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '04' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '05' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '06' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '07' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '08' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '09'&& $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '10' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '11' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '12' && $item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0)
                                    {{$item->Hp3_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @php
                                $sumaHp3 = 0;
                            @endphp 
                            @foreach ($año as $item)
                                @php
                                    if($item->ubicacion == 'CRISTALINO' && $item->Hp3_dif_dosicont >= 0){
                                        $sumaHp3 += $item->Hp3_dif_dosicont;
                                    }
                                @endphp
                            @endforeach
                            {{$sumaHp3}}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                </tr>
            </table>
        @endif
        <br>
        {{--  ////////////REGISTRO PERIODICO DE DOSIS [Hp(0.07)-mSv]////////////// --}}
        @if($cristalino == 0)
            <table width="100%" style="border-collapse:collapse;" cellpadding="3">
                <tr>
                    <th colspan="14" style=" background-color: #1A9980; color:white">3. REGISTRO PERIODICO DE DOSIS [Hp(0.07)-mSv]</th>
                </tr>
                <tr>
                    <td rowspan="2" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">AÑO</td>
                    <td colspan="12" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MESES</td>
                    <td rowspan="2" style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ACUMULADO AÑO <br>(mSv)</td>
                </tr>
                <tr>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ENE</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">FEB</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MAR</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">ABR</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">MAY</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">JUN</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">JUL</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">AGO</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">SEP</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">OCT</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">NOV</td>
                    <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">DIC</td>
                </tr>
                @php
                    $agrupadoporaño = $asignaciones->groupBy(function ($item) {
                        return date('Y', strtotime($item->primer_dia_uso));
                    });
                    $años = $agrupadoporaño->all();
                @endphp   
                @foreach ($años as $key => $año)
                    <tr>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            {{$key}}
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '01' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '02' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '03' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '04' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '05' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '06' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '07' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '08' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '09' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '10' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '11' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @foreach ($año as $item)
                                @php
                                    $mes = date("m", strtotime($item->primer_dia_uso));
                                @endphp 
                                @if($mes == '12' && $item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0)
                                    {{$item->Hp007_dif_dosicont}}
                                @endif
                            @endforeach
                        </td>
                        <td style="border:0.1px solid black; text-align: center; height: 15px;">
                            @php
                                $sumaHp007 = 0;
                            @endphp 
                            @foreach ($año as $item)
                                @php
                                    if($item->ubicacion != 'CRISTALINO' && $item->Hp007_dif_dosicont >= 0){
                                        $sumaHp007 += $item->Hp007_dif_dosicont;
                                    }
                                @endphp
                            @endforeach
                            {{$sumaHp007}}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                    <td style="border:0.1px solid black; text-align: center; height: 15px;"></td>
                </tr>
            </table>
        @endif
        <br>
        {{-- ///////////se pone como borrador para futuras implementaciones en la plataforma para usuarios de dosimetria///////////// --}}
        {{-- <table width="100%" style="border-collapse:collapse;" cellpadding="3">
            <tr>
                <th colspan="6" style=" background-color: #1A9980; color:white">4. REGISTRO DE LA EXPOSICIÓN OCUPACIONAL HISTORICA [Dosis Hp(10)-mSv]</th>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE; width: 170px;">Empleador</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Prestador</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Tecnología</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Fecha inicial</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Fecha final</td>
                <td style="border:0.1px solid black; text-align: center; background-color:#ECEFEE;">Dosis (mSv)</td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; height: 15px;"></td>
                <td style="border:0.1px solid black; height: 15px;"></td>
                <td style="border:0.1px solid black; height: 15px;"></td>
                <td style="border:0.1px solid black; height: 15px;"></td>
                <td style="border:0.1px solid black; height: 15px;"></td>
                <td style="border:0.1px solid black; height: 15px;"></td>
            </tr>
        </table>
        <br> --}}
        <table width="100%" style="border-collapse:collapse;" cellpadding="3">
            <tr>
                <th style=" background-color: #1A9980; color:white">4. OBSERVACIONES</th>
            </tr>
            @php
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
            @endphp
            @foreach ($asignaciones as $asig)
                @if($asig->ubicacion == 'TORAX' && $asig->Hp10_dif_dosicont >= 1.67)
                    <tr>
                        <td style="border:0.1px solid black; height: 15px;">
                            - SE RECOMIENDA REVISAR EL LÍMITE DE LAS DOSIS PERMITIDAS PARA HP(10) mSv EN EL MES DE
                            @php
                                echo $meses[date("m", strtotime($asig->primer_dia_uso))];
                            @endphp
                        </td>
                    </tr>
                @elseif($asig->ubicacion == 'CRISTALINO' && $asig->Hp3_dif_dosicont >= 12.5) 
                    <tr>
                        <td style="border:0.1px solid black; height: 15px;">
                            - SE RECOMIENDA REVISAR EL LÍMITE DE LAS DOSIS PERMITIDAS PARA HP(3) mSv EN EL MES DE
                            @php
                                echo $meses[date("m", strtotime($asig->primer_dia_uso))];
                            @endphp
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td style="border:0.1px solid black; height: 15px;"> </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; height: 15px;"> </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; height: 15px;"> </td>
            </tr>
        </table>
    </main>
    
</body>
    