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
        margin-top: 100px;
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
    {{-- <div id="watermark">
        <img src="{{asset('imagenes/FONDO1min.png')}}" width="643" height="890">
    </div> --}}
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

            {{-- @for($i= 1; $i<= 19; $i++)
                
                    {{$i}} <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, quam quidem doloremque odio recusandae delectus itaque est exercitationem ut officia nemo nihil qui rerum quis sed nulla reiciendis facere repellendus?</p>
                
            @endfor --}}
            <p style="position:relative;">Bucaramanga, 
                @php
                    $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'obtubre', "11"=>'noviembre', "12"=>'diciembre'];
                    echo date("d")." ".$meses[date("m")]." ".date("Y") ;
                @endphp
            </p>
            <br>
            <p style="position:relative;">Señores</p>
            @if(empty($contdosisededepto))
                @foreach($empresainfo as $empresa)
                    <p style="position:relative;"><b>{{$empresa->nombre_empresa}}</b></p>
                    <p style="position:relative;">@if($empresa->empresa->tipo_identificacion_empresa == 'NIT') NIT: {{$empresa->empresa->num_iden_empresa}}-{{$empresa->empresa->DV}} @elseif($empresa->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA')CC: {{$empresa->empresa->num_iden_empresa}} @endif</p>
                    <p style="position:relative;">Dirección: {{$empresa->empresa->direccion_empresa}}</p>
                    <p style="position:relative;">Municipio: @php echo ucwords(mb_strtolower($empresa->empresa->municipios->nombre_municol, "UTF-8")); @endphp - @php echo ucwords(strtolower($empresa->empresa->municipios->coldepartamento->nombre_deptocol)); @endphp </p>
                @endforeach
            @else
                <p style="position:relative;"><b>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}</b></p>
                <p style="position:relative;">@if($contdosisededepto->contratodosimetriasede->sede->empresa->tipo_identificacion_empresa == 'NIT') NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @elseif($contdosisededepto->contratodosimetriasede->sede->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') CC: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}} @endif</p>
                <p style="position:relative;">Dirección: {{$contdosisededepto->contratodosimetriasede->sede->empresa->direccion_empresa}}</p>
                <p style="position:relative;">Municipio: @php echo ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->empresa->municipios->nombre_municol, 'UTF-8')); @endphp - @php echo ucwords(strtolower($contdosisededepto->contratodosimetriasede->sede->empresa->municipios->coldepartamento->nombre_deptocol)); @endphp </p>
            @endif
            <br>
            <p style="position:relative;"> <b>Ref.: notificación revisión salida dosímetros – RSD-OSL-QA- 
                @php 
                    date_default_timezone_set('America/Bogota');
                    echo date("Y").date("m").date("d").date("H").date("i").date("s"); 
                @endphp</b>
            </p>
            <br>
            <p style="position:relative;">Cordial saludo,</p>
            <br>
            <p style="position:relative; text-align:justify;">La empresa cuenta con un programa de aseguramiento de la calidad del laboratorio de dosimetría personal (LDP). Por lo tanto, deseamos informarles que hemos llevado a cabo la revisión de los dosímetros antes del envío a sus instalaciones, en este proceso garantizamos que la cantidad dosímetros sea la correcta y que el número del dosímetro con la información de la etiqueta se encuentren asociados para el periodo asignado.</p>
            <br>
            <p style="position:relative; text-align:justify;">A continuación se listan los dosímetros revisados:</p>
            <br>        
            <table style="position:relative; margin: 0 auto; border-collapse:collapse; font-size:9px; width: 100%" cellpadding="4">
                <thead>
                    <tr style="background-color:#1A9980; color:white;">
                        <th style="width: 25%;">Apellidos y nombres</th>
                        <th>Dosímetro</th>
                        <th>Holder</th>
                        <th>Ubicación</th>
                        <th>Especialidad</th>
                        <th>Mes</th>
                        <th style="width: 10%;">Sede</th>
                        <th style="width: 12%;">Periodo</th>
                        <th style="width: 20%;">Observaciones Revisión salida<sup>1</sup></th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($contdosisededepto))
                        @foreach($temptrabajdosimrev as $temtrabasig)
                            @if($temtrabasig->dosicontrolcontdosisedes_id != NULL)
                                <tr style="background-color: #EEEDEC">
                                    <td>Control @if($temtrabasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($temtrabasig->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{$temtrabasig->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($temtrabasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$temtrabasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($temtrabasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($temtrabasig->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($temtrabasig->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">{{$temtrabasig->mes_asignacion}}/12</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($temtrabasig->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$temtrabasig->primer_dia_uso}} - {{$temtrabasig->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;"></td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach($temptrabajdosimrev as $temtrabasig)
                            @if($temtrabasig->trabajcontdosimetro_id != NULL)
                                <tr>
                                    <td>{{ucwords(mb_strtolower($temtrabasig->persona->primer_nombre_persona, "UTF-8"))}} {{ucwords(mb_strtolower($temtrabasig->persona->segundo_nombre_persona, "UTF-8"))}} {{ucwords(mb_strtolower($temtrabasig->persona->primer_apellido_persona, "UTF-8"))}} {{ucwords(mb_strtolower($temtrabasig->persona->segundo_apellido_persona, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$temtrabasig->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($temtrabasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$temtrabasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($temtrabasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($temtrabasig->ubicacion))}}@endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($temtrabasig->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">{{$temtrabasig->mes_asignacion}}/12</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($temtrabasig->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$temtrabasig->primer_dia_uso}} - {{$temtrabasig->ultimo_dia_uso}}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        @if($dosicontrolasig->isEmpty())
                            @foreach($areasignados as $area)
                                <tr>
                                    <td>{{ucwords(mb_strtolower($area->areadepartamentosede->nombre_area, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$area->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">N.A.
                                        {{-- @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif --}}
                                    </td>
                                    <td style="text-align:center;">Ambiental</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">@if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS'){{$mesnumber}}/12 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS') {{$mesnumber}}/6 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS') {{$mesnumber}}/4 @endif </td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$area->primer_dia_uso}} - {{$area->ultimo_dia_uso}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            @foreach($trabjasignados as $trabjasig)
                                <tr>
                                    <td>{{ucwords(mb_strtolower($trabjasig->persona->primer_nombre_persona, "UTF-8"))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_nombre_persona, "UTF-8"))}} {{ucwords(mb_strtolower($trabjasig->persona->primer_apellido_persona, "UTF-8"))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_apellido_persona, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($trabjasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($trabjasig->ubicacion))}}@endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">@if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS'){{$mesnumber}}/12 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS') {{$mesnumber}}/6 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS') {{$mesnumber}}/4 @endif </td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->primer_dia_uso}} - {{$trabjasig->ultimo_dia_uso}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($dosicontrolasig as $dosicont)
                                <tr style="background-color: #EEEDEC">
                                    <td>Control @if($dosicont->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($dosicont->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{$dosicont->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($dosicont->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$dosicont->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($dosicont->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($dosicont->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">@if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS'){{$mesnumber}}/12 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS') {{$mesnumber}}/6 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS') {{$mesnumber}}/4 @endif </td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$dosicont->primer_dia_uso}} - {{$dosicont->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;"></td>
                                </tr>
                            @endforeach
                            @foreach($areasignados as $area)
                                <tr>
                                    <td>{{ucwords(mb_strtolower($area->areadepartamentosede->nombre_area, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$area->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">N.A.
                                        {{-- @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif --}}
                                    </td>
                                    <td style="text-align:center;">Ambiental</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">@if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS'){{$mesnumber}}/12 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS') {{$mesnumber}}/6 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS') {{$mesnumber}}/4 @endif </td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$area->primer_dia_uso}} - {{$area->ultimo_dia_uso}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            @foreach($trabjasignados as $trabjasig)
                                <tr>
                                    <td>{{ucwords(mb_strtolower($trabjasig->persona->primer_nombre_persona, "UTF-8"))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_nombre_persona, "UTF-8"))}} {{ucwords(mb_strtolower($trabjasig->persona->primer_apellido_persona, "UTF-8"))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_apellido_persona, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($trabjasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($trabjasig->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), "UTF-8"))}}.</td>
                                    <td style="text-align:center;">@if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS'){{$mesnumber}}/12 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS') {{$mesnumber}}/6 @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS') {{$mesnumber}}/4 @endif </td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, "UTF-8"))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->primer_dia_uso}} - {{$trabjasig->ultimo_dia_uso}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                </tbody>
            </table>
            <br>
            @if(empty($contdosisededepto))
                <p style="position:relative; text-align:justify;">Se revisaron
                    @php
                        $control_torax = 0;
                        $control_cristalino = 0;
                        $control_anillo = 0;
                        $torax = 0;
                        $cristalino = 0;
                        $anillo = 0;
                        $ambiental = 0;
                        foreach ($temptrabajdosimrev as $temtrabasig) {
                            if($temtrabasig->trabajcontdosimetro_id != NULL){
                                if($temtrabasig->ubicacion == 'TORAX'){
                                    $torax += 1;
                                }elseif($temtrabasig->ubicacion == 'CRISTALINO'){
                                    $cristalino += 1;
                                }elseif($temtrabasig->ubicacion == 'ANILLO'){
                                    $anillo += 1;
                                }
                            }
                            if($temtrabasig->dosicontrolcontdosisedes_id != NULL){
                                if($temtrabasig->ubicacion == 'TORAX'){
                                    $control_torax += 1;
                                }elseif($temtrabasig->ubicacion == 'CRISTALINO'){
                                    $control_cristalino += 1;
                                }elseif($temtrabasig->ubicacion == 'ANILLO'){
                                    $control_anillo += 1;
                                }
                            }
                        }
                        $sum_control = $control_torax + $control_cristalino + $control_anillo;
                        if($sum_control != 0){if($sum_control <= 9){echo "0".$sum_control." dosímetros de control, "; }else{ echo $sum_control." dosímetros de control, "; } }
                        if($torax != 0){if($torax <= 9){ echo "0".$torax." dosímetros de tórax, "; }else{ echo $torax." dosímetros de tórax, ";}}
                        if($anillo != 0){if($anillo <= 9){ echo "0".$anillo." dosímetro de anillo y ";}else{ echo $anillo." dosímetro de anillo y ";}}
                        if($cristalino != 0){if($cristalino <= 9){ echo "0".$cristalino." dosímetro de cristalino, para un total de ".$sum_control+$torax+$anillo+$cristalino." dosimetros."; } else{ echo $cristalino." dosímetro de cristalino, para un total de ".$sum_control+$torax+$anillo+$cristalino." dosimetros."; }}
                        $suma = $control+$torax+$anillo+$cristalino;
                        if($suma != 0){if($suma <= 9){echo ", para un total de 0".$suma." dosimetros.";}else{echo ", para un total de ".$suma." dosimetros.";}}
                    @endphp
                </p>
            @else
                <p style="position:relative; text-align:justify;">Se revisaron
                    @php
                        $control_torax = 0;
                        $control_cristalino = 0;
                        $control_anillo = 0;
                        $torax = 0;
                        $cristalino = 0;
                        $anillo = 0;
                        $ambiental= 0;
                        foreach($dosicontrolasig as $dosicont){
                            if($dosicont->ubicacion == 'TORAX' && $dosicont->revision_salida == 'TRUE'){
                                $control_torax += 1;
                            }elseif($dosicont->ubicacion == 'CRISTALINO' && $dosicont->revision_salida == 'TRUE'){
                                $control_cristalino += 1;
                            }elseif($dosicont->ubicacion == 'ANILLO' && $dosicont->revision_salida == 'TRUE'){
                                $control_anillo += 1;
                            }
                        }
                        foreach ($areasignados as $area) {
                            if($area->revision_salida == 'TRUE'){
                                $ambiental += 1;
                            }
                        }
                        foreach($trabjasignados as $trabjasig){
                            if($trabjasig->ubicacion == 'TORAX' && $trabjasig->revision_salida == 'TRUE'){
                                $torax += 1;
                            }elseif($trabjasig->ubicacion == 'CRISTALINO' && $trabjasig->revision_salida == 'TRUE'){
                                $cristalino += 1;
                            }elseif($trabjasig->ubicacion == 'ANILLO' && $trabjasig->revision_salida == 'TRUE'){
                                $anillo += 1;
                            }
                        }
                        $control = $control_torax + $control_cristalino + $control_anillo;
                        if($control != 0){if($control <= 9){ echo "0".$control." dosímetros de control"; }else{ echo $control." dosímetros de control"; }}
                        if($torax != 0){if($torax <= 9){ echo ", 0".$torax." dosímetros de tórax"; }else{ echo", ".$torax." dosímetros de tórax";}}
                        if($anillo != 0){if($anillo <= 9){ echo ", 0".$anillo." dosímetro de anillo";}else{ echo ", ".$anillo." dosímetro de anillo";}}
                        if($cristalino != 0){if($cristalino <= 9){ echo ", 0".$cristalino." dosímetro de cristalino"; } else{ echo ", ".$cristalino." dosímetro de cristalino";}}
                        if($ambiental != 0){if($ambiental <= 9){ echo ", 0".$ambiental." dosímetro ambiental"; } else{ echo ", ".$ambiental." dosímetro ambiental";}}
                        $suma = $control+$torax+$anillo+$cristalino+$ambiental;
                        if($suma != 0){if($suma <= 9){echo ", para un total de 0".$suma." dosimetros.";}else{echo ", para un total de ".$suma." dosimetros.";}}
                    @endphp
                </p>
            @endif
            <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número de revisión dosímetros (RSD) del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
            <br>
            <div style="position:relative; display:block;  page-break-inside: avoid; ">
                <p style="position:relative; text-align:justify;">Cordialmente,</p>

                <div style="position:relative; width: 200px; height: 147px; top:10px; page-break-inside: avoid;">
                    <img src="{{asset('imagenes/FIRMAYUDI.png')}}" width="130" height="70" style="position:relative; left:30px; top:13px;">
                    <p style="position:relative; text-align:center;">___________________________</p> <br>
                    <p style="position:relative; bottom: 15px; text-align: center; font-size: 11px; color:#1A9980;">JUDY J.GAVIRIA TORRES</p> <br>
                    <p style="position:relative; bottom: 33px; text-align: center; font-size: 11px;">Ingeniera</p> <br>
                    <p style="position:relative; bottom: 49px; text-align: center; font-size: 11px; ">Operador logístico</p>
                </div>
            </div>
            <div style="position:relative; display:block;  page-break-inside: avoid;">
                <p style="position:relative; display:block; top:15px;">Quien revisa la llegada de los dosímetros a la instalación:</p>
                <div style="position:relative; width: 200px; height: 95px; top:45px; page-break-inside: avoid; ">
                    <p style="position: relative; text-align: center;">_____________________________</p> <br>
                    <p style="position: relative; bottom: 17px; text-align: center; font-size: 11px; color:#1A9980;">@php if(count($trabjEncargado) == 0){echo "**Nombre del responsable**"; }else{ echo $trabjEncargado[0]->primer_nombre_persona." ".$trabjEncargado[0]->segundo_nombre_persona." ".$trabjEncargado[0]->primer_apellido_persona." ".$trabjEncargado[0]->segundo_apellido_persona ;}@endphp </p> <br>
                    <p style="position: relative; bottom: 35px; text-align: center; font-size: 11px; ">Responsable de recibir la dosimetría</p> <br>
                </div>
            </div>
            
        </div>
        <div class="indices">
            <p style=""><b>_____________________________________</b></p>
            <p style="position: relative;"><small><sup>1</sup> Campo para que el encargado de la dosimetría del LDP revise la llagada de los dosímetros una vez es abierto el paquete. Usar las siguientes convenciones: 1) Buen Estado Físico, 2) inconsistencia información etiqueta-dosímetro, 3) Dosímetro faltante, 4) Dosímetro dañado, 5) Dosímetro húmedo, 6) dosímetro sin etiqueta, 7) holder dañado, 8) dosímetro de otro periodo, 9) Dosímetro otra sede, 10) Otra adicional.</small></p>
        </div>
        
    </main>
    







    <!-- ////////////////////SCRIPT PARA CONTAR LAS PAGINAS/////////////// -->
    <script type="text/php">
        if (isset($pdf)) {
            $text = "página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = $pdf->get_width()-110;
            $y = $pdf->get_height() - 20;
            $pdf->page_text($x, $y, $text, $font, $size);

        }
    </script>
</body>