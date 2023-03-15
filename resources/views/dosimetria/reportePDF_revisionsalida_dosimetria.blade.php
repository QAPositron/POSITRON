<style>
    body{
        /* background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 12px;
        margin: 0 30px 0 30px;
    }
    header{
        position: fixed;
        height: 80px;
        left: 30px; 
        right: 30px;
        background: orange;
    }
    main{
        margin-top: 80px;
        background: yellow;
    }
    footer{
        position: fixed;
        bottom: -10px; 
        left: 30px; 
        right: 30px;
        text-align:center;
        color:#1A9980;
        /* background: yellowgreen; */
    }
    td, th{
        border:0.1px solid black;
    }
    p {
        margin: 0px;
        padding-top: 2px;
        padding-bottom: 2px;
    }
    .indices{
        position: fixed;
        bottom: 65px; 
        left: 30px; 
        right: 30px;
        text-align:justify;
        /* background: yellow; */
    }
</style>
<body>
    <header>
        <img src="{{asset('imagenes/1VerdeSF.png')}}" width="180" style="position:relative; right:20px; top:15px; margin-bottom: 15px;">
        <img src="{{asset('imagenes/1SERVICIOS_QA2.png')}}" width="330" style="position:relative; left:130px; bottom: 15px;">
        {{-- <img src="{{asset('imagenes/SERVICIOS_QA.png')}}" width="330" style="position:relative; left:130px; bottom: 15px;"> --}}
    </header>
    <footer>
        <p>______________________________________________________________________________________________</p>
        <p >Servicios en dosimetría, protección radiológica y controles de calidad equipos de Rayos X</p>
        <p style="top:30px;">dosimetria.qapositron@gmail.com – 301 449 5401 – 310 607 9375 – 304 338 6581</p>
        <p>www.qapositron.com</p>
    </footer>
    <main>
        <p style="position:relative;">Bucaramanga, 
            @php
                $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'obtubre', "11"=>'noviembre', "12"=>'diciembre'];
                echo date("d")." ".$meses[date("m")]." ".date("Y") ;
            @endphp
        </p>
        <br>
        <p style="position:relative;">Señores</p>
        <p style="position:relative;"><b>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}</b></p>
        <p style="position:relative;">@if($contdosisededepto->contratodosimetriasede->sede->empresa->tipo_identificacion_empresa == 'NIT') NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @else {{$contdosisededepto->contratodosimetriasede->sede->empresa->tipo_identificacion_empresa}}: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}} @endif</p>
        <p style="position:relative;">Dirección: {{$contdosisededepto->contratodosimetriasede->sede->empresa->direccion_empresa}}</p>
        <p style="position:relative;">Municipio: @php echo ucwords(strtolower($contdosisededepto->contratodosimetriasede->sede->empresa->municipios->nombre_municol)); @endphp - @php echo ucwords(strtolower($contdosisededepto->contratodosimetriasede->sede->empresa->municipios->coldepartamento->nombre_deptocol)); @endphp </p>
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
        <table style="position:relative; margin: 0 auto; border-collapse:collapse; font-size:9px; width: 100%" cellpadding="7">
            <thead>
                <tr style="background-color:#1A9980; color:white;">
                    <th style="width: 25%;">Apellidos y nombres</th>
                    <th>Dosímetro</th>
                    <th>Holder</th>
                    <th>Ubicación</th>
                    <th>Especialidad</th>
                    <th>Mes</th>
                    <th>Sede</th>
                    <th style="width: 12%;">Periodo</th>
                    <th style="width: 20%;">Observaciones Revisión salida<sup>1</sup></th>
                </tr>
            </thead>
            <tbody>
                @if($dosicontrolasig->isEmpty())
                    @foreach($trabjasignados as $trabjasig)
                        <tr>
                            <td>{{ucwords(strtolower($trabjasig->persona->primer_nombre_persona))}} {{ucwords(strtolower($trabjasig->persona->segundo_nombre_persona))}} {{ucwords(strtolower($trabjasig->persona->primer_apellido_persona))}} {{ucwords(strtolower($trabjasig->persona->segundo_apellido_persona))}}</td>
                            <td style="text-align:center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                            <td style="text-align:center;">
                                @if($trabjasig->holder_id == NULL)
                                    N.A.
                                @else
                                    {{$trabjasig->holder->codigo_holder}}
                                @endif
                            </td>
                            <td style="text-align:center;">{{ucwords(strtolower($trabjasig->ubicacion))}}</td>
                            <td style="text-align:center;">{{ucwords(strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,4)))}}.</td>
                            <td style="text-align:center;">{{$mesnumber}}/12</td>
                            <td style="text-align:center;">{{ucwords(strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede))}}</td>
                            <td style="text-align:center;">{{$trabjasig->primer_dia_uso}} - {{$trabjasig->ultimo_dia_uso}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @else
                    @foreach($dosicontrolasig as $dosicont)
                        <tr style="background-color: #EEEDEC">
                            <td>Control {{ucwords(strtolower($dosicont->ubicacion))}} </td>
                            <td style="text-align:center;">{{$dosicont->dosimetro->codigo_dosimeter}}</td>
                            <td style="text-align:center;">
                                @if($dosicont->holder_id == NULL)
                                    N.A.
                                @else
                                    {{$dosicont->holder->codigo_holder}}
                                @endif
                            </td>
                            <td style="text-align:center;">{{$dosicont->ubicacion}}</td>
                            <td style="text-align:center;">{{ucwords(strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,4)))}}.</td>
                            <td style="text-align:center;">{{$mesnumber}}/12</td>
                            <td style="text-align:center;">{{ucwords(strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede))}}</td>
                            <td style="text-align:center;">{{$dosicont->primer_dia_uso}} - {{$dosicont->ultimo_dia_uso}}</td>
                            <td style="text-align:center;"></td>
                        </tr>
                    @endforeach
                    @foreach($trabjasignados as $trabjasig)
                        <tr>
                            <td>{{ucwords(strtolower($trabjasig->persona->primer_nombre_persona))}} {{ucwords(strtolower($trabjasig->persona->segundo_nombre_persona))}} {{ucwords(strtolower($trabjasig->persona->primer_apellido_persona))}} {{ucwords(strtolower($trabjasig->persona->segundo_apellido_persona))}}</td>
                            <td style="text-align:center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                            <td style="text-align:center;">
                                @if($trabjasig->holder_id == NULL)
                                    N.A.
                                @else
                                    {{$trabjasig->holder->codigo_holder}}
                                @endif
                            </td>
                            <td style="text-align:center;">{{ucwords(strtolower($trabjasig->ubicacion))}}</td>
                            <td style="text-align:center;">{{ucwords(strtolower(substr($contdosisededepto->departamentosede->departamento->nombre_departamento,0,4)))}}.</td>
                            <td style="text-align:center;">{{$mesnumber}}/12</td>
                            <td style="text-align:center;">{{ucwords(strtolower($contdosisededepto->contratodosimetriasede->sede->nombre_sede))}}</td>
                            <td style="text-align:center;">{{$trabjasig->primer_dia_uso}} - {{$trabjasig->ultimo_dia_uso}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <br>
        <p style="position:relative; text-align:justify;">Se revisaron @php echo count($dosicontrolasig); @endphp dosímetros de control, tres dosímetros de tórax, un dosímetro de anillo y un dosímetro de cristalino, para un total de 8 dosímetros.</p>
        <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número de revisión dosímetros (RSD) del presente documento al correo:<label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
        <br>
        <br>
        <p style="position:relative; text-align:justify; page-break-after: always;">Cordialmente,</p>
        <br>
        <br>
        <br>
        <br>
        <div style="position:relative; width: 45%; height: 80px;">
            <p style="position:relative; text-align:center;">___________________________________________</p> <br>
            <p style="position:relative; bottom: 15px; text-align: center; font-size: 11px; color:#1A9980;">JUDY J.GAVIRIA TORRES</p> <br>
            <p style="position:relative; bottom: 33px; text-align: center; font-size: 11px;">Ingeniera</p> <br>
            <p style="position:relative; bottom: 49px; text-align: center; font-size: 11px;">Operador logístico</p>
        </div>
        <br>
        <p >Quien revisa la llegada de los dosímetros a la instalación:</p>
        <br>
        <br>
        <br>
        <br>
        <div style="position:relative; width: 45%; height: 80px;">
            <p style="position: relative; text-align: center;">___________________________________________</p> <br>
            <p style="position: relative; bottom: 17px; text-align: center; font-size: 11px; color:#1A9980;">**Nombre del responsable**</p> <br>
            <p style="position: relative; bottom: 35px; text-align: center; font-size: 11px; ">Responsable de recibir la dosimetría</p> <br>
        </div>
        <div class="indices">
            <p style=""><b>_____________________________________</b></p>
            <p style="position: relative;"><small><sup>1</sup> Campo para que el encargado de la dosimetría del LDP revise la llagada de los dosímetros una vez es abierto el paquete. Usar las siguientes convenciones: 1) Buen Estado Físico, 2) inconsistencia información etiqueta-dosímetro, 3) Dosímetro faltante, 4) Dosímetro dañado, 5) Dosímetro húmedo, 5) dosímetro sin etiqueta, 6) holder dañado, 7) dosímetro de otro periodo, 8) Dosímetro otra sede, 9) Otra adicional.</small></p>
        </div>
    </main>
    







    <!-- ////////////////////SCRIPT PARA CONTAR LAS PAGINAS/////////////// -->
    <script type="text/php">
        if (isset($pdf)) {
            $text = "página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = $pdf->get_width()-120;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>