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
                        $trabj = 0;
                        $areas = 0
                    @endphp
                    @foreach($dosiareasig as $dosiarea)
                        @if($dosiarea->measurement_date != NULL)
                            @php $areas ++; @endphp
                        @endif
                    @endforeach
                    @foreach($trabajdosiasig as $dositrabj)
                        @if($dositrabj->measurement_date != NULL)
                            @php $trabj ++; @endphp
                        @endif
                    @endforeach
                    @if($areas == 0 && $trabj == 0)
                        @php $hoy = getdate(); @endphp
                        {{date('d-m-Y',strtotime($hoy))}}
                    @endif
                    @if($areas != 0)
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
                            
                            $resultado = fechaMasRepetida($fechas);
                            $fechaReporte = $resultado;
                            
                        @endphp
                        {{date('d-m-Y',strtotime($fechaReporte))}}
                    @elseif($trabj != 0)
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
                            
                            $resultado = fechaMasRepetida($fechas);
                            $fechaReporte = $resultado;
                        @endphp
                        {{date('d-m-Y',strtotime($fechaReporte))}}
                    @endif
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp10_calc_dose >= 0  && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp007_calc_dose >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp10_calc_dose >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_calc_dose >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp007_calc_dose >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_calc_dose >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                            <td id ="hp10_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if(($dositrabj->Hp10_calc_dose >= 1.67)) color: #ff0000;  @endif " align="center">
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
                            <td id="hp007_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; @if(($dositrabj->Hp007_calc_dose >= 1.67)) color: #ff0000;  @endif" align="center">
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
                            <td id="hp3_trabjasig" style="padding-top:5px; padding-bottom:5px; border:0.1px solid black; border-right:1px solid black;  @if(($dositrabj->ubicacion == 'CRISTALINO' && $dositrabj->Hp3_calc_dose >= 12.5)) color: #ff0000; @elseif(($dositrabj->Hp007_calc_dose >= 1.67)) color: #ff0000; @endif" align="center">
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion  && $sumadocemeses[$i]->Hp10_calc_dose >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp007_calc_dose >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp3_calc_dose >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp10_calc_dose >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp007_calc_dose >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp3_calc_dose >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp3_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte) 
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp3_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumadocemeses[$i]->areadepartamentosede_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dosiarea->areadepartamentosede_id == $sumaFImeses[$i]->areadepartamentosede_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp10_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp007_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumadocemeses[$i]->persona_id && $sumadocemeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumadocemeses[$i]->ubicacion && $sumadocemeses[$i]->Hp3_dif_dosicont >= 0 && $sumadocemeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp10_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp007_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
                                        @if($dositrabj->persona->id_persona == $sumaFImeses[$i]->persona_id && $sumaFImeses[$i]->contratodosimetriasededepto->departamentosede_id == $contdosisededepto->departamentosede_id && $dositrabj->ubicacion == $sumaFImeses[$i]->ubicacion && $sumaFImeses[$i]->Hp3_dif_dosicont >= 0 && $sumaFImeses[$i]->ultimo_dia_uso <= $fechaReporte)
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
