<style>
    @page {
        margin: 0cm 0cm;
    }
    body{
       /*  background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 11px;
        margin-top: 1cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 1cm;
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
        bottom: 1cm; 
        left: 2cm; 
        right: 2cm;
        height: 2.3cm;
        /* margin-top: 100px; */
        text-align:center;
        color:#1A9980;
        /* background: yellowgreen; */
        font-size: 11px;
    }
    main{
        position: relative;
        top: 80px;
        left: 0cm;
        right: 0cm;
        margin-bottom:3cm;
        padding-bottom: 50px;
        
        /* background: yellow; */
    }
   
    footer p {
        margin: 0px;
        padding-top: 1px;
        padding-bottom: 1px;
        opacity:0.5;
    }
    main p {
        margin: 0px;
        padding-top: 3px;
        padding-bottom:3px;
        line-height: 130%;
    }
    /* td, th{
        border:0.1px solid black;
    } */
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
        /* opacity:0.03; */
        opacity:0.5;
        /* filter: brightness(180%); */
    }
    #lista1, #lista2{
        /* background-color:red; */
        /* padding: 20px; */
        padding-left: 0px;
        margin-top: 0px; 
        margin-bottom: 0px;
        
        list-style-type: none;
        text-align:justify;

    }
    #lista1 li{
        line-height: 130%;
    }

</style>
<body>
   {{--  <div id="watermark">
        <img src="{{asset('imagenes/fondoVerde3_min.png ')}}" width="643" height="890">
    </div> --}}
    <header>
        <img src="{{asset('imagenes/1VerdeSF.png')}}" width="160" style="position:relative; right:20px; bottom: 10px; opacity:0.5;">
        <img src="{{asset('imagenes/1SERVICIOS_QA.png')}}" width="300" style="position:relative; left:170px; top:15px; opacity:0.5;">
        
    </header>
    <footer>
        <p>__________________________________________________________________________________________________________</p>
        <p>Servicio de dosimetría personal mediante tecnología de BeOSL. Lic. QAP-001 2023 de Min. Minas y Energía.</p>
        <p>Servicios en protección radiológica y controles de calidad - Res. 09472 de 2020 de Sec. Salud Santander</p>
        <p >E-mail: qapositron@gmail.com</p>
        <p>www.qapositron.com</p>
    </footer>
    <main>

        <p style="text-align:center;"> <b>CONTRATO DE ARRENDAMIENTO DE DOSIMETROS Y PRESTACIÓN DE SERVICIOS COMPLEMENTARIOS DE DOSIMETRÍA PERSONAL</b>  </p>
        @php
            $n = $contdosi;
            $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
            echo "<h4 style='text-align: center;'>QA-CTO-DP-" ;
                echo $titulo;
            echo "</h4>";
        @endphp
        
        @foreach($contrato as $cont)
            <p style="text-align:justify; margin-bottom: 0px; position:relative">Entre los suscritos <b>QA POSITRON S.A.S.</b>, sociedad comercial, constituida legalmente con domicilio en la ciudad de Bucaramanga,
                debidamente inscrita en la Cámara de Comercio de esta ciudad, representada en este acto por su Representante Legal y Gerente General Asociado, <b>DIEGO FERNANDO APONTE CASTAÑEDA</b>, mayor de edad, con domicilio en la ciudad de Bucaramanga, identificado con Cédula de Ciudadanía número 80.115.846 
                expedida de Bogotá, quien en el texto de este contrato se denominará, <b>QA POSITRON S.A.S.</b>, sociedad que actúa como distribuidor y prestador de servicio de dosimetría personal autorizado bajo licencia No. QAP-001 del Ministerio de Minas, por una parte, y {{$cont->empresa->nombre_representantelegal}},
                identificado con el número de cédula No.{{$cont->empresa->cedula_representantelegal}}, que actúa como representante legal de {{$cont->empresa->razon_social_empresa}}, 
                ubicada en la dirección {{$cont->empresa->direccion_empresa}} de la ciudad de {{$cont->empresa->municipios->nombre_municol}} 
                - {{$cont->empresa->municipios->coldepartamento->nombre_deptocol}} e identificada con @if($cont->empresa->tipo_identificacion_empresa == 'NIT')NIT: {{$cont->empresa->num_iden_empresa}} - {{$cont->empresa->DV}}@elseif($cont->empresa->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA')CC: {{$cont->empresa->num_iden_empresa}}@endif,
                quien en el texto de este se denominará <b>EL USUARIO</b>, se ha celebrado un <b>CONTRATO COMERCIAL</b>, contenido en las siguientes cláusulas: <br>
                <b>PRIMERA. - OBJETO:</b>  Por medio del presente contrato <b>QA POSITRON S.A.S.</b>, se compromete a proporcionar al 
                <b>USUARIO</b>, en calidad de comodato o préstamo comercial, uno o varios dosímetros personales con sus respectivos portadosímetros, con el fin de que el <b>USUARIO</b> los utilice durante el período acordado y los devuelva al finalizar dicho período. Asimismo, <b>QA POSITRON S.A.S</b> se compromete a prestar el servicio integral de dosimetría, 
                el cual comprende, entre otros aspectos, el servicio técnico, atención al cliente, logística de distribución y recolección (de ser aplicable), así como servicios adicionales de lectura y reporte periódico de los resultados. A cambio de estos servicios, el <b>USUARIO</b> se obliga a abonar el monto acordado, de acuerdo con las condiciones 
                estipuladas en el FORMATO INICIO DEL SERVICIO DE DOSIMETRÍA PERSONAL, las COTIZACIONES correspondientes y cualquier NOVEDAD solicitada durante el período contractual. Dichos documentos adjuntos se considerarán parte integrante de este contrato. Las partes acuerdan regirse por las disposiciones establecidas en el presente contrato, 
                así como por las cláusulas contenidas en los documentos anexos, que complementan y amplían las condiciones aquí estipuladas.<br>
                <b>SEGUNDA. – <u>OBLIGACIONES DE QA POSITRON S.A.S.</u>:</b>
                
            </p>
            
            <ol id="lista1">
                <li>1. Entregar al <b>USUARIO</b> a título de préstamo, con el fin de que este utilice y restituya <b>QA POSITRON S.A.S.</b>, uno o varios equipos  &nbsp;&nbsp;&nbsp;&nbsp;de dosimetría, de las referencias "cuerpo entero, cristalino y anillo", a escogencia de este, en la fecha de inicio de este contrato &nbsp;&nbsp;&nbsp;&nbsp;y en cada periodo de medición comprendido en el servicio contratado para recambio de equipos. La entrega o reposición se &nbsp;&nbsp;&nbsp;&nbsp;realizará en fecha anterior al inicio del periodo de uso correspondientes. </li>
                <li>2. Orientar a los <b>USUARIOS</b> de los dosímetros sobre el uso de los estos. Para tal efecto <b>QA POSITRON S.A.S.</b> brindará las &nbsp;&nbsp;&nbsp;&nbsp;recomendaciones pertinentes a los <b>USUARIOS</b>, ya sea de manera escrita, mediante los formatos adjuntos a los dosímetros a  &nbsp;&nbsp;&nbsp;&nbsp;su entrega, a través de charlas de capacitación para el manejo del servicio y los dosímetros, o él envió de información por vía  &nbsp;&nbsp;&nbsp;&nbsp;electrónica.</li>
                <li>3. Cuando el servicio sea contratado en la ciudad de Bucaramanga., recoger los dosímetros dentro de los cinco (5) días hábiles  &nbsp;&nbsp;&nbsp;&nbsp;siguientes a la notificación de disponibilidad para la recolección de los mismos, realizada por parte del usuario, a la terminación &nbsp;&nbsp;&nbsp;&nbsp;del periodo de uso (mensual o trimestral). La recolección se realizará en el lugar y ante la persona designada por el <b>USUARIO</b>.</li>
                <li>4. Entregar los reportes periódicos de todos los dosímetros devueltos por el <b>USUARIO</b> una vez se realice la lectura, para lo cual &nbsp;&nbsp;&nbsp;&nbsp;contará con quince (15) días calendario a partir de la entrega de los dosímetros por parte del <b>USUARIO</b>, sin perjuicio de que &nbsp;&nbsp;&nbsp;&nbsp;dicho plazo puede extenderse por variables externas no controlables. <b>Los dosímetros no devueltos por el USUARIO no  &nbsp;&nbsp;&nbsp;&nbsp;generaran el reporte respectivo.</b></li>
                <li>5. Reemplazar el dosímetro entregado por el <b>USUARIO</b> para su lectura, por otro, siempre que el contrato siga vigente.</li>
            </ol>
            <p style="text-align:justify; margin-top: 0px; margin-bottom: 0px;"><b>TERCERA. - <u>OBLIGACIONES DEL USUARIO</u>:</b></p>
            <ol id="lista2">
                <li>1. Enviar todos los dosímetros al laboratorio de <b>QA POSITRON S.A.S.</b>, ubicado en CL 36 No.27 – 71 OFI 919 Bucaramanga – &nbsp;&nbsp;&nbsp;&nbsp;Santander dentro de los cinco (5) días hábiles siguientes a la terminación del periodo de uso (mensual, bimestral o trimestral), &nbsp;&nbsp;&nbsp;&nbsp;con el fin de que puedan ser leídos y poder generar el informe de la lectura del periodo. </li>
                <li>2. Cancelar el valor del servicio en un plazo máximo de 30 días calendario de la presentación de factura, la cual se realiza junto &nbsp;&nbsp;&nbsp;&nbsp;junto con la entrega de dosímetros por parte de <b>QA POSITRON S.A.S.</b>, para cada uno de los periodos de medición, valor que  &nbsp;&nbsp;&nbsp;&nbsp;lleva incluido el servicio de producción y entrega del dosímetro, la logística del servicio, soporte técnico y servicio al cliente, y la  &nbsp;&nbsp;&nbsp;&nbsp;lectura de este. En caso de mora en los pagos del servicio, el <b>USUARIO</b> perderá el derecho a los descuentos estipulados  &nbsp;&nbsp;&nbsp;&nbsp;inicialmente, deberá cancelar intereses equivalentes hasta el DTF + 1,50% (sin exceder la tasa de usura), sobre el valor total de  &nbsp;&nbsp;&nbsp;&nbsp;la(s) facturas(s) adeudadas(s). en caso de mora recurrente, se remite las facturas del caso para gestión de servicios de  &nbsp;&nbsp;&nbsp;&nbsp;cobranzas. El valor del servicio podrá ser ajustado hasta por el índice de inflación anualizado de los últimos doce meses al  &nbsp;&nbsp;&nbsp;&nbsp;finalizar el periodo contratado.</li>
                <li>3. A no disminuir la cantidad de dosímetros pactados en la cotización por debajo de un 80% y en caso de hacerlo, perderá el &nbsp;&nbsp;&nbsp;&nbsp;derecho a los descuentos estipulados inicialmente.</li>
                <li>4. Firmar las facturas u otros documentos comerciales que le expida <b>QA POSITRON S.A.S.</b> y que correspondan a dosímetros &nbsp;&nbsp;&nbsp;&nbsp;efectivamente entregados, en señal de que acepta la obligación de pagarlos en el término que se estipule en dichos  &nbsp;&nbsp;&nbsp;&nbsp;documentos.</li>
                <li>5. Al inicio del servicio diligenciar el total de la información del <b>FORMATO INICIO EL SERVICIO DE DOSIMETRÍA PERSONAL</b> y &nbsp;&nbsp;&nbsp;&nbsp;enviarlo a <b>QA POSITRON S.A.S.</b>, Para tal efecto, se tiene a disposición el correo electrónico dosimetria.qapositron@gmail.com.</li>
                <li>6. Informar a <b>QA POSITRON S.A.S.</b>, de manera escrita en el <b>FORMATO NOVEDAD DOSIMETRIA</b>, la necesidad de cambios en &nbsp;&nbsp;&nbsp;&nbsp;los usuarios, adiciones, o cancelaciones, a más tardar treinta (20) días calendario antes de la fecha programada para el inicio &nbsp;&nbsp;&nbsp;&nbsp;del periodo de uso para el cual se necesitan los cambios, de tal forma se puedan incorporar en la programación de  &nbsp;&nbsp;&nbsp;&nbsp;producción. <b>Solicitudes extemporáneas tendrán efectos en los cambios y la facturación para el siguiente periodo de uso  &nbsp;&nbsp;&nbsp;&nbsp;aplicable.</b></li>
                <li>7. Restituir a <b>QA POSITRON S.A.S.</b> a la finalización del contrato el último de los dosímetros en su poder.</li>
                <li>8. Pagar a <b>QA POSITRON S.A.S.</b> el valor del dosímetro en caso de pérdida o daño de este, el cual será de $200.000.oo por  &nbsp;&nbsp;&nbsp;&nbsp;dosímetro y de $50.000.oo por portadosímetro (holder). Este cargo se causará cuando luego de treinta (30) días calendario de &nbsp;&nbsp;&nbsp;&nbsp;finalizado el período de uso correspondiente no se haya hecho la devolución de los dosímetros a <b>QA POSITRON S.A.S.</b> por &nbsp;&nbsp;&nbsp;&nbsp;parte del <b>USUARIO</b>. El valor causado deberá ser restituido tras recibo de las facturas o cuentas de cobro por este concepto.</li>
                <li>9. Avisar a <b>QA POSITRON S.A.S.</b> con sesenta (60) días calendario de antelación al vencimiento del período pactado en este &nbsp;&nbsp;&nbsp;&nbsp;documento y en la cotización, su intención de no continuar con el servicio luego de terminado el periodo contratado. Si dicha &nbsp;&nbsp;&nbsp;&nbsp;comunicación no es recibida se entenderá que es intención del USUARIO dar por prorrogado el contrato por un período igual al &nbsp;&nbsp;&nbsp;&nbsp;inicialmente pactado.</li>
            </ol>
            <p style="text-align:justify; margin-top: 0px; margin-bottom: 0px;"><b>CUARTA: QA POSITRON S.A.S.</b> no responderá por las variaciones en las lecturas de los dosímetros, producidas como 
                consecuencia del mal manejo de los mismos por parte del <b>USUARIO</b>. <br>
                <b>QUINTA. - <u>DURACION</u>:</b> El presente contrato tendrá una duración que se especifica al final de este documento y se entenderá 
                prorrogado automáticamente por un período igual si QA POSITRON S.A.S. no recibe una comunicación del USUARIO, en los términos 
                y condiciones establecidos en el numeral noveno de la cláusula tercera. Para la terminación unilateral anticipada antes del 
                vencimiento del plazo inicialmente pactado, la parte que desee dar por terminado el contrato deberá notificar a la otra parte por 
                escrito, explicando las razones, con noventa (90) días calendario de anticipación a la fecha deseada de terminación efectiva del 
                servicio. <br>
                <b>SEXTA. - <u>CESION</u>:</b> Este contrato no podrá ser cedido por el <b>USUARIO</b>. por otra parte, <b>QA POSITRON S.A.S.</b>, podrá transferir el 
                cumplimiento de las obligaciones asumidas en este contrato, previa autorización del representante legal, para lo cual bastará 
                una comunicación escrita al <b>USUARIO</b> indicando el nombre de dicha persona o empresa que continuará con las obligaciones. <br>
                <b>SEPTIMA: EL USUARIO Y QA POSITRON S.A.S.</b> acuerdan suministrar la información que los organismos de control requieran o 
                dispongan conveniente.
                <br>
                <br>
                En señal de conformidad con el texto de este contrato, las partes lo suscriben en dos (2) ejemplares originales de igual valor y contenido para cada una de ellas, 
                el día {{date("d", strtotime($cont->fecha_inicio))}} del mes de 
                @php 
                    $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'obtubre', "11"=>'noviembre', "12"=>'diciembre'];
                @endphp
                {{$meses[date("m", strtotime($cont->fecha_inicio))]}} de {{date("Y", strtotime($cont->fecha_inicio))}}, en la ciudad de Bucaramanga. <br>
                <br>
                <b>Duracion:</b><br>
                Inicio: {{date("d", strtotime($cont->fecha_inicio))}} de {{$meses[date("m", strtotime($cont->fecha_inicio))]}} {{date("Y", strtotime($cont->fecha_inicio))}},
                Vigencia: 
                @if($cont->periodo_recambio == 'MENS' && $cont->numlecturas_año == 12)
                    un año, hasta {{date("d", strtotime($cont->fecha_finalizacion))}} de {{$meses[date("m", strtotime($cont->fecha_finalizacion))]}} {{date("Y", strtotime($cont->fecha_finalizacion))}},
                @elseif($cont->periodo_recambio == 'TRIMS' && $cont->numlecturas_año == 4)
                    un año, hasta {{date("d", strtotime($cont->fecha_finalizacion))}} de {{$meses[date("m", strtotime($cont->fecha_finalizacion))]}} {{date("Y", strtotime($cont->fecha_finalizacion))}},
                @elseif($cont->periodo_recambio == 'BIMS' && $cont->numlecturas_año == 6)
                    un año, hasta {{date("d", strtotime($cont->fecha_finalizacion))}} de {{$meses[date("m", strtotime($cont->fecha_finalizacion))]}} {{date("Y", strtotime($cont->fecha_finalizacion))}},
                @else
                    {{$cont->numlecturas_año}} período(s), hasta {{date("d", strtotime($cont->fecha_finalizacion))}} de {{$meses[date("m", strtotime($cont->fecha_finalizacion))]}} {{date("Y", strtotime($cont->fecha_finalizacion))}},
                @endif
                prorroglable automáticamente.
                <br>
                <br>
                <b>Dirección para Notificaciones:</b><br>
                <b>QA POSITRON S.A.S.:</b> CL 36 No.27 – 71 OFI 919 Bucaramanga <b>Cel.</b> 3106079373- 3014495401 - 3043386581 <br>
                <b>USUARIO: </b>{{$cont->empresa->razon_social_empresa}}  <b>CIUDAD:</b>{{$cont->empresa->direccion_empresa}}, {{ucfirst(mb_strtolower($cont->empresa->municipios->nombre_municol))}} - {{ucfirst(mb_strtolower($cont->empresa->municipios->coldepartamento->nombre_deptocol))}} <b>Cel.</b> {{$cont->empresa->telefono_empresa}}

            </p>
            <div style="position:relative; width:50%; height: 170px; top:80px; page-break-inside: avoid; ">
                <img src="{{asset('imagenes/FIRMADEDIEGOFINAL.png')}}" width="170" height="70" style="position:relative;  left:75px;">
                <p style="position:relative;  text-align: center; font-size: 11px;"><b>DIEGO F. APONTE CASTEÑEDA</b></p><br>
                <p style="position:relative; bottom: 17px; text-align: center; font-size: 11px;">REP. LEGAL QA POSITRON SAS</p><br>
                <p style="position:relative; bottom: 35px; text-align: center; font-size: 11px; ">CEL : (+57) 301 449 5401</p><br>
                <p style="position:relative; bottom: 55px; text-align: center; font-size: 11px; ">e-mail: <u style="color: blue;">dosimetría.qapositron@gmail.com</u> </p>
            </div>

            <div style="position:relative; width: 50%; height: 170px; left: 320px; top:-90px; page-break-inside: avoid;">
                <p style="position: relative; top:70px; text-align: center;"><b>{{$cont->empresa->nombre_representantelegal}}</b></p> <br>
                <p style="position: relative; top:53px;text-align: center; font-size: 11px;">REP. LEGAL {{$cont->empresa->razon_social_empresa}}</p> <br>
                <p style="position: relative; top:35px; text-align: center; font-size: 11px; ">CEL. (+57) {{$cont->empresa->telefono_representantelegal}}</p> <br>
                <p style="position:relative; top:15px; text-align: center; font-size: 11px; ">e-mail: <u style="color: blue;">{{mb_strtolower($cont->empresa->email_empresa)}}</u> </p>
            </div>
        @endforeach
    
    </main>
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>
    <script type="text/javascript">
       
        $(document).ready(function(){
            var h1contrato = document.getElementById("contrato");
            var num = parseInt('{{$contdosi}}');
            var n = num.toString().padStart(5,'0');
            console.log("ESTE ES EL CODIGO" +n);
            h1contrato.innerHTML = "QA-CTO-DP-"+n;
        })
    </script>   

    <!-- ////////////////////SCRIPT PARA CONTAR LAS PAGINAS/////////////// -->
    <script type="text/php">
        if (isset($pdf)) {
            $text = "página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 1.9;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>