<style type="text/css">
    
    html{
        margin: 30pt 30pt 30pt 30pt;
        font-family: sans-serif;
        font-size: 10px;
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
    table{
        border-collapse: collapse; 
        /* cellspacing: 10px;
        cellpadding: 10px; */
        border: 0.3px;
        position:absolute; 
        top:150px; 
        /*left:220px;*/
    }
    img{
        position:absolute; 
        top:10px; 
        
    }
    
    .parrafo-border{
        position:absolute; 
        top:500px;
        border: 1px;
    }
</style>
<body>
<!-- ////////////////////ENCABEZADO/////////////// -->


<img src="{{asset('imagenes/VerdeSF.png')}}" width="200">
<!-- <img src="public_path('../public/imagenes/LOGOVERDE.png');" width="200"> -->

<h3 style="position:absolute; top:87px; left:30px;">REPORTE DE DOSIMETRÍA</h3>

<table style="position:absolute; top:0px; left:240px;" cellspacing="0" cellpadding="0">
    <tr>
        <th style="font-size: 15px;" align="left">QA POSITRON S.A.S.</th>
    </tr>
    <tr>
        <td>NIT: 901390101-3, Licencia Ministerio de Minas y Energía No. CCD-00X 11-Feb-00</td>
    </tr>
    <tr>
        <td>Calle 36 #27-71 MILLENIUM BUSSINES TOWER, Oficina 919, Bucaramanga - Santander, Colombia</td>
    </tr>
    <tr>
        <td>Cel: 301 4495401</td>
    </tr>
    <tr>
        <td>Email:dosimetria.qapositron@gmail.com</td>
    </tr>
    <tr>
        <td style="padding-bottom:9px;">Sitio web: www.qapositron.com</td>
    </tr>
    <tr>
        <th style="font-size: 11px; border: solid 0.4px #000; padding:8px;">
            @foreach($contratoDosi as $cont)
                {{$cont->nombre_empresa}} - SEDE: {{$cont->nombre_sede}}
            @endforeach 
        </th>
    </tr>
</table>

<table style="position:absolute; top:0px; left:710px; border-collapse:collapse; font-size: 8px;" cellpadding="4">
    <tr>
        <td style="border:0.1px solid black;">No. de Cuenta</td>
        <td style="width: 120px; border:0.1px solid black;" align="center">
        @foreach($contratoDosi as $cont)
            {{$cont->codigo_contrato}}
        @endforeach
        </td>
        <td style="border:0.1px solid black;">Fecha recibo dosím.</td>
        <td style="width: 94px; border:0.1px solid black;" align="center">
            @php
                $chek = 'inicial';
            @endphp      
            @foreach($trabajdosiasig as $trabj)
                @php
                    if($trabj->fecha_dosim_recibido != $chek){
                        $datefix = date('d-m-Y',strtotime($trabj->fecha_dosim_recibido));
                        echo "{$datefix}";
                        $chek = strval($trabj->fecha_dosim_recibido);
                    }else{ 
                        echo " ";
                    }
                @endphp
            @endforeach
        </td>
    </tr>
    <tr>
        <td style="border:0.1px solid black;">Código Depto.</td>
        <td style="width: 94px; border:0.1px solid black;" align="center">
            @php
                $chek = 'inicial';
            @endphp      
            @foreach($dosicontrolasig as $dosicontrol)
                @php
                    if($dosicontrol->nombre_departamento != $chek){
                        echo "{$dosicontrol->nombre_departamento}";
                        $chek = strval($dosicontrol->nombre_departamento);
                    }else{ 
                        echo " ";
                    }
                @endphp
            @endforeach
        </td>
        <td style="border:0.1px solid black;">Fecha del reporte</td>
        <td style="width: 94px; border:0.1px solid black;" align="center">
        @php
            $fecha = date("d-m-Y");
            echo "$fecha";
        @endphp
        </td>
    </tr>
    <tr>
        <td style="border:0.1px solid black;"> NIT Entidad Usuaria</td>
        <td style="width: 120px; border:0.1px solid black;" align="center">
            @foreach($contratoDosi as $cont)
                {{$cont->num_iden_empresa}}
            @endforeach 
        </td>
        <td colspan="2" rowspan="1" style="width: 50px; border:0.1px solid black;" align="center">Vo.Bo. / QA POSITRON S.A.S</td>
    </tr>
    <tr>
        <td style="border:0.1px solid black;">Municipio / Depto</td>
        <td style="width: 120px; border:0.1px solid black;" align="center">
        @foreach($contratoDosi as $cont)
            {{$cont->nombre_municol}} - {{$cont->abreviatura_deptocol}}
        @endforeach 
        </td>
        <td colspan="2" rowspan="3" style="width: 94px; border:0.1px solid black;">
            <img src="{{asset('imagenes/FIRMADEDIEGOFINAL.png')}}" width="195" height="60" style="top:55px;">
        </td>
    </tr>
    <tr>
        <td style="border:0.1px solid black;">Persona Contacto</td>
        <td style="width: 120px; border:0.1px solid black;" align="center">
            @foreach($contratoDosi as $cont)
                {{$cont->primer_nombre_contacto}} {{$cont->primer_apellido_contacto}} {{$cont->segundo_apellido_contacto}}
            @endforeach
        </td>
       
    </tr>
    <tr>
        <td style="border:0.1px solid black;">Cargo del contacto</td>
        <td style="width: 120px; border:0.1px solid black;" align="center">
            @foreach($contratoDosi as $cont)
                {{$cont->profesion_contacto}}
            @endforeach
        </td>
    </tr>
</table>    



<img src="{{asset('imagenes/LOGODOSIMETRIA.png')}}" width="100" style="left:1150px;">

<!-- ////////////////////FIN ENCABEZADO/////////////// -->

<!-- ////////////////////CUERPO/////////////// -->
<table style="top:130px; border-collapse:collapse;" cellspacing="4" cellpadding="0">
    <thead>
        <tr align="center">
            <th rowspan="2" style="width:60px;  border:0.6px solid black;">Código Dosímetro </td>
            <th rowspan="2" style="width:100px; padding:5px; border:0.6px solid black;">Apellido(s)</td>
            <th rowspan="2" style="width:100px; padding:5px; border:0.6px solid black;">Nombre(s)</td>
            <th rowspan="2" style="width:5px; border:0.6px solid black;"><p class="anchoCell">Género</p></td>
            <th rowspan="2" style="width:5px; border:0.6px solid black;"><p class="anchoCell">Ocupación</p></td>
            <th rowspan="2" style="width:60px; padding:5px; border:0.6px solid black;">Documento de Identidad</td>
            <th rowspan="2" style="width:60px;  border:0.6px solid black;">Fecha de Ingreso al Servicio</td>
            <th colspan="2" style="width:60px; padding:5px; border:0.6px solid black;">Periodo de uso del dosímetro</td>
            <th rowspan="2" style="width:50px; border:0.6px solid black;"><p class="verticalText">Período de recambio</p></td>
            <th rowspan="2" style="width:50px; border:0.6px solid black;"><p class="verticalText">Ubicación <BR></BR> del  <BR></BR> dosímetro</p></td>
            <th rowspan="2" style="width:50px; border:0.6px solid black;"><p class="verticalText">Energía ó calidad de radiación</p></td>
            <th colspan="3" style="width:156px; padding:5px; border:0.6px solid black;">Dosis del Período (mSv)</td>
            <th colspan="3" style="width:156px; padding:5px; border:0.6px solid black;">Dosis acumulada 12 meses anteriores</td>
            <th colspan="3" style="width:156px; padding:5px; border:0.6px solid black;">Dosis acumulada desde ingreso al servicio (mSv)</td>
        </tr>
        <tr align="center">
            <th style="padding:5px; border:0.6px solid black;">Primer Día</td>
            <th style="padding:5px; border:0.6px solid black;">Último Día</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(10)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(0.07)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(3)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(10)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(0.07)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(3)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(10)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(0.07)</td>
            <th style="padding:5px; border:0.6px solid black;">Hp(3)</td>
        </tr>
    </thead>
    <tbody>

        @foreach($dosicontrolasig as $dosicontrol)
            <tr align="center">
                <td style="padding:2px; border:0.1px solid black;">{{$dosicontrol->codigo_dosimeter}}</td>
                <td style="padding:2px; border:0.1px solid black;">CONTROL</td>
                <td style="padding:2px; border:0.1px solid black;">N.A.</td>
                <td style="padding:2px; border:0.1px solid black;">N.A.</td>
                <td style="padding:2px; border:0.1px solid black;">{{$dosicontrol->ocupacion}}</td>
                <td style="padding:2px; border:0.1px solid black;">N.A.</td>
                <td style="padding:2px; border:0.1px solid black;">N.A.</td>
                <td style="padding:2px; border:0.1px solid black;">
                    @php
                        $datefix = date('d-m-Y',strtotime($dosicontrol->primer_dia_uso));
                    @endphp
                    {{$datefix}}
                </td>
                <td style="padding:2px; border:0.1px solid black;">
                    @php
                        $datefix = date('d-m-Y',strtotime($dosicontrol->ultimo_dia_uso));
                    @endphp
                    {{$datefix}}
                </td>
                <td style="padding:2px; border:0.1px solid black;">
                    @foreach($contratoDosi as $cont)
                        {{$cont->periodo_recambio}}
                    @endforeach
                </td>
                <td style="padding:2px; border:0.1px solid black;">CONTROL</td>
                <td style="padding:2px; border:0.1px solid black;">{{$dosicontrol->energia}}</td>
                
                <!--  /////////DOSIS DEL PERIODO///// -->
                <td style="padding:2px; border:0.1px solid black;">{{$dosicontrol->Hp10_calc_dose}}</td>
                <td style="padding:2px; border:0.1px solid black;">{{$dosicontrol->Hp007_calc_dose}}</td>
                <td style="padding:2px; border:0.1px solid black;"></td>

                <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                <td style="padding:2px; border:0.1px solid black;"></td>
                <td style="padding:2px; border:0.1px solid black;"></td>
                <td style="padding:2px; border:0.1px solid black;"></td>

                <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                <td style="padding:2px; border:0.1px solid black;"></td>
                <td style="padding:2px; border:0.1px solid black;"></td>
                <td style="padding:2px; border:0.1px solid black;"></td>

            </tr>
        @endforeach
        @foreach($trabajdosiasig as $dositrabj)
            <tr >
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->dosimetro->codigo_dosimeter}}</td>
                <td style="padding:2px; border:0.1px solid black;">{{$dositrabj->trabajador->primer_apellido_trabajador}} {{$dositrabj->trabajador->segundo_apellido_trabajador}}</td>
                <td style="padding:2px; border:0.1px solid black;">{{$dositrabj->trabajador->primer_nombre_trabajador}} {{$dositrabj->trabajador->segundo_nombre_trabajador}}</td>
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->trabajador->genero_trabajador}}</td>
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->ocupacion}}</td>
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->trabajador->cedula_trabajador}}</td>
                <td style="padding:2px; border:0.1px solid black;">
                    @foreach($fechainiciodositrabaj as $fec)
                        @if($dositrabj->trabajador->id_trabajador == $fec->trabajador_id)
                            @php
                                $datefix = date('d-m-Y',strtotime($fec->primer_dia_uso));
                            @endphp
                            {{$datefix}}
                        @endif
                    @endforeach
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @php
                        $datefix = date('d-m-Y',strtotime($dositrabj->primer_dia_uso));
                    @endphp
                    {{$datefix}}
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @php
                        $datefix = date('d-m-Y',strtotime($dositrabj->ultimo_dia_uso));
                    @endphp
                    {{$datefix}}
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @foreach($contratoDosi as $cont)
                        {{$cont->periodo_recambio}}
                    @endforeach
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @if($dositrabj->dosimetro->tipo_dosimetro == 'EZCLIP')
                        {{$dositrabj->holder->tipo_holder}}
                    @else
                        {{$dositrabj->dosimetro->tipo_dosimetro}}
                    @endif
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->energia}}</td>

                <!--  /////////DOSIS DEL PERIODO///// -->
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->Hp10_calc_dose}}</td>
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->Hp007_calc_dose}}</td>
                <td style="padding:2px; border:0.1px solid black;" align="center">{{$dositrabj->Hp3_calc_dose}}</td>

                <!-- ///////DOSIS ACUMULADA 12 MESES ANTERIORES/////// -->
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @php
                        $sumaHp10calcdose = 0;
                    @endphp
                    @foreach($trabajadoresaisgxmeses as $mesesdositrab)
                        @for($i=0; $i< count($mesesdositrab); $i++)
                            @if($dositrabj->trabajador->id_trabajador == $mesesdositrab[$i]->trabajador_id)
                                @php
                                    $sumaHp10calcdose += $mesesdositrab[$i]->Hp10_calc_dose;
                                @endphp
                            @endif
                        @endfor
                    @endforeach
                    {{$sumaHp10calcdose}}
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @php
                        $sumaHp007calcdose = 0;
                    @endphp
                    @foreach($trabajadoresaisgxmeses as $mesesdositrab)
                        @for($i=0; $i< count($mesesdositrab); $i++)
                            @if($dositrabj->trabajador->id_trabajador == $mesesdositrab[$i]->trabajador_id)
                                @php
                                    $sumaHp007calcdose += $mesesdositrab[$i]->Hp007_calc_dose;
                                @endphp
                            @endif
                        @endfor
                    @endforeach
                    {{$sumaHp007calcdose}}
                </td>
                <td style="padding:2px; border:0.1px solid black;" align="center">
                    @php
                        $sumaHp3calcdose = 0;
                    @endphp
                    @foreach($trabajadoresaisgxmeses as $mesesdositrab)
                        @for($i=0; $i< count($mesesdositrab); $i++)
                            @if($dositrabj->trabajador->id_trabajador == $mesesdositrab[$i]->trabajador_id)
                                @php
                                    $sumaHp3calcdose += $mesesdositrab[$i]->Hp3_calc_dose;
                                @endphp
                            @endif
                        @endfor
                    @endforeach
                    {{$sumaHp3calcdose}}
                </td>

                <!-- //////////DOSIS ACUMULADA DESDE INGRESO AL SERVICIO//////// -->
                <td style="padding:2px; border:0.1px solid black;"></td>
                <td style="padding:2px; border:0.1px solid black;"></td>
                <td style="padding:2px; border:0.1px solid black;"></td>

            </tr>
        @endforeach
    </tbody>
</table>

<p style="position:absolute; top:500px; font-size:8px; text-align:justify;">
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
</p> 

<div style="position:absolute; top:593px; border:solid 0.1px #000; width: 1255px;  height:80px; padding:5px 5px 5px 5px;">
    <div style="float: left; width: 540px; text-align: justify; padding:0px;">
        <p style="font-size:12px; margin:0px; padding:0px;">Información de interés general:</p>
        <p style="padding:0px; margin:0px; font-size:8px;">
        
             -  Hp(d), es la dosis equivalente personal a la profundidad indicada en milimetros. Así: Hp(10) estima la dosis en tejido profundo (deep) 
                a 10mm de profundidad, Hp(3) estima la dosis al cristalino (eye o lente de ojo) a 3mm de profundidad, y Hp(0.07) estima la dosis 
                en tejido superficial (extremidades y piel o shallow) a 0,07mm de profundidad.    <br>          
             -  Los dosímetros de anillo y brazalete tienen aplicación en prácticas donde el usuario manipula los materiales radiactivos. <br>          
             -  Los dosímetros de control, tienen por objeto la verificación de irradiaciones incidentales o accidentales durante el transporte y/o lugar            
            de almacenamiento mientras es retornado para lectura. No deben utilizarse o ser asignados a usuario 
        </p>
    </div>
    <div style="float: right; width:610px; margin-right:20px; text-align:justify;">
        <p style="padding:5px; margin:0px; font-size:8px;">
            <br>
             -  Toda dosis que supere el valor de 1.67 mSv/mes debe ser investigada y documentada al interior de la instalación. Tal registro, es 
            una señal de alerta indicadora de la posibilidad de sobrepasar el límite anual, o indicadora de la necesidad de optimizar la práctica. <br>
             -  Toda dosis que supere el valor de 12.0 mSv/mes debe ser inmediatamente reportada a la Autoridad Reguladora, con el fin de emprender 
            acciones que reduzcan o eviten la exposición o la probabilidad de exposición. <br>
             -  La periodicidad de recambio de los dosímetros, reviste importancia ante la necesidad de investigar registros de dosis fuera de los rangos 
            recomendados, ante un incidente, un accidente o una situación de emergencia.
        </p>
    </div>
</div>
<p style="position:absolute; top:683px; margin:0px; height:23px; width:1255px; font-size:8px; padding:5px; border:solid 0.1px #000; text-align:justify;">
    <b>(1) En el caso que usuario haya sido desactivado y reactivado posteriormente, la fecha indicada en este campo será la de la ultima reactivación. Nota 9. Se refleja periodo de uso extendido según indicación sobre fechas reales de uso y por solicitud expresa del cliente.
    Este ajuste no implica <br> cambio en el histórico de dosis.
    En caso de necesitar cualquier aclaración respecto a la información aquí dispuesta favor hacer la consulta al correo electrónico reportes@dosimetrix.com.</b>
</p>


<!-- ////////////////////////////////////----------------SEGUNDA PAGINA------------//////////////////////////////////////////////7 -->

<div style="position:absolute; width: 100%; height:20px; page-break-before: always; font-size: 12px;">
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
</div>

    <!-- ////////////////////SCRIPT PARA CONTAR LAS PAGINAS/////////////// -->
    <script type="text/php">
        if (isset($pdf)) {
            $text = "página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 40;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
