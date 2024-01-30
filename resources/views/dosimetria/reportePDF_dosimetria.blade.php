<style type="text/css">
    @page{
        margin: 0cm 0cm;
    }
    
    body{
        /* background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 10px;
        margin-top: 1cm;
        margin-left: 1cm;
        margin-right: 0.5cm;
        margin-bottom: 1cm;
    }
    header{
        position: fixed;
        top: 1cm;
        right: 0.5cm;
        left: 1cm;
        height: 150px;
        /* background: blue; */
        
    }
    main{
        position: relative;
        top:160px;
        left: 0cm;
        right: 0cm;
        height: 428px;
        margin-bottom: 4cm;
        /*background: yellow;*/
        display:block;
    }
    
    footer{
        position: fixed;
        left: 1cm; 
        right: 0.5cm;
        height: 115px;
        bottom: 1.5cm; 
        margin-top: 100px;
        /*background: aqua;*/
        
    }
    
    .page-break {
        page-break-after: always;
    }

    .verticalText {
        writing-mode: vertical-lr;
        transform: rotate(-90deg);
        
    }
    
    .anchoCell{
        width: 20px;
        writing-mode: vertical-lr;
        transform: rotate(-90deg);
        
    }

    .parrafo-border{
        position:absolute; 
        top:500px;
        border: 1px;
    }
    
</style>
<body>
    
    <!-- ////////////////////ENCABEZADO/////////////// -->
    <header>
        <img src="{{asset('imagenes/VerdeSF.png')}}" width="200" style="position: absolute;">
        
        <h3 style="position: absolute; top:87px; left:30px;">REPORTE DE DOSIMETRÍA</h3>
        
         <table style="position:absolute; top:0px; left:240px;" cellspacing="0" cellpadding="0" width="350">
            <tr>
                <th style="font-size: 15px;" align="left">QA POSITRON S.A.S.</th>
            </tr>
            <tr>
                <td>NIT: 901390101-3, Licencia Ministerio de Minas y Energía No. QAP-001 marzo 2023</td>
            </tr>
            <tr>
                <td>Calle 36 #27-71 MILLENIUM BUSSINES TOWER, Oficina 919, Bucaramanga - Santander, Colombia</td>
            </tr>
            <tr>
                <td>Cel: 301 4495401 - 304 3386581</td>
            </tr>
            <tr>
                <td>Email:dosimetria.qapositron@gmail.com</td>
            </tr>
            <tr>
                <td style="padding-bottom:12px;">Sitio web: www.qapositron.com</td>
            </tr>
            <tr>
                <th style="font-size: 11px; border: solid 0.4px #000; padding: 5px; word-wrap: break-word; word-break: break-all;">
                    @foreach($contratoDosi as $cont)
                        {{$cont->razon_social_empresa}} - SEDE: {{$cont->nombre_sede}}
                    @endforeach 
                </th>
            </tr>
        </table>
        
        <table style="position:absolute; top:0px; left:713px; width:44.6%; border-collapse:collapse; font-size: 9px;" cellpadding="4">
            <tr>
                <td style="border:0.1px solid black; text-align: right;">No. de Cuenta</td>
                <td style="width: 120px; border:0.1px solid black; color:#2646FA;" align="center" id="id_contrato">
                @foreach($contratoDosi as $cont)
                    @php
                        $n = $cont->codigo_contrato;
                        $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
                        echo $titulo;
                    @endphp
                @endforeach 
                </td>
                <td style="border:0.1px solid black; text-align: right;">Fecha recibo dosím.</td>
                <td style="width: 94px; border:0.1px solid black; color:#2646FA;" align="center">
                    @php
                        $chek = null;
                    @endphp 
                    @if(count($trabajdosiasig) != 0)     
                        @foreach($trabajdosiasig as $trabj)
                            @php
                                if($trabj->fecha_dosim_devuelto != $chek){
                                    $datefix = date('d-m-Y',strtotime($trabj->fecha_dosim_devuelto));
                                    echo "{$datefix}";
                                    $chek = strval($trabj->fecha_dosim_devuelto);
                                }else{ 
                                    echo " ";
                                }
                            @endphp
                        @endforeach
                    @else
                        @foreach($dosiareasig as $dosiarea)
                            @php
                                if($dosiarea->fecha_dosim_devuelto != $chek){
                                    $datefix = date('d-m-Y',strtotime($dosiarea->fecha_dosim_devuelto));
                                    echo "{$datefix}";
                                    $chek = strval($dosiarea->fecha_dosim_devuelto);
                                }else{ 
                                    echo " ";
                                }
                            @endphp
                        @endforeach
                    @endif
                </td>
                <td rowspan="6" style="width: 140px; border:0.1px solid black; text-align: center;">
                <img src="{{asset('imagenes/LOGODOSIMETRIA.png')}}" width="120">
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right;">Código Depto.</td>
                <td style="width: 120px; border:0.1px solid black; color:#2646FA;" align="center">
                    @foreach($contratoDosi as $cont)
                        {{$cont->nombre_departamento}}
                    @endforeach
                </td>
                <td style="border:0.1px solid black; text-align: right;">Fecha del reporte</td>
                <td style="width: 94px; border:0.1px solid black; color:#2646FA;" align="center">
                    @php
                        $fechaReporte = 0;
                        $fechas = array();
                    @endphp
                    @if($trabajdosiasig->isEmpty())
                        @foreach($dosiareasig as $dosiarea)
                            @if($dosiarea->measurement_date != NULL)
                                @php
                                    array_push($fechas, $dosiarea->measurement_date);
                                @endphp
                            @endif
                        @endforeach
                        @php
                            function fechaMasRepetida($arrayFechas) {
                                // Convertir las fechas a formato Y-m-d para asegurar la consistencia
                                $arrayFechas = array_map(function($fecha) {
                                    return date('Y-m-d', strtotime($fecha));
                                }, $arrayFechas);

                                // Contar la frecuencia de cada fecha en el array
                                $frecuencias = array_count_values($arrayFechas);

                                // Encontrar la fecha con la frecuencia máxima
                                $fechaMasRepetida = array_search(max($frecuencias), $frecuencias);

                                return $fechaMasRepetida;
                            }
                            if(count($fechas) != 0){
                                $resultado = fechaMasRepetida($fechas);
                                $fechaReporte = $resultado;
                            }
                        @endphp
                    @else
                        @foreach($trabajdosiasig as $dositrabj)
                            @if($dositrabj->measurement_date != NULL)
                                @php
                                    array_push($fechas, $dositrabj->measurement_date);
                                @endphp
                            @endif
                        @endforeach
                        @php
                            function fechaMasRepetida($arrayFechas) {
                                // Convertir las fechas a formato Y-m-d para asegurar la consistencia
                                $arrayFechas = array_map(function($fecha) {
                                    return date('Y-m-d', strtotime($fecha));
                                }, $arrayFechas);

                                // Contar la frecuencia de cada fecha en el array
                                $frecuencias = array_count_values($arrayFechas);

                                // Encontrar la fecha con la frecuencia máxima
                                $fechaMasRepetida = array_search(max($frecuencias), $frecuencias);

                                return $fechaMasRepetida;
                            }
                            if(count($fechas) != 0){
                                $resultado = fechaMasRepetida($fechas);
                                $fechaReporte = $resultado;
                            }
                        @endphp
                    @endif
                    {{date('d-m-Y',strtotime($fechaReporte))}}
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right;">@if($contratoDosi[0]->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') CC Entidad Usuaria @else NIT Entidad Usuaria @endif</td>
                <td style="width: 120px; border:0.1px solid black; color:#2646FA;" align="center">
                    @foreach($contratoDosi as $cont)
                        {{$cont->num_iden_empresa}} 
                    @endforeach
                </td>
                <td colspan="2" rowspan="1" style="width: 50px; border:0.1px solid black;" align="center">Vo.Bo. / <b>DIEGO F. APONTE CASTAÑEDA</b> </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right;">Municipio / Depto</td>
                <td style="width: 120px; border:0.1px solid black; color:#2646FA;" align="center">
                    @foreach($contratoDosi as $cont)
                        {{$cont->nombre_municol}} - {{$cont->abreviatura_deptocol}}
                    @endforeach
                </td>
                <td colspan="2" rowspan="3" style="width: 94px; border:0.1px solid black; text-align: center;">
                    <img src="{{asset('imagenes/FIRMADEDIEGOFINAL.png')}}" width="170" height="48">
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right;">Persona Contacto</td>
                <td style="width: 120px; border:0.1px solid black; color:#2646FA;" align="center">
                @if($personaEncargada->isEmpty()) @else   {{$personaEncargada[0]->primer_nombre_persona}} {{$personaEncargada[0]->primer_apellido_persona}} {{$personaEncargada[0]->segundo_apellido_persona}} @endif
                </td>
            </tr>
            <tr>
                <td style="border:0.1px solid black; text-align: right;">Cargo del contacto</td>
                <td style="width: 120px; border:0.1px solid black; color:#2646FA;" align="center">
                    @if($personaEncargada->isEmpty())
                    @else
                        @foreach($personaEncargadaPerfiles as $per)
                            {{$per->nombre_perfil}}.
                        @endforeach
                    @endif
                </td>
            </tr>
        </table>
        <!-- ////////////////////FIN ENCABEZADO/////////////// -->
    </header>
    <footer>
        <div style="position: static; border:solid 0.1px #000; width: 99.2%; height:35px; padding:5px 5px 5px 5px; display:block">
            <p style="text-align:justify; margin:0px;">
                <b>NOMENCLATURA:</b> <b>NA =</b> No Aplica (No se tiene observaciones), <b>ND =</b> Dosis No Detectable (Significa que la lectura esta entre cero y algún número negativo), 
                <b>NP =</b> Dosímetro No Presentado (No se llegó el dosímetro a las instalaciones de QA POSITRON), <b>DNL =</b> Dosímetro No Legible (Dosímetro llegó, pero no se puede leer por deterioro), 
                <b>EU =</b> Dosímetro en Uso (el dosímetro está en uso por el usuario), <b>DPL =</b> Dosímetro en Proceso de Lectura (El dosímetro llegó a las instalaciones y no se ha procesado la lectura), 
                <b>DSU =</b> Dosímetro sin usar (Dosímetro que indica el cliente que no se usó en ese periodo)
            </p> 
        </div>
        <div style="position: static; border:solid 0.1px #000; width: 99.2%;  height:25px; padding:5px 5px 5px 5px;">
            <p style="text-align:justify; margin:0px;">
                <b>NOTAS:</b> <b>1 =</b> Ninguna (No se tiene ninguna nota), <b>2 =</b> Extraviado (No llegó el dosímetro a nuestras instalaciones y se declara extraviado), <b> 3 =</b> Supera dosis permitida de 1,67 mSv (Tórax), 41,6 mSv (Anillo) y 12,5 mSv (Cristalino) (La lectura indica que superó el nivel de dosis permitido para un periodo mensual), <b>4 =</b> Dosímetro reprocesado (Se realiza segunda lectura a petición del usuario), <b>5 =</b> Control no utilizado en la evaluación (Lectura del dosímetro de Control, no restada en la evaluación), <b>6 =</b> Dosímetro contaminado por material radioactivo.
            </p>
        </div>
        <p style="position: static; border:solid 0.1px #000; width: 99.2%; height:25px; padding:5px 5px 5px 5px; text-align:justify; margin:0px;">
            <b>(1)</b> En el caso que usuario haya sido desactivado y reactivado posteriormente, la fecha indicada en este campo será la de la última reactivación. Este ajuste no implica  cambio en el histórico de dosis. En caso de necesitar cualquier aclaración respecto a la información aquí dispuesta favor hacer la consulta al correo electrónico <b>dosimetria.qapositron@gmail.com</b> 
        </p>
        <br>
    </footer>
    <main>
        <table style="position:relative; border-collapse: collapse; width: 100%; margin-bottom: 8cm;"  cellspacing="4" cellpadding="0" align="center">
            <thead {{-- style="background-color:#DADADA;" --}}>
                <tr align="center">
                    <th rowspan="2" style="width:60px; border:1px solid black;">Código Dosímetro </th>
                    <th rowspan="2" style="width:125px; padding:5px; border:1px solid black;">Apellido(s)</th>
                    <th rowspan="2" style="width:125px; padding:5px; border:1px solid black;">Nombre(s)</th>
                    <th rowspan="2" style="width:5px; border:1px solid black;"><p class="anchoCell">Género</p></th>
                    <th rowspan="2" style="width:5px; border:1px solid black;"><p class="anchoCell">Ocupación</p></th>
                    <th rowspan="2" style="width:60px; padding:5px; border:1px solid black;">Documento de Identidad</th>
                    <th rowspan="2" style="width:60px; border:1px solid black;">Fecha de Ingreso al Servicio (1)</th>
                    <th colspan="2" style="width:60px; padding:5px; border:1px solid black;">Periodo de uso del dosímetro</th>
                    <th rowspan="2" style="width:50px; border:1px solid black;"><p class="verticalText">Período de recambio</p></th>
                    <th rowspan="2" style="width:70px; border:1px solid black;"><p class="verticalText">Ubicación <br> del  <br> dosímetro</p></th>
                    <th rowspan="2" style="width:50px; border:1px solid black;"><p class="verticalText">Energía ó calidad de radiación</p></th>
                    <th colspan="3" style="width:120px; padding:5px; border:1px solid black;">Dosis del Período<br>(mSv)</th>
                    <th colspan="3" style="width:120px; padding:5px; border:1px solid black;">Dosis acumulada 12 meses anteriores (mSv)</th>
                    <th colspan="3" style="width:120px; padding:5px; border:1px solid black;">Dosis acumulada desde ingreso al servicio (mSv)</th>
                    <th rowspan="2" style="width:50px; border:1px solid black;">Nota</th>
                </tr>
                <tr align="center">
                    <th style="width:50px; padding:5px; border:1px solid black;">Primer Día</th>
                    <th style="width:50px; padding:5px; border:1px solid black;">Último Día</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(10)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(0.07)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(3)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(10)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(0.07)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(3)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(10)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(0.07)</th>
                    <th style="width:30px; padding:5px; border:1px solid black;">Hp(3)</th>
                </tr>
            </thead>
            <tbody style="color:#2646FA;">
                {{-- ////////NO HAY DOSIMETROS DE CONTROL//////////// --}}
                @if($dosicontrolasig->isEmpty() && $dosicontrolasigUnico->isEmpty())
                    @foreach($dosiareasig as $dosiarea)
                        <tr>
                            <td style="padding:2px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dosiarea->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding:2px; border:0.1px solid black;">{{$dosiarea->areadepartamentosede->nombre_area}}</td>
                            <td style="padding:2px; border:0.1px solid black;">NA</td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach    
                            </td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding:2px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosiarea->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosiarea->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">ÁREA</td>
                            <td style="padding:2px; border:0.1px solid black;" align="center">{{$dosiarea->energia}}</td>
                            
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp10_calc_dose <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosiarea->Hp10_calc_dose}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp007_calc_dose  <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dosiarea->Hp007_calc_dose}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp10_calc_dose <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosiarea->Hp10_calc_dose}} 
                                @endif
                            </td>
        
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                    
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp10_calc_dose >= 0  && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp10calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp007_calc_dose >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp007calcdose += $sumadocemeses[$i]->Hp007_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp007calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                    
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp10_calc_dose >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp10calcdose}}
                            </td>
        
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp10_calc_dose >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp10calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp007_calc_dose >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp007calcdose += $sumaFImeses[$i]->Hp007_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp007calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp10_calc_dose >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp10calcdose}}
                            </td>
                            <!-- //////////NOTAS//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black; border-left:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dosiarea->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                    @foreach($trabajdosiasig as $dositrabj)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dositrabj->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->primer_apellido_persona}} {{$dositrabj->persona->segundo_apellido_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->primer_nombre_persona}} {{$dositrabj->persona->segundo_nombre_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->genero_persona == 'FEMENINO' ? 'F' : 'M'}}@endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->cedula_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $ckek = 0;
                                    $checkubi = '';
                                @endphp
                                @foreach($fechainiciodositrabaj as $fec)
                                    @if($dositrabj->persona_id == $fec->persona_id && ($chek != $fec->persona_id || $checkubi != $fec->ubicacion))
                                        @php
                                            $datefix = date('d-m-Y',strtotime($fec->primer_dia_uso));
                                            $chek = $fec->persona_id;
                                            $checkubi = $fec->ubicacion;
                                            echo $datefix;
                                        @endphp
                                        {{-- {{$datefix}} --}}
                                    @endif
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dositrabj->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dositrabj->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                {{$dositrabj->ubicacion}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">{{$dositrabj->energia}}</td>
        
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td id ="hp10_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if(($dositrabj->Hp10_calc_dose >= 12.0)) color: #ff0000;  @endif " align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @elseif($dositrabj->Hp10_calc_dose <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dositrabj->Hp10_calc_dose}} 
                                @endif
                            </td>
                            <td id="hp007_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if(($dositrabj->Hp007_calc_dose >= 12.0)) color: #ff0000;  @endif" align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @elseif($dositrabj->Hp007_calc_dose <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dositrabj->Hp007_calc_dose}} 
                                @endif
                            </td>
                            <td id="hp3_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;  @if(($dositrabj->Hp3_calc_dose >= 12.0)) color: #ff0000;  @endif" align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}} 
                                @elseif($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @elseif($dositrabj->Hp3_calc_dose <= 0)
                                    {{'ND'}}
                                @else
                                    {{$dositrabj->Hp3_calc_dose}}
                                @endif
                            </td>
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion  && $sumadocemeses[$i]->Hp10_calc_dose >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte )
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @else
                                    {{$sumaHp10calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp007_calc_dose >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp007calcdose += $sumadocemeses[$i]->Hp007_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @else
                                    {{$sumaHp007calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $sumaHp3calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp3_calc_dose >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp3calcdose += $sumadocemeses[$i]->Hp3_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp3calcdose}}
                            
                            </td>
        
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp10_calc_dose >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @else
                                    {{$sumaFIHp10calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp007_calc_dose >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp007calcdose += $sumaFImeses[$i]->Hp007_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @else
                                    {{$sumaFIHp007calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $sumaFIHp3calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp3_calc_dose >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp3calcdose += $sumaFImeses[$i]->Hp3_calc_dose;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp3calcdose}}
                                {{-- @if($dositrabj->ubicacion == 'TORAX' || $dositrabj->ubicacion == 'CASO'|| $dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @else
                                    {{$sumaFIHp3calcdose}}
                                @endif --}}
                            </td>
                            <!-- //////////NOTAS//////// -->
                            <td  style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dositrabj->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>    
                        </tr>
                    @endforeach 
                @elseif($dosicontrolasig->isEmpty()) 
                    {{-- //////// SI HAY DOSIMETRO DE CONTROL UNO PARA TODO EL CONTRATO//////////// --}}
                    @foreach($dosicontrolasigUnico as $dosicontUnic)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dosicontUnic->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">CONTROL TRANS. {{mb_substr($dosicontUnic->ubicacion, 0,1,"UTF-8")}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosicontUnic->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosicontUnic->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">N.A.</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">{{$dosicontUnic->energia}}</td>
                            
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosicontUnic->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosicontUnic->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosicontUnic->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosicontUnic->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosicontUnic->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosicontUnic->ubicacion == 'CRISTALINO'|| $dosicontUnic->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @elseif($dosicontUnic->Hp10_calc_dose <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosicontUnic->Hp10_calc_dose}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                
                                @if($dosicontUnic->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosicontUnic->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosicontUnic->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosicontUnic->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosicontUnic->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosicontUnic->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @elseif($dosicontUnic->Hp007_calc_dose  <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dosicontUnic->Hp007_calc_dose}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @if($dosicontUnic->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosicontUnic->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosicontUnic->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosicontUnic->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosicontUnic->nota2 == 'TRUE')
                                    {{'NP'}} 
                                @elseif($dosicontUnic->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @elseif($dosicontUnic->Hp3_calc_dose <= 0)
                                    {{'ND'}}
                                @else
                                    {{$dosicontUnic->Hp3_calc_dose}}
                                @endif 
                            </td>
        
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
        
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
        
                            <!-- //////////NOTAS//////// -->
                            <td  style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dosicontUnic->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                    @foreach($dosiareasig as $dosiarea)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dosiarea->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">{{$dosiarea->areadepartamentosede->nombre_area}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; " align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosiarea->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosiarea->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">AMBIENTAL</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">{{$dosiarea->energia}}</td>
                            
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp10_dif_dosicont <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosiarea->Hp10_dif_dosicont}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp007_dif_dosicont <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dosiarea->Hp007_dif_dosicont}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center"> 
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp10_dif_dosicont <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dosiarea->Hp10_dif_dosicont}} 
                                @endif
                            </td>
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; " align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp10calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp007calcdose += $sumadocemeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp007calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp10calcdose}}
                            </td>
        
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp10calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp007calcdose += $sumaFImeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp007calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp10calcdose}}
                            </td>
                            <!-- //////////NOTAS//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dosiarea->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                    @foreach($trabajdosiasig as $dositrabj)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dositrabj->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->primer_apellido_persona}} {{$dositrabj->persona->segundo_apellido_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->primer_nombre_persona}} {{$dositrabj->persona->segundo_nombre_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->genero_persona == 'FEMENINO' ? 'F' : 'M'}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->cedula_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $ckek = 0;
                                    $checkubi = '';
                                @endphp
                                @foreach($fechainiciodositrabaj as $fec)
                                    @if($dositrabj->persona_id == $fec->persona_id && ($chek != $fec->persona_id || $checkubi != $fec->ubicacion))
                                        @php
                                            $datefix = date('d-m-Y',strtotime($fec->primer_dia_uso));
                                            $chek = $fec->persona_id;
                                            $checkubi = $fec->ubicacion;
                                            echo $datefix;
                                        @endphp
                                        {{-- {{$datefix}} --}}
                                    @endif
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dositrabj->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dositrabj->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                {{$dositrabj->ubicacion}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">{{$dositrabj->energia}}</td>
    
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td id ="hp10_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if($dositrabj->nota3 == 'TRUE') color: #ff0000;  @endif " align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @elseif($dositrabj->Hp10_dif_dosicont <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dositrabj->Hp10_dif_dosicont}} 
                                @endif
                            </td>
                            <td id="hp007_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if($dositrabj->nota3 == 'TRUE') color: #ff0000;  @endif" align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @elseif($dositrabj->Hp007_dif_dosicont <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dositrabj->Hp007_dif_dosicont}} 
                                @endif
                            </td>
                            <td id="hp3_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;  @if($dositrabj->nota3 == 'TRUE') color: #ff0000;  @endif" align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}} 
                                @elseif($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @elseif($dositrabj->Hp3_dif_dosicont <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dositrabj->Hp3_dif_dosicont}} 
                                @endif
                            </td>
    
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @else
                                    {{$sumaHp10calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp007calcdose += $sumadocemeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @else
                                    {{$sumaHp007calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $sumaHp3calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp3_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp3calcdose += $sumadocemeses[$i]->Hp3_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @else
                                    {{$sumaHp3calcdose}}
                                @endif
                            </td>
    
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte) 
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @else
                                    {{$sumaFIHp10calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp007calcdose += $sumaFImeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @else
                                    {{$sumaFIHp007calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $sumaFIHp3calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp3_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp3calcdose += $sumaFImeses[$i]->Hp3_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @else
                                    {{$sumaFIHp3calcdose}}
                                @endif
                            </td>
                            
                            <!-- //////////NOTAS//////// -->
                            <td  style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dositrabj->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>   
                        </tr>
                        
                    @endforeach
                @else
                    {{-- //////// SI HAY DOSIMETRO DE CONTROL POR ESPECIALIDAD//////////// --}}
                    @foreach($dosicontrolasig as $dosicontrol)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dosicontrol->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">CONTROL {{$dosicontrol->ubicacion}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosicontrol->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosicontrol->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">{{$dosicontrol->ubicacion}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">{{$dosicontrol->energia}}</td>
                            
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosicontrol->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosicontrol->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosicontrol->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosicontrol->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosicontrol->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosicontrol->ubicacion == 'CRISTALINO'|| $dosicontrol->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @elseif($dosicontrol->Hp10_calc_dose <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosicontrol->Hp10_calc_dose}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                
                                @if($dosicontrol->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosicontrol->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosicontrol->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosicontrol->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosicontrol->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosicontrol->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @elseif($dosicontrol->Hp007_calc_dose  <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dosicontrol->Hp007_calc_dose}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @if($dosicontrol->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosicontrol->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosicontrol->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosicontrol->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosicontrol->nota2 == 'TRUE')
                                    {{'NP'}} 
                                @elseif($dosicontrol->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @elseif($dosicontrol->Hp3_calc_dose <= 0)
                                    {{'ND'}}
                                @else
                                    {{$dosicontrol->Hp3_calc_dose}}
                                @endif 
                            </td>
        
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
        
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">NA</td>
        
                            <!-- //////////NOTAS//////// -->
                            <td  style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dosicontrol->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                    @foreach($dosiareasig as $dosiarea)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dosiarea->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">{{$dosiarea->areadepartamentosede->nombre_area}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">NA</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosiarea->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dosiarea->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">AMBIENTAL</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">{{$dosiarea->energia}}</td>
                            
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp10_dif_dosicont <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosiarea->Hp10_dif_dosicont}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp007_dif_dosicont <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dosiarea->Hp007_dif_dosicont}} 
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @if($dosiarea->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dosiarea->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dosiarea->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dosiarea->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dosiarea->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dosiarea->Hp10_dif_dosicont <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dosiarea->Hp10_dif_dosicont}} 
                                @endif
                            </td>
    
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; " align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp10calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp007calcdose += $sumadocemeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaHp007calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesesAreasasig as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                
                                {{$sumaHp10calcdose}}
                            </td>
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp10calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp007calcdose += $sumaFImeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp007calcdose}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesesAreasasig as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                {{$sumaFIHp10calcdose}}
                            </td>
                            <!-- //////////NOTAS//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dosiarea->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                    @foreach($trabajdosiasig as $dositrabj)
                        <tr>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-left:1px solid black; border-right:1px solid black;" align="center">{{$dositrabj->dosimetro->codigo_dosimeter}}</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->primer_apellido_persona}} {{$dositrabj->persona->segundo_apellido_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; padding-left:3px; border:0.1px solid black;">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->primer_nombre_persona}} {{$dositrabj->persona->segundo_nombre_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->genero_persona == 'FEMENINO' ? 'F' : 'M'}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->ocupacion}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">@if($dositrabj->persona_id == NULL) @else {{$dositrabj->persona->cedula_persona}} @endif</td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $ckek = 0;
                                    $checkubi = '';
                                @endphp
                                @foreach($fechainiciodositrabaj as $fec)
                                    @if($dositrabj->persona_id == $fec->persona_id && ($chek != $fec->persona_id || $checkubi != $fec->ubicacion))
                                        @php
                                            $datefix = date('d-m-Y',strtotime($fec->primer_dia_uso));
                                            $chek = $fec->persona_id;
                                            $checkubi = $fec->ubicacion;
                                            echo $datefix;
                                        @endphp
                                        {{-- {{$datefix}} --}}
                                    @endif
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dositrabj->primer_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $datefix = date('d-m-Y',strtotime($dositrabj->ultimo_dia_uso));
                                @endphp
                                {{$datefix}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @foreach($contratoDosi as $cont)
                                    {{$cont->periodo_recambio}}
                                @endforeach
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                {{$dositrabj->ubicacion}}
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">{{$dositrabj->energia}}</td>
    
                            <!--  /////////DOSIS DEL PERIODO///// -->
                            <td id ="hp10_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if($dositrabj->nota3 == 'TRUE') color: #ff0000;  @endif " align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @elseif($dositrabj->Hp10_dif_dosicont <= 0)
                                    {{"ND"}}
                                @else 
                                    {{$dositrabj->Hp10_dif_dosicont}} 
                                @endif
                            </td>
                            <td id="hp007_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if($dositrabj->nota3 == 'TRUE') color: #ff0000;  @endif" align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}}
                                @elseif($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @elseif($dositrabj->Hp007_dif_dosicont <= 0)  
                                    {{"ND"}}
                                @else
                                    {{$dositrabj->Hp007_dif_dosicont}} 
                                @endif
                            </td>
                            <td id="hp3_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;  @if($dositrabj->nota3 == 'TRUE') color: #ff0000;  @endif" align="center">
                                @if($dositrabj->DNL =='TRUE')
                                    {{'DNL'}}
                                @elseif($dositrabj->EU == 'TRUE')
                                    {{'EU'}}
                                @elseif($dositrabj->DPL == 'TRUE')
                                    {{'DPL'}}
                                @elseif($dositrabj->DSU == 'TRUE')
                                    {{'DSU'}}
                                @elseif($dositrabj->nota2 == 'TRUE')
                                    {{'NP'}} 
                                @elseif($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @elseif($dositrabj->Hp3_dif_dosicont <= 0)
                                    {{'ND'}}
                                @else
                                    {{$dositrabj->Hp3_dif_dosicont}}
                                @endif
                            </td>
    
                            <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp10calcdose += $sumadocemeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @else
                                    {{$sumaHp10calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp007calcdose += $sumadocemeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @else
                                    {{$sumaHp007calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $sumaHp3calcdose = 0;
                                @endphp
                                @foreach($SumatoriaDocemesestrabajadoresaisg as $sumadocemeses)
                                    @for($i=0; $i< count($sumadocemeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp3_dif_dosicont >= 0 && $sumadocemeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaHp3calcdose += $sumadocemeses[$i]->Hp3_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @else
                                    {{$sumaHp3calcdose}}
                                @endif
                            </td>
    
                            <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp10calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp10calcdose += $sumaFImeses[$i]->Hp10_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'CRISTALINO' || $dositrabj->ubicacion == 'ANILLO') 
                                    {{'NA'}}
                                @else
                                    {{$sumaFIHp10calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black;" align="center">
                                @php
                                    $sumaFIHp007calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp007calcdose += $sumaFImeses[$i]->Hp007_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach 
                                @if($dositrabj->ubicacion == 'CRISTALINO') 
                                    {{'NA'}} 
                                @else
                                    {{$sumaFIHp007calcdose}}
                                @endif
                            </td>
                            <td style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @php
                                    $sumaFIHp3calcdose = 0;
                                @endphp
                                @foreach($SumatoriaFechaIngresomesestrabajadoresaisg as $sumaFImeses)
                                    @for($i=0; $i< count($sumaFImeses); $i++)
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp3_dif_dosicont >= 0 && $sumaFImeses[$i]->measurement_date <= $fechaReporte)
                                            @php
                                                $sumaFIHp3calcdose += $sumaFImeses[$i]->Hp3_dif_dosicont;
                                            @endphp
                                        @endif
                                    @endfor
                                @endforeach
                                @if($dositrabj->ubicacion == 'ANILLO')
                                    {{'NA'}}
                                @else
                                    {{$sumaFIHp3calcdose}}
                                @endif
                            </td>
                            
                            <!-- //////////NOTAS//////// -->
                            <td  style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;" align="center">
                                @for($i=1; $i<=6; $i++)
                                    @if($dositrabj->{"nota$i"} == 'TRUE')
                                        {{$i}})
                                    @endif 
                                @endfor
                            </td>   
                        </tr>
                        
                    @endforeach
                @endif
            </tbody>
        </table>
    </main>
    <!-- ////////////////////////////////////----------------SEGUNDA PAGINA------------//////////////////////////////////////////////7 -->
    <p style="position:relative; top:155px; text-align:justify; border:solid 0.3px #000; width: 99.2%; padding:5px 5px 5px 5px; margin:0px; page-break-before: always;"> 
        <b> INFORMACIÓN DE INTERÉS GENERAL: </b> <br>
            <b>i.</b>   Hp(d), es la dosis equivalente personal a la profundidad indicada en milímetros. Así: Hp(10) estima la dosis en tejido profundo a 10mm de profundidad, Hp(3) estima la dosis al cristalino a 3mm de profundidad, y Hp(0.07) estima la dosis en tejido superficial (extremidades y piel o poco profundo) a 0,07mm de profundidad. <br>
            <b>ii.</b>  Los dosímetros de control, tienen por objeto la verificación de irradiaciones incidentales o accidentales durante el transporte y/o lugar de almacenamiento mientras es retornado para lectura. No deben utilizarse o ser asignados a usuario. <br>
            <b>iii.</b> Toda dosis que supere el valor de 1.67 mSv/mes debe ser investigada y documentada al interior de la instalación. Tal registro, es una señal de alerta indicadora de la posibilidad de sobrepasar el límite anual, o indicadora de la necesidad de optimizar la práctica. <br>
            <b>iv.</b>  Toda dosis que supere el valor de 12.0 mSv/mes debe ser inmediatamente reportada a la Autoridad Reguladora, con el fin de emprender acciones que reduzcan o eviten la exposición o la probabilidad de exposición. <br>
            <b>v.</b>   La dosis equivalente personal evaluada a una profundidad de 10 mm - Hp(10), es una estimación aceptable y conservadora de la dosis equivalente en el cristalino del ojo a una profundidad de 3 mm. <br>
            <b>vi.</b>  La periodicidad de recambio de los dosímetros, reviste importancia ante la necesidad de investigar registros de dosis fuera de los rangos recomendados, ante un incidente, un accidente o una situación de emergencia. <br>
    </p>
    <p style="position: relative;top:155px; text-align:justify; border:solid 0.3px #000; width: 99.2%; padding:5px 5px 5px 5px; margin:0px;"> 
        <b>INFORMACIÓN DEL REPORTE DE EXPOSICIÓN:</b> <br>
            Nombre(s) y Apellido(s): identificando la persona a la cual el dosímetro es asignado. Género (M=Masculino, F=Femenino); Documento de Identidad. Fecha de Ingreso al Servicio: corresponde a la fecha en que QA POSITRON empezó a mantener registros de dosimetría para un participante en la cuenta actual, o de la última reactivación del servicio, de aplicar.
            Ocupación: de acuerdo con la información suministrada por la entidad contratante, se clasifica la ocupación con la siguiente nomenclatura: <b>T =</b> Teleterapia, <b>BQ =</b> Braquiterapia, <b>MN =</b> Medicina Nuclear, <b>GI =</b> Gammagrafía industrial, <b>MF =</b> Medidores fijos, <b>IV =</b> Investigación, <b>DN =</b> Densímetro nuclear, <b>MM =</b> Medidores móviles, <b>E =</b> Docencia, <b>PR =</b> Perfilaje y registro, <b>TR =</b> Trazadores, <b>HD =</b> Hemodinamia, <b>OD =</b> Rayos x odontológico, <b>RX =</b> Radiodiagnóstico, <b>FL =</b> Fluoroscopia, <b>AM =</b> Aplicaciones Médicas, <b>AI =</b> Aplicaciones Industriales.
            Periodo de uso del Dosímetro: se relaciona la fecha asignada para inicio y terminación del periodo de medición, la cual es correspondiente con la marcación del dosímetro de acuerdo a la solicitud del cliente. Periodo de recambio: se refiere a la frecuencia de cambio en términos de MENS=Mes, TRIMS=Trimestre o BIMS=Bimestre.

    </p>
    <div style="position: relative; top:155px; text-align:justify; border:solid 0.3px #000; width: 99.2%; height:160px; padding:5px 5px 5px 5px; margin:0px;">
        <p style="text-align:justify; padding:5px 5px 5px 5px; margin:0px;">
            <b>UBICACIÓN DEL DOSÍMETRO:</b><br>
            Se refiere al uso o localización en el cuerpo, para la cual el dosímetro es suministrado.
        </p> 
        <table style="top:220px; text-align:center; border-collapse: collapse; padding:5px 5px 5px 5px;" border="1">
            <thead>
                <tr>
                    <th style= "">UBICACIÓN DOSÍMETRO</th>
                    <th style= "width: 35px;">USO</th>
                    <th style= "width: 35px;">TIPO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ÁREA</td>
                    <td>Monitor Ambiental</td>
                    <td>OSL</td>
                </tr>
                <tr>
                    <td>TÓRAX</td>
                    <td>Cuerpo Entero</td>
                    <td>OSL</td>
                </tr>
                <tr>
                    <td>CONTROL</td>
                    <td>Control en transporte y almacenamiento</td>
                    <td>OSL</td>
                </tr>
                <tr>
                    <td>CRISTALINO</td>
                    <td>Lente de Ojo</td>
                    <td>OSL</td>
                </tr>
                <tr>
                    <td>DEDO</td>
                    <td>Extremidad</td>
                    <td>OSL</td>
                </tr>
                <tr>
                    <td>MUÑECA</td>
                    <td>Extremidad</td>
                    <td>OSL</td>
                </tr>
                <tr>
                    <td>CASO</td>
                    <td>La que indique la institución</td>
                    <td>OSL</td>
                </tr>
            </tbody>
            
        </table>
        <br>
    </div>
    <p style="position: relative; top:156px; text-align:justify; border:solid 0.3px #000; width: 99.2%; padding:5px 5px 5px 5px; margin:0px;"> 
        <b>OBSERVACIONES DEL PERIODO:</b> <br>
            En este informe se encuentran los reportes de dosis de radiación correspondientes al periodo comprendido entre: 
            
            @foreach($trabajdosiasig as $dositrabj)
                @php
                    $datefix = date('d-m-Y',strtotime($dositrabj->primer_dia_uso));
                    $datefix2 = date('d-m-Y',strtotime($dositrabj->ultimo_dia_uso));
                @endphp
                <b>{{$datefix}} y {{$datefix2}}</b> 
                @break
            @endforeach
            <br>
            @if(count($dosicontrolasig) != 0)
                -   Se analizaron {{count($trabajdosiasig)}} dosímetros personales, {{count($dosiareasig)}} dosímetros ambientales y {{count($dosicontrolasig)}} dosímetros de control.
            @elseif(count($dosicontrolasig) == 0)
                -   Se analizaron {{count($trabajdosiasig)}} dosímetros personales, {{count($dosiareasig)}} dosímetros ambientales y {{count($dosicontrolasigUnico)}} dosímetros de control.
            @else
                -   Se analizaron {{count($trabajdosiasig)}} dosímetros personales y {{count($dosiareasig)}} dosímetros ambientales.
            @endif
            <br>
            @if(!empty($mesescantdosi))
                @foreach($mesescantdosi as $mesesobs)
                    @if($mesesobs->nota_cambiodosim != null)
                        - {{$mesesobs->nota_cambiodosim}} <br>
                    @endif
                @endforeach
            @endif
            @php
                $limites = 0;
                $control = 0;
                $contaminado = 0;
            @endphp
            @if(!empty($trabajdosiasig))
                @foreach($trabajdosiasig as $dositrabj)
                    @if($dositrabj->nota3 == 'TRUE' && $limites == 0)
                        - Se recomienda revisar el límite de las dosis permitidas.
                        <br>
                        @php $limites == 1; @endphp
                    @endif
                    @if($dositrabj->nota5 == 'TRUE')
                        @php $control += 1; @endphp
                    @endif
                    @if($dositrabj->nota6 == 'TRUE' && $contaminado == 0)
                        - Dosímetro contaminado con material radioactivo, se recomienda hacer investigación.
                        <br>
                        @php $contaminado += 1; @endphp
                    @endif

                @endforeach
            @else
                @foreach($dosiareasig as $dosiarea)
                    @if($dosiarea->nota3 == 'TRUE' && $limites == 0)
                        - Se recomienda revisar el límite de las dosis permitidas.
                        <br>
                        @php $limites == 1; @endphp
                    @endif
                    @if($dosiarea->nota5 == 'TRUE')
                        @php $control += 1; @endphp
                    @endif
                    @if($dosiarea->nota6 == 'TRUE' && $contaminado == 0)
                        - Dosímetro contaminado con material radioactivo, se recomienda hacer investigación.
                        <br>
                        @php $contaminado += 1; @endphp
                    @endif
                @endforeach
            @endif
               
            @if(count($dosicontrolasigUnico) == 0 && count($dosicontrolasig) == 0)
                - Control no utilizado en la evaluación.
                <br>
            @endif
            
    </p>


    
    
    
    {{-- <p style="position:absolute; top:500px; font-size:8px; text-align:justify;">
        <b>Nomenclatura y Notas Principales:</b> <b>N.A.</b>=No Aplica; <b>N.D.</b>= No Disponible; <b>M</b>=Dosis No Detectable, por debajo del umbral de medición de 0,1mSv;  <b> AUSENTE(ABSENT)=NP</b>=Dosímetro No Presentado; (1) <b> DNL</b>=Dosímetro No Legible; (2) <b>Control no restado en la evaluación (No control substracted)=DCNE</b>=Dosímetro Control No Evaluable; (3) <b>Control no utilizado en la evaluación (Control not used in assesment); </b> (4) <b>La imagen indica exposición estática(Imaging indicates an static exposure); </b> (5) <b>La imagen indica exposicion dinamica(Imaging indicates dinamic exposure); </b> (6) <b>Los resultados de la imagen son inconclusos, posible exposición mixta (estática y dinámica) (Dosimeter imaged, imaging results are inconclusive);  </b>  (7)<b>Dosímetro sin usar(Unused); </b> (8) <b>Dosímetro reprocesado, la segunda lectura coincide con la dosis reportada inicialmente(Dosimeter reprocessed, second read agrees with reported dose).</b>
    </p>
    
    <p style="position:absolute; width: 760px; top:533px; border:solid 0.1px #000; padding: 3px 18px 5px 5px; font-size:8px;" >
        [1] Varios registros para un mismo usuario, puede significar: i)que usa un segundo dosímetro, ej: de anillo, ii)que tiene reportes para mas de un periodo, al no haber entregado el dosímetro para su lectura.<br>
        [2] Un dosímetro puede ser no legible = DNL, por deterioro de los materiales portadores de los elementos sensibles a la radiacion.<br>
        [3] Una dosis reportada como M=ND=No Detectable, significa que la lectura está entre cero y el nivel mínimo de detección, que para la dosimetría OSL (Luminiscencia Estimulada Ópticamente) es de tan solo 0.01mSv (ver reverso del reporte para información más detallada).
       
    </p> 
    
    <p style="position:absolute; top:533px; left: 810px;  width: 428px; height:41px; border:solid 0.1px #000; padding:3px 18px 3px 8px; font-size:8px; text-align:justify;" >
        <b>Nota Importante:</b> <br> 
        La razón por la cual la ICRP=Comisión Internacional de Protección Radiológica, recomienda que el límite de dosis para Trabajadores Ocupacionalmente Expuestos sea de 20 mSv año obedece a estimar que la vida laboral de una persona es de 50 años y que en toda la vida debe recibirse como máximo una dosis de un Sievert.
    </p> --}}
    

    {{-- <div style="position:absolute; width: 100%; height:20px; page-break-before: always; font-size: 12px;">
        <p style="float: left; border:solid 1px #000; width: 31.5%;" align="center"> <b> INFORMACIÓN GENERAL </b></p>
        <P style="float: right; border:solid 1px #000; width: 67%;" align="center"> <b> INFORMACIÓN PARA LA LECTURA E INTERPRETACIÓN DEL INFORME </b> </P>
    </div>
    <!-- //////////////Primera Columna///////////// -->
    <div style=" position:absolute;  top:40px; border:solid 0.5px #000; width: 31.5%; height:680px; padding:0px;  font-size: 8px;">
        <p style="margin:4px; " align="center">
            <b> <u>LÍMITES ANUALES DE EXPOSICIÓN A RADIACIONES</u></b>
        </p>
        <table  style="top:20px; border:solid 2px #000; width:100%" border="1">
            <tr align="center">
                <td>CUERPO ENTERO, VIAS SANGUÍNEAS, ORGANOS, GÓNADAS:</td>
                <td>20 mSv\año</td>
            </tr>
            <tr align="center">
                <td>LENTE DE OJO</td>
                <td>150 mSv\año</td>
            </tr>
            <tr align="center">
                <td>EXTREMIDADES Y PIEL</td>
                <td>500 mSv\año</td>
            </tr>
            <tr align="center">
                <td>FETAL</td>
                <td>5 mSv/periodo de gestación o 1 mSv\año</td>
            </tr>
            <tr align="center">
                <td>PÚBLICO EN GENERAL</td>
                <td>1 mSv\año</td>
            </tr>
        </table>
        <div style="position:absolute;  top:85px; padding:0px;">
            <p style="text-align:justify; padding:10px 5px 2px 5px;"> 
                Las diferentes agencias regulatorias tienen diferentes límites de exposición. Verifique las regulaciones aplicadas en su práctica para cumplir con los requerimientos. <b> Se recalca la necesidad por parte de la entidad usuaria de realizar una investigación interna exhaustiva para determinar las causas de dosis altas, especialmente cuando los resultados superen los siguientes parámetros de referencia normativa: en tejido profundo cuando se registren dosis superiores a 1,7mSv por periodo mensual o su equivalente (3,33mSv para bimestral, 5mSv para trimestral).</b>
            </p>
            <p align="center">
                <b> <u>DOSÍMETRO DE CONTROL</u></b>
            </p>
            <P style="text-align:justify; padding:3px;">
                Un dosímetro de control (principal y/o de departamento) es incluido con cada entrega de dosímetros para monitorear la exposición a radiación recibida durante el tránsito y almacenamiento por los dosímetros personales y ambientales. En las instalaciones del cliente, el control debe guardarse en un área libre radiación durante el periodo de uso. Bajo ninguna circunstancia el dosímetro de control debe asignarse como dosímetro de medición ambiental o como dosímetro personal.
            </P>
            <p align="center">
                <b><u>MÍNIMA DOSIS EQUIVALENTE REPORTADA</u></b>
            </p>
            <p style="text-align:justify; padding:3px;">
                Dosis equivalentes por debajo de la cantidad mínima cuantificable para el período de uso son registradas como ‘’M’’. Los niveles mínimos de reporte varían de acuerdo con el tipo de dosímetro y calidad de la radiación, de acuerdo a los siguientes parámetros:
            </p>
            <table style="top:220px; border:solid 2px #000; text-align:center; width:100%"  border="1">
                <tr align="center">
                    <td>Photones (Rayos X y gamma)</td>
                    <td>0.01 mSv</td>
                </tr>
                <tr align="center">
                    <td>Beta</td>
                    <td>0.1 mSv</td>
                </tr>
                <tr align="center">
                    <td>Neutron</td>
                    <td>0.2 mSv (Rápido), 0.1 mSv</td>
                </tr>
                <tr align="center">
                    <td>Fetal</td>
                    <td>0.01 mSv</td>
                </tr>
                <tr align="center">
                    <td>Anillos</td>
                    <td>0.3 mSv</td>
                </tr>
            </table>
            <div style=" position:absolute; margin:0px; text-align:justify; top: 280px; padding:0px;">
                <p style="text-align:justify; padding:3px;">
                    “SL” es una opción elegible para la mínima dosis equivalente reportada en los dosímetros LUXEL® para fotones (Rayos X y Gamma). Exposiciones menores de 0.01 mSv reportados como “M”, y las exposiciones iguales o superiores a 0.01 mSv empiezan a reportar con
                    0.01 mSv y reportan con incrementos de 0.01 mSv.
                </p>
                <p  style="padding-left:5px;">
                    <b><u>LECTURA DEL ANILLO Y LECTURAS DE CRISTALINO:</u></b>
                </p>
                <p style="text-align:justify; padding:3px;">
                    Las lecturas de anillo se reportan como una dosis superficial. Las lecturas de dosímetro de cristalino (lente de ojo) se reportan como una dosis de lente de ojo y superficial.
                </p>
                <p style="padding-left:5px;">
                    <b><u>CÁLCULOS ESPECIALES:</u></b>
                </p>
                <p style="text-align:justify; padding:3px;">
                    Pueden hacerse cálculos especiales de dosis a usuarios que utilicen chalecos y otros instrumentos de blindaje, a saber: <br>
                    1)	EDE 1 - Dos dosímetros: 1 dosímetro dispuesto al nivel de la cintura bajo el blindaje y 1 dosímetro dispuesto al nivel del cuello fuera del blindaje 1.5 (cintura) +0.04 (cuello) = Dosis Profunda Equivalente asignada <br>
                    2)	EDE 2- Un dosímetro: 1 dosímetro dispuesto por fuera del blindaje. <br>
                    0.30 (dosímetro de cuerpo entero) = Dosis Profunda Equivalente Asignada <br>    
                    La línea “asignada” seguirá todas las dosis originales para dosímetro de cuerpo entero con el cálculo de resultados EDE 1 o EDE 2 o bien, el protocolo de asignación de dosis de Landauer (dosis profunda y superficial de cuerpo entero de la lectura más alta para el dosímetro de cuerpo entero y dosis de lente de ojo del dosímetro más cercano al ojo).
                </p>
                <p style="padding-left:5px;">
                    <b><u>DOSIMETRO FETAL:</u></b>
                </p>
                <p style="  text-align:justify; padding:5px;">
                    Una usuaria declarada en estado de embarazo generará el registro de la exposición fetal en una página extra del reporte basada en el dosímetro de cuerpo entero situado  en el lugar más cercano al feto. La dosis asignada al feto es reportada para el periodo de uso actual, así como la dosis estimada desde la concepción hasta la declaración de estado de embarazo (de ser suministrada por el usuario) y una dosis total desde la declaración de estado de embarazo hasta el presente.
                </p>
            </div>
        </div>    
    </div>
    <!-- /////////// Segunda Columna /////////////////7 -->
    <div style=" position:absolute; top:40px; left:415px; width: 67%; height:680px; padding:0px; font-size: 8px;">
        <div style=" float: left; border:solid 0.5px #000; width: 49%; height:680px; padding:0px;">
            <p style="right:50px; top:50px;" align="center"> 
                <b><u>INFORMACIÓN DEL REPORTE DE EXPOSICIÓN</u></b>
            </p>
            <p style="text-align:justify; padding:5px;">
                <br>
                La información para cada participante se registrará en una o más líneas, de la siguiente manera:
                
            </p>
            <p style=" padding:5px;">
                <b><u>INFORMACION DE LOS USUARIOS DEL SERVICIO:</u></b>
            </p>
            <p style="padding:5px;"> 
                <b>Número de usuario o participante:</b> Número único asignado por Landauer.
            </p>
            <p style="text-align:justify; padding:5px;">
                Nombre(s) y Apellido(s):  identificando la persona a la cual el dosímetro es asignado. Género (M=Masculino, F=Femenino); Documento de Identidad. Fecha de Ingreso al Servicio: corresponde a la fecha en que Landauer empezó a mantener registros de dosimetría para un participante en la cuenta actual, o de la última reactivación del servicio, de aplicar.
                <br>
                <br>
                La información personal de cada participante consistente en Documento de Identificación (Cedula de Ciudadanía o Extranjería), fecha de nacimiento y género, puede ser suprimida en duplicado de reportes por razones de privacidad.
            </p>
            <p style="text-align:justify; padding:5px;">
                <b><u>Ocupación: </u></b> de acuerdo con la información suministrada por la entidad contratante, se clasifica la ocupación con la siguiente nomenclatura: T=Teleterapia, B=Braquiterapia, N=Medicina Nuclear, G=Gammagrafía industrial, F=Medidores fijos, I=Investigación, D=Densímetro nuclear, M=Medidores móviles, E=Docencia, P=Perfilaje y registro, T=Trazadores, H=Hemodinamia, X=RX periapicales, R=Radiodiagnóstico, S=Fluoroscopía, AM=Aplicaciones Médicas, AI=Aplicaciones Industriales.
            </p>
            
            <p style="padding:5px;">
                <b><u>INFORMACION DEL PERIODO DE USO, DOSIMETRO Y RADIACION :</u></b> 
            </p>
            <p style="text-align:justify; padding:5px;"> 
                <b >Periodo de uso del Dosimetro:</b>se relaciona la fecha asignada para inicio y terminacion del periodo de medicion, la cual es correspondiente con la marcación del dosímetro de acuerdo a la solicitud del cliente. Periodo de recambio: se refiere a la frecuencia de cambio en términos de M=Mes, B=Bimestre o T=Trimestre, o PERS=Personalizado.
            </p>
            <p style="text-align:justify; padding:5px;"> 
                <b> <u>Tipo de Dosímetro:</u></b>clase de dosímetro de acuerdo a las necesidades de monitoreo a radiación, a saber:
            </p>
            <br>
            <br>
            <table style="border:solid 2px #000; top:400px; left:35px;"  border="1">
                <tr align="center">
                    <td rowspan="3">LUXEL® (OSL):</td>
                    <td>P, Pa:</td>
                    <td>Fotones (Rayos X, Gamma), Beta.</td>
                </tr>
                <tr align="center">
                    <td>J, Ja :</td>
                    <td>Fotones (Rayos X, Gamma), Beta, Neutrón rápido</td>
                </tr>
                <tr align="center">
                    <td>T, Ta:</td>
                    <td>Fotones (Rayos X, Gamma), Beta, Neutrón rápido y neutron termal.</td>
                </tr>
                <tr align="center">
                    <td>ANILLO (TLD):</td>
                    <td>U, S :</td>
                    <td>Fotones (Rayos X, Gamma), Beta.</td>
                </tr>
                <tr align="center">
                    <td>CRISTALINO (TLD):</td>
                    <td>S :</td>
                    <td>Fotones (Rayos X, Gamma), Beta.</td>
                </tr>
            </table>
            <div style=" position:absolute; margin:0px; padding:0px; text-align:justify; top: 470px;  height: 200px; padding:0px;">
                <p style="top:28px; text-align:justify; padding:5px;"> 
                    <b>Ubicación del dosímetro:</b> Se refiere al uso o localización en el cuerpo, para la cual el dosímetro es suministrado, <br>
                    a saber:
                </p>
                <table style="border:solid 2px #000; left:2px; width: 412px; top:37px;"  border="1">
                    <thead>
                        <tr >
                            <th>Uso</th>
                            <th>Localización</th>
                            <th>Uso</th>
                            <th>Localización</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td>AREA</td>
                            <td>Monitor Ambiental</td>
                            <td>OEXTRM</td>
                            <td>Extremidad - Adicional</td>
                        </tr>
                        <tr align="center"> 
                            <td>CHEST</td>
                            <td>Pecho</td>
                            <td>OWHBDY</td>
                            <td>Cuerpo Entero – Adicional</td>
                        </tr>
                        <tr align="center">
                            <td>CNTRL</td>
                            <td>Control</td>
                            <td>RANKLE</td>
                            <td>Tobillo Derecho</td>
                        </tr>
                        <tr align="center">
                            <td>COLLAR</td>
                            <td>Cuello</td>
                            <td>RFINGR</td>
                            <td>Dedo Derecho</td>
                        </tr>
                        <tr align="center">
                            <td>EYE</td>
                            <td>Ojo</td>
                            <td>RUARM</td>
                            <td>Brazo Derecho – Alto</td>
                        </tr>
                        <tr align="center">
                            <td>FETAL</td>
                            <td>Fetal</td>
                            <td>RULEG</td>
                            <td>Pierna Derecha – Alto</td>
                        </tr>
                        <tr align="center">
                            <td>LANKLE</td>
                            <td>Tobillo Izquierdo</td>
                            <td>RWRIST</td>
                            <td>Muñeca Derecha</td>
                        </tr>
                        <tr align="center">
                            <td>LFINGR</td>
                            <td>Dedo Izquierdo</td>
                            <td>SPECL</td>
                            <td>Propósito Especial</td>
                        </tr>
                        <tr align="center"> 
                            <td>LUARM</td>
                            <td>Brazo Izquierdo – Alto</td>
                            <td>UPBACK</td>
                            <td>Espalda Alta</td>
                        </tr>
                        <tr align="center">
                            <td>LULEG</td>
                            <td>Pierna Izquierda – Alto</td>
                            <td>WAIST</td>
                            <td>Cintura</td>
                        </tr>
                        <tr align="center"> 
                            <td>LWBACK</td>
                            <td>Espalda Baja</td>
                            <td>WHBODY</td>
                            <td>Cuerpo Entero</td>
                        </tr>
                        <tr align="center">
                            <td>LWRIST</td>
                            <td>Muñeca Izquierda</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
        <!-- /////// Tercera Columna//////////// -->
        <div  style=" float: right; border:solid 0.5px #000; width: 49%; height:680px; padding:0px;">
            <br><br>
            <p style="top:30px; text-align:justify; padding:5px;"> 
                <b> <u> Energía o calidad de radiación:</u> </b> Tipos y energías de radiación incorporadas en la dosis equivalente de cuerpo entero, a saber:
            </p>
            <p style="top:30px; margin:4px; padding:7px; " >
                B : Beta <br>
                BH : Beta de alta energía, por ejemplo, Estroncio, Fósforo BL : Beta de baja energía, por ejemplo, Talio, Kriptón <br>
                BN : Beta, Neutrón (Mezcla) BS : Beta - Estroncio <br>
                BT : Beta - Talio BU : Beta - Uranio <br>
                NF : Neutrones Rápidos NT : Neutrones Termales <br>
                P : Fotones (Rayos X o Gamma) PB : Fotón, Beta (Mezcla) <br>
                PBN : Fotón, Beta, Neutrón (Mezcla) <br>
                PH : Fotón de alta energía, superior de 200 KeV PL : Fotón de baja energía, inferior de 40 KeV <br>
                PM : Fotón de media energía de 40 KeV a 200 KeV PN : Fotón, Neutrón (Mezcla) <br>
            </p>
            <p style="margin:4px;" align="center">
                <b><u>INFORMACIÓN DEL REPORTE DE EXPOSICIÓN </u></b>
            </p>
            <br>
            <p style=" padding:5px;">
                <b><u>INFORMACION DE LAS DOSIS REPORTADAS</u></b>
            </p>
            <p style=" text-align:justify; padding:5px; "> 
                <b> Dosis Equivalentes Para Tejido Profundo, Hp(10) (DDE):</b> La dosis equivalente para tejido profundo aplica para la exposición externa de cuerpo entero, a una profundidad de tejido de 1 centímetro (1000 mg/cm2), equivalente a 10mm de profundidad. <br>
                <b> Dosis equivalente para Lente De Ojo, Hp(3) (LDE):</b> La dosis equivalente para ojo aplica para la exposición externa de los lentes, a una profundidad de tejido de 0.3 centímetros (300 mg/cm2), equivalente a 3mm de profundidad. <br>
                <b> Dosis equivalente en Tejido Superficial, piel o extremidades, Hp(0.07): </b> La dosis equivalente para tejido superficial aplica para la exposición externa de la piel o extremidades a una profundidad de tejido de 0.007 centímetros (7 mg/cm2) promediada para una área de 1 cm2, equivalente a 0,07mm de profundidad. <br>
                <br>
                <br>
                <b> "Dosis del periodo (mSv)":</b> corresponde a las dosis registradas en el periodo de lectura en monitoreo. <br>
                <b> “Dosis Acumulada año corrido”:</b> corresponden a las dosis recibidas desde el comienzo del año hasta la fecha. <br>
                <b> “Dosis Acumulada desde el ingreso al servicio”:</b> corresponde a las dosis recibidas desde el comienzo del servicio hasta la  fecha. Estas dosis pueden ser acumulativas en la vida del paciente o estrictamente concernientes a la entidad que contrata el servicio. De ser aplicable, la exposición interna se sumará con las dosis externas equivalentes determinadas por Landauer. La dosis total efectiva equivalente es la suma de la dosis profunda equivalente (exposición externa) y la dosis efectiva experimentada (exposición interna).
                <br>
                <br>
                <br>
                <b> Notas:</b> Son los mensajes de texto explic  ando cualquier anormalidad  o  comentario respecto a las dosis registradas. La nota con el mensaje aparece en una línea separada debajo de la información de exposición del dosímetro.
            </p>
            <p style="padding:5px;">
                <b><u>NIVELES DE DOSIS POR PERIODOS DE MEDICION</u></b>
            </p>
            <p style="top:30px; text-align:justify; padding:5px;"> 
                En desarrollo del servicio de dosimetría, se establecen como dosis sujetas a la necesidad de investigación interna en la institución cliente las lecturas registradas por encima de los siguientes límites:
                <br>
                <br>
                Para Dosis Profunda HP(10), o “Deep”, de acuerdo a la frecuencia  de lectura, a saber: dosis superiores a 1.7 mSv en un periodo mensual de medición; 3.33 mSv en un periodo bimestral de medición; y 5 mSv para un periodo trimestral de medición.
                <br>
                <br>
                Adicionalmente, le informamos la necesidad de controlar la exposición ocupacional de todo trabajador, de forma que no rebasen en sus registros de dosis equivalentes resultantes según la profundidad y la frecuencia de medición, los siguientes limites: 1) Para Dosis de Cristalino del Ojo HP(3), o “EYE”: dosis superiores a 12.5 mSv en un periodo mensual de medición; 25 mSv en un periodo bimestral de medición; y 37.5 mSv para un periodo trimestral de medición. 2) Para Dosis Superficial HP(0.07), o “SHALLOW”: dosis superiores a 41.67 mSv en un periodo mensual de medición; 83.33 mSv en un periodo bimestral de medición; y 125 mSv para un periodo trimestral de medición.
            </p>
        </div>
    </div> --}}

        <!-- ////////////////////SCRIPT PARA CONTAR LAS PAGINAS/////////////// -->
        <script type="text/php">
            if (isset($pdf)) {
                $text = "página {PAGE_NUM} de {PAGE_COUNT}";
                $size = 8;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 38;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });

        $(document).ready(function(){
            $('#hp10_trabjasig').on('change', function(){
                var hp10 = document.getElementById("hp10_trabjasig");
                console.log(hp10);
            })

        
        })
    </script>


</body>
