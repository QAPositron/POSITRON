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
        margin-bottom: 2.8cm;
        display:block;
        /* background: yellow; */
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
        /* background: gray; */
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

           {{--  @for($i= 1; $i<= 16; $i++)
                
                    {{$i}} <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, quam quidem doloremque odio recusandae delectus itaque est exercitationem ut officia nemo nihil qui rerum quis sed nulla reiciendis facere repellendus?</p>
                
            @endfor --}}
            <p style="position:relative;">Bucaramanga, 
                @php
                    $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'octubre', "11"=>'noviembre', "12"=>'diciembre'];
                    echo date("d")." ".$meses[date("m")]." ".date("Y") ;
                @endphp
            </p>
            <br>
            <p style="position:relative;">Señores</p>
            @if(empty($contdosisededepto))
                @foreach($empresainfo as $empresa)
                    <p style="position:relative;"><b>{{$empresa->razon_social_empresa}}</b></p>
                    <p style="position:relative;">@if($empresa->empresa->tipo_identificacion_empresa == 'NIT') NIT: {{$empresa->empresa->num_iden_empresa}}-{{$empresa->empresa->DV}} @elseif($empresa->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') CC: {{$empresa->empresa->num_iden_empresa}} @endif</p>
                    <p style="position:relative;">Dirección: {{$empresa->empresa->direccion_empresa}}</p>
                    <p style="position:relative;">Municipio: @php echo ucwords(mb_strtolower($empresa->empresa->municipios->nombre_municol, 'UTF-8')); @endphp - @php echo ucwords(mb_strtolower($empresa->empresa->municipios->coldepartamento->nombre_deptocol, 'UTF-8')); @endphp </p>
                @endforeach
            @else
                <p style="position:relative;"><b>{{$contdosisededepto->contratodosimetriasede->sede->empresa->razon_social_empresa}}</b></p>
                <p style="position:relative;">@if($contdosisededepto->contratodosimetriasede->sede->empresa->tipo_identificacion_empresa == 'NIT') NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @elseif($contdosisededepto->contratodosimetriasede->sede->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') CC: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}} @endif</p>
                <p style="position:relative;">Dirección: {{$contdosisededepto->contratodosimetriasede->sede->empresa->direccion_empresa}}</p>
                <p style="position:relative;">Municipio: @php echo ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->empresa->municipios->nombre_municol , 'UTF-8')); @endphp - @php echo ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->empresa->municipios->coldepartamento->nombre_deptocol, 'UTF-8')); @endphp </p>
            @endif
            <br>
            <p style="position:relative;"> <b>Ref.: notificación revisión entrada dosímetros – RSD-OSL-QA- 
                @php 
                    date_default_timezone_set('America/Bogota');
                    echo date("Y").date("m").date("d").date("H").date("i").date("s"); 
                @endphp</b>
            </p>
            <br>
            <p style="position:relative;">Cordial saludo,</p>
            <br>
            <p style="position:relative; text-align:justify;">La empresa cuenta con un programa de aseguramiento de la calidad del laboratorio de dosimetría personal (LDP). Por lo tanto, deseamos informarles que hemos llevado a cabo la revisión de los dosímetros enviados por ustedes a nuestro laboratorio. En este proceso, se garantiza que se cumplirán los siguientes criterios: <b>i)</b> la cantidad de dosímetros es la correcta; <b>ii)</b> la integridad de los holders y dosímetros está asegurada; <b>iii)</b> no haya contaminación de materiales radiactivos; <b>iv)</b> se ha verificado que el código del dosímetro y la información de la etiqueta están asociados para el período asignado.</p>
            <br>
            <p style="position:relative; text-align:justify;">A continuación se listan los dosímetros revisados y sus observaciones:</p>
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
                        <th style="width: 15%;">Observaciones Revisión llegada al LDP<sup>1</sup></th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($contdosisededepto))
                        @foreach($temptrabajdosimentradarev as $temtrabasigent)
                            @if($temtrabasigent->dosicontrolcontdosisedes_id != NULL)
                                <tr style="background-color: #EEEDEC">
                                    <td>Control @if($temtrabasigent->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($temtrabasigent->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{$temtrabasigent->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($temtrabasigent->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$temtrabasigent->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($temtrabasigent->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($temtrabasigent->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{ucwords(strtolower(substr($temtrabasigent->nombre_departamento,0,6)))}}.</td>
                                    <td style="text-align:center;">{{$temtrabasigent->mes_asignacion}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                    <td style="text-align:center;">{{ucwords(strtolower($temtrabasigent->nombre_sede))}}</td>
                                    <td style="text-align:center;">{{$temtrabasigent->primer_dia_uso}} - {{$temtrabasigent->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;"></td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach($temptrabajdosimentradarev as $temtrabasigent)
                            @if($temtrabasigent->trabajcontdosimetro_id != NULL)
                                <tr>
                                    <td>{{ucwords(strtolower($temtrabasigent->persona->primer_nombre_persona))}} {{ucwords(strtolower($temtrabasigent->persona->segundo_nombre_persona))}} {{ucwords(strtolower($temtrabasigent->persona->primer_apellido_persona))}} {{ucwords(strtolower($temtrabasigent->persona->segundo_apellido_persona))}}</td>
                                    <td style="text-align:center;">{{$temtrabasigent->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($temtrabasigent->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$temtrabasigent->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($temtrabasigent->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($temtrabasigent->ubicacion))}}@endif</td>
                                    <td style="text-align:center;">{{ucwords(strtolower(substr($temtrabasigent->nombre_departamento,0,6)))}}.</td>
                                    <td style="text-align:center;">{{$temtrabasigent->mes_asignacion}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                    <td style="text-align:center;">{{ucwords(strtolower($temtrabasigent->nombre_sede))}}</td>
                                    <td style="text-align:center;">{{$temtrabasigent->primer_dia_uso}} - {{$temtrabasigent->ultimo_dia_uso}}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        @if($dosicontrolasig->isEmpty() && $dosicontrolUnicoasig->isEmpty())
                            @foreach($areasignados as $area)
                                <tr @foreach($observacionesAsig as $obs)
                                        @if($area->id_dosiareacontdosisedes == $obs->dosiareacontdosimetro_id && ($obs->observacion_id == 2 || $obs->observacion_id == 3 || $obs->observacion_id == 4 || $obs->observacion_id == 5 || $obs->observacion_id == 6 || $obs->observacion_id == 7 || $obs->observacion_id == 8 || $obs->observacion_id == 9))
                                            style="color: red;"
                                        @endif
                                    @endforeach>
                                    <td>{{ucwords(mb_strtolower($area->areadepartamentosede->nombre_area, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$area->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">N.A.
                                        {{-- @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif --}}
                                    </td>
                                    <td style="text-align:center;">Ambiental</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), 'UTF-8'))}}.</td>
                                    <td style="text-align:center;">{{$mesnumber}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$area->primer_dia_uso}} - {{$area->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;">
                                        @foreach($observacionesAsig as $obs)
                                            @if($area->id_dosiareacontdosisedes == $obs->dosiareacontdosimetro_id)
                                                {{$obs->observacion_id}})
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($trabjasignados as $trabjasig)
                                <tr @foreach($observacionesAsig as $obs)
                                        @if($trabjasig->id_trabajadordosimetro == $obs->trabajcontdosimetro_id && ($obs->observacion_id == 2 || $obs->observacion_id == 3 || $obs->observacion_id == 4 || $obs->observacion_id == 5 || $obs->observacion_id == 6 || $obs->observacion_id == 7 || $obs->observacion_id == 8 || $obs->observacion_id == 9))
                                            style="color: red;"
                                        @endif
                                    @endforeach>
                                    <td>{{ucwords(mb_strtolower($trabjasig->persona->primer_nombre_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_nombre_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($trabjasig->persona->primer_apellido_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_apellido_persona, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($trabjasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($trabjasig->ubicacion))}}@endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), 'UTF-8'))}}.</td>
                                    <td style="text-align:center;">{{$mesnumber}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->primer_dia_uso}} - {{$trabjasig->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;">
                                        @foreach($observacionesAsig as $obs)
                                            @if($trabjasig->id_trabajadordosimetro == $obs->trabajcontdosimetro_id)
                                                {{$obs->observacion_id}})
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @if($dosicontrolUnicoasig->isEmpty())
                                @foreach($dosicontrolasig as $dosicont)
                                    <tr @foreach($observacionesAsig as $obs)
                                            @if($dosicont->id_dosicontrolcontdosisedes == $obs->dosicontrol_id && ($obs->observacion_id == 2 || $obs->observacion_id == 3 || $obs->observacion_id == 4 || $obs->observacion_id == 5 || $obs->observacion_id == 6 || $obs->observacion_id == 7 || $obs->observacion_id == 8 || $obs->observacion_id == 9))
                                                style="color: red; background-color: #EEEDEC;"
                                            @else
                                                style="background-color: #EEEDEC;"
                                            @endif
                                        @endforeach>
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
                                        <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), 'UTF-8'))}}.</td>
                                        <td style="text-align:center;">{{$mesnumber}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                        <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 'UTF-8'))}}</td>
                                        <td style="text-align:center;">{{$dosicont->primer_dia_uso}} - {{$dosicont->ultimo_dia_uso}}</td>
                                        <td style="text-align:center;">
                                            @foreach($observacionesAsig as $obs)
                                                @if($dosicont->id_dosicontrolcontdosisedes == $obs->dosicontrol_id)
                                                    {{$obs->observacion_id}})
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($dosicontrolUnicoasig as $dosicontUniasig)
                                    <tr @foreach($observacionesAsig as $obs)
                                        @if($dosicontUniasig->id_dosicontrolcontdosisedes == $obs->dosicontrol_id && ($obs->observacion_id == 2 || $obs->observacion_id == 3 || $obs->observacion_id == 4 || $obs->observacion_id == 5 || $obs->observacion_id == 6 || $obs->observacion_id == 7 || $obs->observacion_id == 8 || $obs->observacion_id == 9))
                                            style="color: red; background-color: #EEEDEC;"
                                        @else
                                            style="background-color: #EEEDEC;"
                                        @endif
                                    @endforeach>
                                        <td>Control @if($dosicontUniasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($dosicontUniasig->ubicacion))}} @endif</td>
                                        <td style="text-align:center;">{{$dosicontUniasig->dosimetro->codigo_dosimeter}}</td>
                                        <td style="text-align:center;">
                                            @if($dosicontUniasig->holder_id == NULL)
                                                N.A.
                                            @else
                                                {{$dosicontUniasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td style="text-align:center;">@if($dosicontUniasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($dosicontUniasig->ubicacion))}} @endif</td>
                                        <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), 'UTF-8'))}}.</td>
                                        <td style="text-align:center;">{{$mesnumber}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                        <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 'UTF-8'))}}</td>
                                        <td style="text-align:center;">{{$dosicontUniasig->primer_dia_uso}} - {{$dosicontUniasig->ultimo_dia_uso}}</td>
                                        <td style="text-align:center;">
                                            @foreach($observacionesAsigContUni as $obsAsigContUni)
                                                @if($dosicontUniasig->id_dosicontrolcontdosisedes == $obsAsigContUni->dosicontrol_id)
                                                    {{$obsAsigContUni->observacion_id}})
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @foreach($areasignados as $area)
                                <tr @foreach($observacionesAsig as $obs)
                                        @if($area->id_dosiareacontdosisedes == $obs->dosiareacontdosimetro_id && ($obs->observacion_id == 2 || $obs->observacion_id == 3 || $obs->observacion_id == 4 || $obs->observacion_id == 5 || $obs->observacion_id == 6 || $obs->observacion_id == 7 || $obs->observacion_id == 8 || $obs->observacion_id == 9))
                                            style="color: red;"
                                        @endif
                                    @endforeach>
                                    <td>{{ucwords(mb_strtolower($area->areadepartamentosede->nombre_area, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$area->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">N.A.
                                        {{-- @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif --}}
                                    </td>
                                    <td style="text-align:center;">Ambiental</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), 'UTF-8'))}}.</td>
                                    <td style="text-align:center;">{{$mesnumber}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$area->primer_dia_uso}} - {{$area->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;">
                                        @foreach($observacionesAsig as $obs)
                                            @if($area->id_dosiareacontdosisedes == $obs->dosiareacontdosimetro_id)
                                                {{$obs->observacion_id}})
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($trabjasignados as $trabjasig)   
                                <tr @foreach($observacionesAsig as $obs)
                                        @if($trabjasig->id_trabajadordosimetro == $obs->trabajcontdosimetro_id && ($obs->observacion_id == 2 || $obs->observacion_id == 3 || $obs->observacion_id == 4 || $obs->observacion_id == 5 || $obs->observacion_id == 6 || $obs->observacion_id == 7 || $obs->observacion_id == 8 || $obs->observacion_id == 9))
                                            style="color: red;"
                                        @endif
                                    @endforeach>
                                    <td>{{ucwords(mb_strtolower($trabjasig->persona->primer_nombre_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_nombre_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($trabjasig->persona->primer_apellido_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($trabjasig->persona->segundo_apellido_persona, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                                    <td style="text-align:center;">
                                        @if($trabjasig->holder_id == NULL)
                                            N.A.
                                        @else
                                            {{$trabjasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td style="text-align:center;">@if($trabjasig->ubicacion == 'TORAX') Tórax @else {{ucwords(strtolower($trabjasig->ubicacion))}} @endif</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,6), 'UTF-8'))}}.</td>
                                    <td style="text-align:center;">{{$mesnumber}}/{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}</td>
                                    <td style="text-align:center;">{{ucwords(mb_strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 'UTF-8'))}}</td>
                                    <td style="text-align:center;">{{$trabjasig->primer_dia_uso}} - {{$trabjasig->ultimo_dia_uso}}</td>
                                    <td style="text-align:center;">
                                        @foreach($observacionesAsig as $obs)
                                            @if($trabjasig->id_trabajadordosimetro == $obs->trabajcontdosimetro_id)
                                                {{$obs->observacion_id}})
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                </tbody>
            </table>
            <br>
            <p style="position:relative; text-align:justify;"><b>Convenciones de las observaciones: </b>1) Buen Estado Físico, 2) Dosímetro contaminado<sup>2</sup>, 3) Dosímetro faltante, 4) Dosímetro dañado, 5) Dosímetro húmedo, 6) Dosímetro de otro periodo, 7) Dosímetro de otra sede, 8) Holder dañado, 9) Otra adicional.</p>
            <br>
            <p style="position:relative; text-align:justify;"><b>Observaciones Adicionales:</b></p>
            @foreach($observacionesAsig as $obsAsig)
                @if($obsAsig->observacion_id == 9)
                    <p>- Correspondiente al dosímetro 
                    @if($obsAsig->dosicontrol_id != NULL)
                        control {{strtolower($obsAsig->dosicontrolcontdosisedes->ubicacion)}}:
                    @elseif($obsAsig->trabajcontdosimetro_id != NULL)
                        {{strtolower($obsAsig->trabajadordosimetro->ubicacion)}} del trabajador {{ucwords(mb_strtolower($obsAsig->trabajadordosimetro->persona->primer_nombre_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($obsAsig->trabajadordosimetro->persona->primer_apellido_persona, 'UTF-8'))}} {{ucwords(mb_strtolower($obsAsig->trabajadordosimetro->persona->segundo_apellido_persona, 'UTF-8'))}}:
                    @endif 
                    {{strtolower($obsAsig->nota_obs9)}}.</p>
                @endif
            @endforeach
            
            <br>
            @if(empty($contdosisededepto))
                <p style="position:relative; text-align:justify;">Se revisaron:
                    @php
                        $control_torax = 0;
                        $control_cristalino = 0;
                        $control_anillo = 0;
                        $torax = 0;
                        $cristalino = 0;
                        $anillo = 0;
                        $ambiental = 0;
                        $caso = 0;
                        foreach ($temptrabajdosimentradarev as $temtrabasigent) {
                            if($temtrabasigent->trabajcontdosimetro_id != NULL){
                                if($temtrabasigent->ubicacion == 'TORAX'){
                                    $torax += 1;
                                }elseif($temtrabasigent->ubicacion == 'CRISTALINO'){
                                    $cristalino += 1;
                                }elseif($temtrabasigent->ubicacion == 'ANILLO'){
                                    $anillo += 1;
                                }
                            }
                            if($temtrabasigent->dosicontrolcontdosisedes_id != NULL){
                                if($temtrabasigent->ubicacion == 'TORAX'){
                                    $control_torax += 1;
                                }elseif($temtrabasigent->ubicacion == 'CRISTALINO'){
                                    $control_cristalino += 1;
                                }elseif($temtrabasigent->ubicacion == 'ANILLO'){
                                    $control_anillo += 1;
                                }
                            }
                        }
                        $sum_control = $control_torax + $control_cristalino + $control_anillo;
                        if($sum_control != 0){if($sum_control <= 9){echo "0".$sum_control." dosímetros de control, "; }else{ echo $sum_control." dosímetros de control, "; } }
                        if($torax != 0){if($torax <= 9){ echo "0".$torax." dosímetros de tórax, "; }else{ echo $torax." dosímetros de tórax, ";}}
                        if($anillo != 0){if($anillo <= 9){ echo "0".$anillo." dosímetro de anillo y ";}else{ echo $anillo." dosímetro de anillo y ";}}
                        if($cristalino != 0){if($cristalino <= 9){ echo "0".$cristalino." dosímetro de cristalino, para un total de ".$sum_control+$torax+$anillo+$cristalino." dosimetros."; } else{ echo $cristalino." dosímetro de cristalino, para un total de ".$sum_control+$torax+$anillo+$cristalino." dosimetros."; }}
    
                    @endphp
                </p>
            @else
                <p style="position:relative; text-align:justify;">Se revisaron
                    @php
                        $control_torax = 0;
                        $control_cristalino = 0;
                        $control_anillo = 0;
                        $controlTrans_torax = 0;
                        $controlTrans_cristalino = 0;
                        $controlTrans_anillo = 0;
                        $torax = 0;
                        $cristalino = 0;
                        $anillo = 0;
                        $ambiental= 0;
                        $caso = 0;
                        foreach($dosicontrolasig as $dosicont){
                            if($dosicont->ubicacion == 'TORAX' && $dosicont->revision_entrada == 'TRUE'){
                                $control_torax += 1;
                            }elseif($dosicont->ubicacion == 'CRISTALINO' && $dosicont->revision_entrada == 'TRUE'){
                                $control_cristalino += 1;
                            }elseif($dosicont->ubicacion == 'ANILLO' && $dosicont->revision_entrada == 'TRUE'){
                                $control_anillo += 1;
                            }
                        }
                        foreach($dosicontrolUnicoasig as $dosicontunic){
                            if($dosicontunic->ubicacion == 'TORAX' && $dosicontunic->revision_salida == 'TRUE'){
                                $controlTrans_torax += 1;
                            }elseif($dosicontunic->ubicacion == 'CRISTALINO' && $dosicontunic->revision_salida == 'TRUE'){
                                $controlTrans_cristalino += 1;
                            }elseif($dosicontunic->ubicacion == 'ANILLO' && $dosicontunic->revision_salida == 'TRUE'){
                                $controlTrans_anillo += 1;
                            }
                        }
                        foreach ($areasignados as $area) {
                            if($area->revision_entrada == 'TRUE'){
                                $ambiental += 1;
                            }
                        }
                        foreach($trabjasignados as $trabjasig){
                            if($trabjasig->ubicacion == 'TORAX' && $trabjasig->revision_entrada == 'TRUE'){
                                $torax += 1;
                            }elseif($trabjasig->ubicacion == 'CRISTALINO' && $trabjasig->revision_entrada == 'TRUE'){
                                $cristalino += 1;
                            }elseif($trabjasig->ubicacion == 'ANILLO' && $trabjasig->revision_entrada == 'TRUE'){
                                $anillo += 1;
                            }elseif($trabjasig->ubicacion == 'CASO' && $trabjasig->revision_entrada == 'TRUE'){
                                $caso += 1;
                            }
                        }
                        $control = $control_torax + $control_cristalino + $control_anillo;
                        $controlUnicTrans = $controlTrans_torax + $controlTrans_cristalino + $controlTrans_anillo;
                        if($control != 0){if($control <= 9){ echo "0".$control." dosímetros de control"; }else{ echo $control." dosímetros de control"; }}
                        if($controlUnicTrans != 0){if($controlUnicTrans <= 9){echo "0".$controlUnicTrans." dosímetros de control"; }else{ echo $controlUnicTrans." dosímetros de control";}}
                        if($torax != 0){if($torax <= 9){ echo ", 0".$torax." dosímetros de tórax"; }else{ echo ", ".$torax." dosímetros de tórax";}}
                        if($caso != 0){if($caso <= 9){echo ", 0".$caso." dosímetros de caso"; }else{echo ", ".$caso." dosímetros de caso";}}
                        if($anillo != 0){if($anillo <= 9){ echo ", 0".$anillo." dosímetro de anillo";}else{ echo $anillo." dosímetro de anillo";}}
                        if($cristalino != 0){if($cristalino <= 9){ echo ", 0".$cristalino." dosímetro de cristalino"; } else{ echo $cristalino." dosímetro de cristalino"; }}
                        if($ambiental != 0){if($ambiental <= 9){ echo ", 0".$ambiental." dosímetro ambiental,"; } else{ echo " ".$ambiental." dosímetro ambiental,";}}
                        $suma = $control+$controlUnicTrans+$torax+$caso+$anillo+$cristalino+$ambiental;
                        if($suma != 0){if($suma <= 9){echo " para un total de 0".$suma." dosimetros.";}else{echo " para un total de ".$suma." dosimetros.";}}
                    @endphp
                </p>
            @endif
            <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número de revisión dosímetros (RSD) del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
            <br>
            <div style="position:relative; display:block; page-break-inside: avoid;">
                <p style="position:relative; text-align:justify;">Cordialmente,</p>

                <div style="position:relative; width: 200px; height: 136px; page-break-inside: avoid;">
                    <img src="{{asset('imagenes/FIRMAYUDI.png')}}" width="130" height="70" style="position:relative; left:30px; top:13px;">
                    <p style="position:relative; text-align:center;">_____________________________</p> <br>
                    <p style="position:relative; bottom: 20px; text-align: center; font-size: 11px; color:#1A9980;">JUDY J.GAVIRIA TORRES</p> <br>
                    <p style="position:relative; bottom: 37px; text-align: center; font-size: 11px;">Ingeniera</p> <br>
                    <p style="position:relative; bottom: 55px; text-align: center; font-size: 11px; ">Operador logístico</p>
                </div>
            </div>
            
            <div class="indices">
                <p><b>_____________________________________</b></p>
                <p style="position: relative;"><small><sup>1</sup> Campo para que el encargado de la dosimetría del LDP revise la llagada de los dosímetros una vez es abierto el paquete.</small></p>
                <p style="position: relative;"><small><sup>2</sup> En caso de encontrarse contaminados deben iniciar investigación.</small></p>
            </div>
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