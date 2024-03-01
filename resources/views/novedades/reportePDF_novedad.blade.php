<style>
    @page {
        margin: 0cm 0cm;
    } 
    body{
        /* background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 12px;
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
        bottom: 0.5cm; 
        left: 2cm; 
        right: 2cm;
        height: 1.5cm;
        /* margin-top: 100px; */
        text-align:center;
        color:#1A9980;
        /* background: yellowgreen; */
       
    }
    footer p {
        margin: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
        opacity:0.5;
        /* background: yellow; */
    }
    main{
        position: relative;
        top: 75px;
        left: 0cm;
        right: 0cm;
        margin-bottom: 4cm;
        display:block;
       /*  background: yellow; */
    }
    main p {
        margin: 0px;
        padding-top: 2px;
        padding-bottom:2px;
        line-height: 130%;
    }
    td, th{
        border:0.1px solid black;
    }
    
    .indices{
        position: fixed;
        display:block;
        left: 2cm; 
        right: 2cm;
        text-align:justify;
        bottom: 3.7cm; 
        /* background: yellow; */
    }
    .indices p{
        padding-top: 0px;
        padding-bottom:0px;
        line-height: 1.2;
       /*  background: yellow; */
    }
    #watermark {
        position: fixed;
        /** 
            Set a position in the page for your image
            This should center it vertically
        **/
        top:      115px;
        left:     2cm;
        /** Change image dimensions**/
        /** Your watermark should be behind every content**/
        z-index:  -1000;
        opacity:0.03;
    }
</style> 
<body>
    <header>
        <img src="{{asset('imagenes/1VerdeSF.png')}}" width="180" style="position:relative; right:20px; bottom: 10px;">
        <img src="{{asset('imagenes/1SERVICIOS_QA.png')}}" width="330" style="position:relative; left:130px; top:15px;">
        {{-- <img src="{{asset('imagenes/SERVICIOS_QA.png')}}" width="330" style="position:relative; left:130px; bottom: 15px;"> --}}
    </header>
    <footer>
        <p>______________________________________________________________________________________</p>
        <p >Servicios en dosimetría, protección radiológica y controles de calidad equipos de Rayos X</p>
        <p style="top:30px;">dosimetria.qapositron@gmail.com – 301 449 5401 – 310 607 9375 – 304 338 6581</p>
        <p>www.qapositron.com</p>
    </footer>
    <main>
        <div class="container">
            <p style="position:relative;">Bucaramanga, 
                @php
                    $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'octubre', "11"=>'noviembre', "12"=>'diciembre'];
                    echo date("d")." ".$meses[date("m")]." ".date("Y") ;
                @endphp
            </p>
            <br>
            <p style="position:relative;">Señores</p>
            
            <p style="position:relative;"><b>{{$contrato->empresa->razon_social_empresa}}</b></p>
            <p style="position:relative;">@if($contrato->empresa->tipo_identificacion_empresa == 'NIT') NIT: {{$contrato->empresa->num_iden_empresa}}-{{$contrato->empresa->DV}} @elseif($contrato->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA')CC: {{$contrato->empresa->num_iden_empresa}} @endif</p>
            <p style="position:relative;">Dirección: {{$contrato->empresa->direccion_empresa}}</p>
            <p style="position:relative;">Municipio: @php echo ucwords(mb_strtolower($contrato->empresa->municipios->nombre_municol, "UTF-8")); @endphp - @php echo ucwords(strtolower($contrato->empresa->municipios->coldepartamento->nombre_deptocol)); @endphp </p>
            <br>
            @if(count($novedadmeses)> 1)
                <p style="position:relative;"> <b>Ref.: histórico de novedades en dosímetros HIST-NOV-OSL-QA- 
                    @php 
                        date_default_timezone_set('America/Bogota');
                        echo date("Y").date("m").date("d").date("H").date("i").date("s"); 
                    @endphp</b>
                </p>
                <br>
                <p style="position:relative;">Cordial saludo,</p>
                <br>
            
                <p style="position:relative; text-align:justify;">A continuación se lista el historial de las novedades de dosímetria con respecto a la solicitud recibida.</p>
                <br>
                
                @foreach($novedadmeses as $key =>$nov)
                    <table style=" margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; font-size:9px; width: 90%;" cellpadding="7">
                        <thead>
                            <tr style="background-color:#1A9980; color:white;">
                                <th colspan="6">NOVEDAD No. 
                                    @php
                                        $n = $nov->codigo_novedad;
                                        $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
                                        echo $titulo;
                                    @endphp
                                </th>
                            </tr>
                            <tr style="background-color:#1A9980; color:white;">
                                <th style="text-align:center; width: 11%;">FECHA</th>
                                <th style="text-align:center; width: 11%;">CAMBIO</th>
                                <th style="text-align:center; width: 20%;">PERÍODO</th>
                                <th style="text-align:center;">TIPO DOSÍMETRO</th>
                                <th style="text-align:center;">TRABAJADOR / ÁREA</th>
                                <th style="text-align:center;">No. DE IDENTIFICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cambiosNovedad as $cambio)
                                @if($nov->id_novedadmesescontdosi == $cambio->novedadmesescontdosidepto_id)
                                    @if($cambio->tipo_novedad == '1')
                                        <tr>
                                            <td style="text-align:center;">
                                                @php
                                                    $fecha = date("t-m-Y",strtotime($cambio->created_at));
                                                    echo $fecha;
                                                @endphp
                                            </td>
                                            <td style="text-align:center;">
                                                INGRESO
                                            </td>
                                            @if($cambio->trabajadordosimetro_id != null)
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->primer_dia_uso}} - {{$cambio->trabajadordosimetro->ultimo_dia_uso}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->ubicacion}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetro->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetro->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetro->persona->segundo_apellido_persona}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->persona->cedula_persona}}</td>
                                            @elseif($cambio->dosiarea_id != null)
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedes->primer_dia_uso}} - {{$cambio->dosiareacontdosisedes->ultimo_dia_uso}}</td>
                                                <td style="text-align:center;">AMBIENTAL</td>
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedes->areadepartamentosede->nombre_area}}</td>
                                                <td style="text-align:center;">N.A.</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($cambio->tipo_novedad == '2')
                                        <tr>
                                            <td style="text-align:center;">
                                                @php
                                                    $fecha = date("t-m-Y",strtotime($cambio->created_at));
                                                    echo $fecha;
                                                @endphp
                                            </td>
                                            <td style="text-align:center;">
                                                RETIRO
                                            </td>
                                            <td style="text-align:center;">
                                                @if($nov->dosimetriacontrato->periodo_recambio == 'MENS')
                                                    @php
                                                        $inicioPM = date("d-m-Y", strtotime($nov->dosimetriacontrato->fecha_inicio));
                                                        $finPM = date("t-m-Y",strtotime($inicioPM));
                                                        $numLec = $nov->dosimetriacontrato->numlecturas_año;
                                                        $xx = 1;
                                                        for($i=0; $i<=$numLec; $i++){
                                                            $ultimoDiaPM = date("d-m-Y",strtotime($finPM."+ 1 days")); 
                                                           /*  echo "ultimodia= ".$ultimoDiaPM."<br>"; */
                                                            $fecha1 = date("d-m-Y", strtotime($ultimoDiaPM."+ ".$i." month"));
                                                            $fecha2 = date("t-m-Y", strtotime($fecha1));
                                                            /* echo $fecha1."---".$fecha2."<br>"; */
                                                            $xx ++;
                                                            /* echo $i ."<br>";
                                                            echo "xx= ".$xx."<br>"; */
                                                            if($xx == $cambio->mes_asignacion){
                                                               echo $fecha1." - ".$fecha2;
                                                            }
                                                        }
                                                    @endphp
                                                {{-- @elseif($nov->dosimetriacontrato->periodo_recambio == 'TRIMS')
                                                    @php  
                                                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                                        $inicio = date($nov->dosimetriacontrato->fecha_inicio);
                                                        $fecha1 = date("t-m-Y",strtotime($inicio));
                                                        $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                                                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("j", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
                                                    @endphp--}}
                                                @elseif($nov->dosimetriacontrato->periodo_recambio == 'BIMS')
                                                    @php  
                                                        $inicioPM = date("d-m-Y", strtotime($nov->dosimetriacontrato->fecha_inicio));
                                                        echo "FECHA1 =".$inicioPM;
                                                        $finPM = date("t-m-Y",strtotime($inicioPM)."+ 1 month");
                                                        echo "FECHA2 = ".$finPM; 
                                                        $numLec = $nov->dosimetriacontrato->numlecturas_año;
                                                        $xx = 1;
                                                        for($i=0; $i<=$numLec; $i++){

                                                        }
                                                        /* fecha1 = date($nov->dosimetriacontrato->fecha_inicio);
                                                        $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                                                        echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total)) */
                                                    @endphp 
                                                @endif
                                            </td>
                                            @if($cambio->persona_id != null)
                                                <td style="text-align:center;">{{$cambio->ubicacion}}</td>
                                                <td style="text-align:center;">{{$cambio->persona->primer_nombre_persona}} {{$cambio->persona->segundo_nombre_persona}} {{$cambio->persona->primer_apellido_persona}} {{$cambio->persona->segundo_apellido_persona}}</td>
                                                <td style="text-align:center;">{{$cambio->persona->cedula_persona}}</td>
                                            @elseif($cambio->areadepartamentosede_id != null)
                                                <td style="text-align:center;">AMBIENTAL</td>
                                                <td style="text-align:center;">{{$cambio->areadepartamentosede->nombre_area}} </td>
                                                <td style="text-align:center;">N.A.</td>
                                            @elseif($cambio->trabajadordosimetro_ant_id != null)
                                                <td style="text-align:center;">{{$cambio->ubicacion}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetroAnterior->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetroAnterior->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetroAnterior->persona->segundo_apellido_persona}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->persona->cedula_persona}}</td>
                                            @elseif($cambio->dosiarea_ant_id != null)
                                                <td style="text-align:center;">AMBIENTAL</td>
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedesAnterior->areadepartamentosede->nombre_area}}</td>
                                                <td style="text-align:center;">N.A.</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($cambio->tipo_novedad == '3')
                                        <tr>
                                            <td style="text-align:center;">
                                                @php
                                                    $fecha = date("t-m-Y",strtotime($cambio->created_at));
                                                    echo $fecha;
                                                @endphp
                                            </td>
                                            <td style="text-align:center;">
                                                INGRESO
                                            </td>
                                            @if($cambio->trabajadordosimetro_id != null)
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->primer_dia_uso}} - {{$cambio->trabajadordosimetro->ultimo_dia_uso}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->ubicacion}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetro->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetro->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetro->persona->segundo_apellido_persona}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetro->persona->cedula_persona}}</td>
                                            @elseif($cambio->dosiarea_id != null)
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedes->primer_dia_uso}} - {{$cambio->dosiareacontdosisedes->ultimo_dia_uso}}</td>
                                                <td style="text-align:center;">AMBIENTAL</td>
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedes->areadepartamentosede->nombre_area}}</td>
                                                <td style="text-align:center;">N.A.</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                                @php
                                                    $fecha = date("t-m-Y",strtotime($cambio->created_at));
                                                    echo $fecha;
                                                @endphp
                                            </td>
                                            <td style="text-align:center;">
                                                RETIRO
                                            </td>
                                            @if($cambio->trabajadordosimetro_ant_id != null)
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->primer_dia_uso}} - {{$cambio->trabajadordosimetroAnterior->ultimo_dia_uso}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->ubicacion}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetroAnterior->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetroAnterior->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetroAnterior->persona->segundo_apellido_persona}}</td>
                                                <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->persona->cedula_persona}}</td></td>
                                            @elseif($cambio->dosiarea_ant_id != null)
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedesAnterior->primer_dia_uso}} - {{$cambio->dosiareacontdosisedesAnterior->ultimo_dia_uso}}</td>
                                                <td style="text-align:center;">AMBIENTAL</td>
                                                <td style="text-align:center;">{{$cambio->dosiareacontdosisedesAnterior->areadepartamentosede->nombre_area}}</td>
                                                <td style="text-align:center;">N.A.</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                @endforeach
                <br>
                <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número (HIST-NOV-OSL-QA) del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
            @else
                <p style="position:relative;"> <b>Ref.: notificación de novedad en dosímetros asignados NOV-OSL-QA- 
                    @php 
                        date_default_timezone_set('America/Bogota');
                        echo date("Y").date("m").date("d").date("H").date("i").date("s"); 
                    @endphp</b>
                </p>
                <br>
                <p style="position:relative;">Cordial saludo,</p>
                <br>
                <p style="position:relative; text-align:justify;">Deseamos informarles que hemos llevado a cabo la solicitud diligenciada en el formato de novedad, por ello se listan los cambios realizados en tres tablas:
                    ingreso de dosímetros, es decir la cantidad de dosímetros contrados aumenta; 
                    retiro de dosímetros, la cantidad de dosímetros contratados disminuye y
                    cambio de trabajadores, consta de un ingreso y un retiro de un trabajador u área.
                </p>
                <br>
                <p style="text-align:center;">
                    <b>
                        NOVEDAD No.
                        @php
                            $n = $novedadmeses[0]->codigo_novedad;
                            $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
                            echo $titulo;
                        @endphp
                    </b>
                </p>
                @php
                    $ing = 0;
                    $ret = 0;
                    $cam = 0;
                @endphp
                @foreach($cambiosNovedad as $cambios)
                    @if($cambios->tipo_novedad == 1)
                    @php $ing ++; @endphp
                    @endif
                    @if($cambios->tipo_novedad == 2)
                        @php $ret ++; @endphp
                    @endif
                    @if($cambios->tipo_novedad == 3)
                        @php $cam ++; @endphp
                    @endif
                @endforeach
                <br>
                @if($ing != 0) 
                    <table style=" margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; font-size:9px; width: 90%;" cellpadding="7">
                        <thead>
                            <tr>
                                <th style="text-align:center;" colspan='4'>INGRESO DE DOSíMETRO</th>
                            </tr>
                            <tr style="text-align:center;">
                                <th style="text-align:center; width: 11%;">FECHA</th>
                                <th style="text-align:center; width: 20%;">PERÍODO</th>
                                <th style="text-align:center;">TRABAJADOR / ÁREA</th>
                                <th style="text-align:center;">UBICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cambiosNovedad as $cambio)
                                @if($cambio->tipo_novedad == 1)
                                    <tr>
                                        <td style="text-align:center;">
                                            @php
                                                $fecha = date("t-m-Y",strtotime($cambio->created_at));
                                                echo $fecha;
                                            @endphp
                                        </td>
                                        @if($cambio->trabajadordosimetro_id != null)
                                            <td style="text-align:center;"> {{$cambio->trabajadordosimetro->primer_dia_uso}} - {{$cambio->trabajadordosimetro->ultimo_dia_uso}}</td>
                                            <td style="text-align:center;"> {{$cambio->trabajadordosimetro->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetro->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetro->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetro->persona->segundo_apellido_persona}} </td>
                                            <td style="text-align:center;"> {{$cambio->trabajadordosimetro->ubicacion}}</td>
                                        @elseif($cambios->dosiarea_id != null)
                                            <td style="text-align:center;"> {{$cambio->dosiareacontdosisedes->primer_dia_uso}} - {{$cambio->dosiareacontdosisedes->ultimo_dia_uso}}</td>
                                            <td style="text-align:center;"> {{$cambio->dosiareacontdosisedes->areadepartamentosede->nombre_area}}</td>
                                            <td style="text-align:center;"> AMBIENTAL</td>
                                        @elseif($cambios->dosicontrol_id != null)
                                            <td style="text-align:center;"> {{$cambio->dosicontrolcontdosisedes->primer_dia_uso}} - {{$cambio->dosicontrolcontdosisedes->ultimo_dia_uso}}</td>
                                            <td style="text-align:center;"> "CONTROL TRANSPORTE"</td>
                                            <td style="text-align:center;"> {{$cambio->dosicontrolcontdosisedes->ubicacion}}</td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <br>
                @if($ret != 0)
                    <table style=" margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; font-size:9px; width: 90%;" cellpadding="7">
                        <thead>
                            <tr>
                                <th class="table-active text-center" colspan='4'>RETIRO DE DOSíMETRO</th>
                            </tr>
                            <tr class="table-active text-center">
                                <th style='width: 11%'>FECHA</th>
                                <th style='width: 20%'>PERÍODO</th>
                                <th>TRABAJADOR / ÁREA</th>
                                <th>UBICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cambiosNovedad as $cambios)
                                @if($cambios->tipo_novedad == 2)
                                    <tr>
                                        <td style="text-align:center;">
                                            @php
                                                $fecha = date("t-m-Y",strtotime($cambios->created_at));
                                                echo $fecha;
                                            @endphp
                                        </td>
                                        <td style="text-align:center;">
                                            @if($novedadmeses[0]->dosimetriacontrato->periodo_recambio == 'MENS')
                                                @php
                                                    $inicioPM = date("d-m-Y", strtotime($novedadmeses[0]->dosimetriacontrato->fecha_inicio));
                                                    $finPM = date("t-m-Y",strtotime($inicioPM));
                                                    $numLec = $novedadmeses[0]->dosimetriacontrato->numlecturas_año;
                                                    $xx = 1;
                                                    for($i=0; $i<=$numLec; $i++){
                                                        $ultimoDiaPM = date("d-m-Y",strtotime($finPM."+ 1 days")); 
                                                    /*  echo "ultimodia= ".$ultimoDiaPM."<br>"; */
                                                        $fecha1 = date("d-m-Y", strtotime($ultimoDiaPM."+ ".$i." month"));
                                                        $fecha2 = date("t-m-Y", strtotime($fecha1));
                                                        /* echo $fecha1."---".$fecha2."<br>"; */
                                                        $xx ++;
                                                        /* echo $i ."<br>";
                                                        echo "xx= ".$xx."<br>"; */
                                                        if($xx == $cambios->mes_asignacion){
                                                            echo $fecha1." - ".$fecha2;
                                                        }
                                                    }
                                                @endphp
                                            @elseif($novedadmeses[0]->dosimetriacontrato->periodo_recambio == 'BIMS')
                                                @php  
                                                    $inicioPM = date("d-m-Y", strtotime($novedadmeses[0]->dosimetriacontrato->fecha_inicio));
                                                    echo "FECHA1 =".$inicioPM."<br>";
                                                    $finPM = date("t-m-Y",strtotime($inicioPM."+ 1 month"));
                                                    echo "FECHA2 = ".$finPM."<br>"; 
                                                    $numLec = $novedadmeses[0]->dosimetriacontrato->numlecturas_año;
                                                    $xx = 1;
                                                    for($i=0; $i<=($numLec+1); $i=$i+2){
                                                        $ultimoDiaPM = date("d-m-Y",strtotime($finPM."+ 1 days"));
                                                        echo "ultimodia= ".$ultimoDiaPM."<br>";
                                                        echo $i ."<br>";
                                                        $fecha1 = date("d-m-Y", strtotime($ultimoDiaPM."+ ".$i." month"));
                                                        $fecha2 = date("t-m-Y", strtotime($fecha1));
                                                        echo $fecha1."---".$fecha2."<br>";
                                                        $xx ++;
                                                        echo "xx= ".$xx."<br>";
                                                        /* if($xx == $cambios->mes_asignacion){
                                                            echo $fecha1." - ".$fecha2;
                                                        } */
                                                    }
                                                    /* fecha1 = date($nov->dosimetriacontrato->fecha_inicio);
                                                    $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                                                    echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total)) */
                                                @endphp 
                                            @endif
                                        </td>
                                        @if($cambios->persona_id != null)
                                            <td style="text-align:center;">{{$cambios->persona->primer_nombre_persona}} {{$cambios->persona->segundo_nombre_persona}} {{$cambios->persona->primer_apellido_persona}} {{$cambios->persona->segundo_apellido_persona}}</td>
                                            <td style="text-align:center;">{{$cambios->ubicacion}}</td>
                                        @elseif($cambios->areadepartamentosede_id != null)
                                            <td style="text-align:center;">{{$cambios->areadepartamentosede->nombre_area}} </td>
                                            <td style="text-align:center;">AMBIENTAL</td>
                                        @elseif($cambios->trabajadordosimetro_ant_id != null)
                                            <td style="text-align:center;">{{$cambios->trabajadordosimetroAnterior->persona->primer_nombre_persona}} {{$cambios->trabajadordosimetroAnterior->persona->segundo_nombre_persona}} {{$cambios->trabajadordosimetroAnterior->persona->primer_apellido_persona}} {{$cambios->trabajadordosimetroAnterior->persona->segundo_apellido_persona}}</td>
                                            <td style="text-align:center;">{{$cambios->ubicacion}}</td>
                                        @elseif($cambios->dosiarea_ant_id != null)
                                            <td style="text-align:center;">{{$cambios->dosiareacontdosisedesAnterior->areadepartamentosede->nombre_area}}</td>
                                            <td style="text-align:center;">AMBIENTAL</td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                            
                @endif
                <br>
                @if($cam != 0)
                    <table style="margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; font-size:9px; width: 90%;" cellpadding="7">>
                        <thead>
                            <tr>
                                <th style="text-align:center;" colspan='5'>CAMBIO DE TRABAJADOR</th>
                            </tr>
                            <tr style="text-align:center;">
                                <th style="text-align:center; width: 11%;">FECHA</th>
                                <th style="text-align:center; width: 20%;">PERÍODO</th>
                                <th style="text-align:center;">TRABAJADOR / ÁREA (INGRESO)</th>
                                <th style="text-align:center;">TRABAJADOR / ÁREA (RETIRO)</th>
                                <th style="text-align:center;">UBICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cambiosNovedad as $cambio)
                                @if($cambio->tipo_novedad == 3)
                                    <tr>
                                        <td style="text-align:center;">
                                            @php
                                                $fecha = date("t-m-Y",strtotime($cambio->created_at));
                                                echo $fecha;
                                            @endphp
                                        </td>
                                        @if($cambio->trabajadordosimetro_id != null)
                                            <td style="text-align:center;">{{$cambio->trabajadordosimetro->primer_dia_uso}} - {{$cambio->trabajadordosimetro->ultimo_dia_uso}}</td>
                                            <td style="text-align:center;">{{$cambio->trabajadordosimetro->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetro->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetro->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetro->persona->segundo_apellido_persona}} </td>
                                            <td style="text-align:center;">{{$cambio->trabajadordosimetroAnterior->persona->primer_nombre_persona}} {{$cambio->trabajadordosimetroAnterior->persona->segundo_nombre_persona}} {{$cambio->trabajadordosimetroAnterior->persona->primer_apellido_persona}} {{$cambio->trabajadordosimetroAnterior->persona->segundo_apellido_persona}}</td>
                                            <td style="text-align:center;">{{$cambio->trabajadordosimetro->ubicacion}}</td>
                                        @elseif($cambio->dosiarea_id != null)
                                            <td style="text-align:center;">{{$cambio->dosiareacontdosisedes->primer_dia_uso}} - {{$cambio->dosiareacontdosisedes->ultimo_dia_uso}}</td>
                                            <td style="text-align:center;">{{$cambio->dosiareacontdosisedes->areadepartamentosede->nombre_area}}</td>
                                            <td style="text-align:center;">{{$cambio->dosiareacontdosisedesAnterior->areadepartamentosede->nombre_area}}</td>
                                            <td style="text-align:center;">AMBIENTAL</td>
                                        @elseif($cambio->dosicontrol_id != null)
                                            <td style="text-align:center;">{{$cambio->dosicontrolcontdosisedes->primer_dia_uso}} - {{$cambio->dosicontrolcontdosisedes->ultimo_dia_uso}}</td>
                                            <td style="text-align:center;">"CONTROL TRANSPORTE"</td>
                                            <td style="text-align:center;">{{$cambio->dosicontrolcontdosisedes->ubicacion}}</td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                            
                @endif
                <br>
                <br>
                <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número (NOV-OSL-QA) del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
            @endif
            
            <br>
            <div style="position:relative; display:block;">
                <p style="text-align:justify;">Cordialmente,</p>

                <div style=" width: 200px; height: 130px;">
                    <img src="{{asset('imagenes/FIRMAYUDI.png')}}" width="130" height="70" style="position:relative; left:30px; top:4px;">
                    <p style="position:relative; bottom:10px; text-align:center;">___________________________</p> <br>
                    <p style="position:relative; bottom: 30px; text-align: center; font-size: 11px; color:#1A9980;">JUDY J.GAVIRIA TORRES</p> <br>
                    <p style="position:relative; bottom: 51px; text-align: center; font-size: 11px;">Ingeniera</p> <br>
                    <p style="position:relative; bottom: 70px; text-align: center; font-size: 11px; ">Operador logístico</p>
                </div>
            </div>
        </div>
    </main>
</body>