<style>
    @page {
        margin: 0cm 0cm;
    }
    body{
       /*  background: orange; */
        font-family: "Calibri, sans-serif";
        font-size: 12px;
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
        height: 2cm;
        /* margin-top: 100px; */
        text-align:center;
        color:#1A9980;
        background: yellowgreen;
       
    }
    main{
        position: relative;
        top: 80px;
        left: 0cm;
        right: 0cm;
        margin-bottom:3cm;
        padding-bottom: 50px;
        display:block;
        background: yellow;
    }
    p {
        margin: 0px;
        padding-top: 2px;
        padding-bottom: 2px;
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
        opacity:0.2;
    }
</style>
<body>
    <div id="watermark">
        <img src="{{asset('imagenes/fondo.png')}}">
    </div>
    <header>
        <img src="{{asset('imagenes/1VerdeSF.png')}}" width="180" style="position:relative; right:20px; bottom: 10px; opacity:0.5;">
        <img src="{{asset('imagenes/1SERVICIOS_QA.png')}}" width="300" style="position:relative; left:170px; top:15px; opacity:0.5;">
        
    </header>
    <footer>
        <p>______________________________________________________________________________________</p>
        <p >Servicio de dosimetría personal mediante tecnología de BeOSL. Lic. QAP-001 2023 de Min. Minas y Energía.</p>
        <p>Servicios en protección radiológica y controles de calidad - Res. 09472 de 2020 de Sec. Salud Santander</p>
        <p >E-mail: qapositron@gmail.com</p>
        <p>www.qapositron.com</p>
    </footer>
    <main>
        {{-- <p style="text-align:center;">CONTRATO DE ARRENDAMIENTO DE DOSIMETROS Y PRESTACIÓN DE SERVICIOS COMPLEMENTARIOS DE DOSIMETRÍA PERSONAL </p>
    @php
        $n = $contdosi;
        $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
        echo "<h4 style='text-align: center;'>QA-CTO-DP-" ;
            echo $titulo;
        echo "</h4>";
    @endphp
    
    @foreach($contrato as $cont)
        <p style="text-align:justify; margin-bottom: 0px;">Entre los suscritos <b>QA POSITRON S.A.S.</b>, sociedad comercial, con domicilio en la ciudad de Bucaramanga,
            constituida mediante escritura pública a número 13 de fecha 14 de enero de 1.997, otorgada en la Notaría 52 del Círculo Notaria de Bucaramanga,
            debidamente inscrita en la Cámara de Comercio de esta ciudad, representada en este acto por su Representante Legal y Gerente General Asociado, 
            <b>DIEGO FERNANDO APONTE CASTAÑEDA</b>, mayor de edad, con domicilio en la ciudad de Bucaramanga, identificado con Cédula de Ciudadanía número 80.115.846 
            expedida de Bogotá, quien en el texto de este contrato se denominará, <b>QA POSITRON S.A.S.</b>, sociedad que actúa como distribuidor y prestador de 
            servicio de dosimetría personal autorizado bajo licencia No. _____________ del Ministerio de Minas, por una parte, y {{$cont->empresa->nombre_representantelegal}},
            identificado con el número de cédula No.{{$cont->empresa->cedula_representantelegal}}, que actúa como representante legal de {{$cont->empresa->nombre_empresa}}, 
            ubicada en la dirección {{$cont->empresa->direccion_empresa}} de la ciudad de {{$cont->empresa->municipios->nombre_municol}} 
            - {{$cont->empresa->municipios->coldepartamento->nombre_deptocol}} y NIT: {{$cont->empresa->num_iden_empresa}} - {{$cont->empresa->DV}},
            quien en el texto de este se denominará <b>EL USUARIO</b>, se ha celebrado un <b>CONTRATO COMERCIAL</b>, contenido en las siguientes cláusula: <br>
            <b>PRIMERA. - OBJETO:</b>  Por medio del presente contrato <b>QA POSITRON S.A.S.</b>, se compromete a entregar a manera de comodato o préstamo comercial al 
            <b>USUARIO</b>, para que este utilice en forma gratuita y restituya al final de cada período de uso, uno o varios dosímetros personales con sus respectivos 
            portadosímetros, y prestar el servicio global de dosimetría, el cual incluye entre otros, el servicio técnico, servicio al cliente, logística de distribución 
            y recolección (de ser aplicable), servicios complementarios de lectura y reporte periódico de los resultados. Como contraprestación de estos servicios, el USUARIO 
            se obliga a pagar el valor convenido, todo de conformidad con las condiciones que sobre productos, duración del contrato, costo y plazos de entrega de resultados, 
            se  establecen en el “Formato de Solicitud de Servicios de Dosimetría”, adjunto a este contrato formando parte integral del mismo, concordante con la correspondiente 
            cotización del servicio y demás documentos y comunicaciones relativos a esta orden contractual, que hacen también parte integral de este contrato. <br>
            <b>SEGUNDA. – <u>OBLIGACIONES DE QA POSITRON S.A.S.</u>:</b>
        </p>
        <ol style="padding-left: 18px; text-align:justify; margin-top: 0px; margin-bottom: 0px;">
            <li>Entregar al <b>USUARIO</b> a título de préstamo, con el fin de que este utilice y restituya <b>QA POSITRON S.A.S.</b>, uno o varios equipos de dosimetría, 
                de las referencias "cuerpo entero, cristalino y anillo", a escogencia del mismo, en la fecha de inicio de este contrato y en cada periodo de medición 
                comprendido en el servicio contratado para recambio de equipos. La entrega o reposición se realizará en fecha anterior al inicio del periodo de uso correspondientes. </li>
            <li>Orientar a los <b>USUARIOS</b> de los dosímetros sobre el uso de los mismos. Para tal efecto <b>QA POSITRON S.A.S.</b> brindara las recomendaciones pertinentes a los 
                <b>USUARIOS</b>, ya sea de manera escrita, mediante los formatos adjuntos a los dosímetros a su entrega, a través de charlas de capacitación para el manejo 
                del servicio y los dosímetros, o él envió de información por vía electrónica.</li>
            <li>Cuando el servicio sea contratado en la ciudad de Bucaramanga., recoger los dosímetros dentro de los cinco (5) días hábiles siguiente a la notificación de disponibilidad
                para la recolección de los mismos, realizada por parte del usuario, a la terminación del periodo de uso (mensual o trimestral). La recolección se realizará en el lugar y 
                ante la persona designada por el <b>USUARIO</b>.</li>
            <li>Entregar los reportes periódicos de todos los dosímetros devueltos por el <b>USUARIO</b> una vez se realice la lectura, para lo cual contara con quince (15) días calendario 
                a partir de la entrega de los dosímetros por parte del <b>USUARIO</b>, sin perjuicioso de que dicho plazo puede extenderse por variables externas no controlables. 
                <b>Los dosímetros no devueltos por el USUARIO no generaran el reporte respectivo.</b></li>
            <li>Reemplazar el dosímetro entregado por el <b>USUARIO</b> para su lectura, por otro, siempre que el contrato siga vigente.</li>
        </ol>
        <p style="text-align:justify; margin-top: 0px; margin-bottom: 0px;"><b>TERCERA. - <u>OBLIGACIONES DEL USUARIO</u>:</b></p>
        <ol style="padding-left: 18px; text-align:justify; margin-top: 0px; margin-bottom: 0px;">
            <li>Poner a disposición de <b>QA POSITRON S.A.S.,</b> dentro de los cinco (5) días hábiles siguientes a la terminación del periodo de uso (mensual, bimestral o trimestral). 
                Los dosímetros que se distribuyan, con el fin de que puedan ser enviados para sus lectura y reporte. Cuando el servicio sea contratado fuera de Bucaramanga., deberá enviar 
                los dosímetros a las oficinas de <b>QA POSITRON S.A.S.</b> para el mismo efecto.</li>
            <li>Cancelar el valor del servicio en un plazo máximo de 30 días calendario de la presentación de factura, la cual se podrá realizar junto con la entrega de dosímetros por parte 
                de <b>QA POSITRON S.A.S.</b>, para cada uno de los periodos de medición, valor que lleva incluido el servicio de producción y entrega del dosímetro, la logística del servicio, 
                soporte técnico y servicio al cliente, y la lectura del mismo. En caso de mora en los pagos del servicio, el <b>USUARIO</b> perderá el derecho a los descuentos estipulados 
                inicialmente, deberá cancelar intereses equivalentes hasta el DTF + 1,50% (sin exceder la tasa de usura), sobre el valor total de la(s) facturas(s) adeudadas(s). en caso de mora 
                recurrente, se remite las facturas del caso para gestión de servicios de cobranzas. El valor del servicio podrá ser ajustado hasta por el índice de inflación anualizado de los 
                últimos doce meses al finalizar el periodo contratado.</li>
            <li>Firmar las facturas u otros documentos comerciales que le expida <b>QA POSITRON S.A.S.</b> y que correspondan a dosímetros efectivamente entregados, en señal de que acepta la 
                obligación de pagarlos en el término que se estipule en dichos documentos.</li>
            <li>Notificar por escrito a <b>QA POSITRON S.A.S.</b>, al inicio del servicio, la persona encargada de entregar los dosímetros, y notificar el día en que estarán a disposición para 
                recolección al final de cada periodo de uso, en caso de aplicar. Para tal efecto, se tiene a disposición el correo electrónico dosimetria.qapositron@gmail.com.</li>
            <li>Informar a <b>QA POSITRON S.A.S.</b>, de manera escrita y/o en los formatos de novedades suministrados para tal fin, la necesidad de cambios en los usuarios, adiciones, o 
                cancelaciones, a más tardar treinta (30) días calendario antes de la fecha programada para el inicio del periodo de uso para el cual se necesitan los cambios, de tal forma se 
                puedan incorporar en la programación de producción. <b>Solicitudes extemporáneas tendrán efectos en los cambios y la facturación para el siguiente periodo de uso aplicable.</b></li>
            <li>Restituir a <b>QA POSITRON S.A.S.</b> a la finalización del contrato el último de los dosímetros en su poder.</li>
            <li>Pagar a <b>QA POSITRON S.A.S.</b> el valor del dosímetro en caso de pérdida o daño del mismo, el cual será de $180.000.oo por dosímetro y de $50.000.oo por portadosímetro. 
                Este cargo se causará cuando luego de treinta (30) días calendario de finalizado el período de uso correspondiente no se haya hecho la devolución de los dosímetros a 
                <b>QA POSITRON S.A.S.</b> por parte del <b>USUARIO</b>. El valor causado deberá ser restituido tras recibo de las facturas o cuentas de cobro por este concepto.</li>
            <li>Avisar a <b>QA POSITRON S.A.S.</b> con cuarenta y cinco (45) días calendario de antelación al vencimiento del período pactado en el numeral sexto de “FORMATO DE SOLICITUD PARA SERVICIO 
                DE DOSIMETRIA PERSONAL”, su intención de no continuar con el servicio luego de terminado el periodo contratado. Si dicha comunicación no es recibida se entenderá que es intención del 
                <b>USUARIO</b> dar por prorrogado el contrato por un período igual al inicialmente pactado.</li>
        </ol>
        <p style="text-align:justify; margin-top: 0px; margin-bottom: 0px;"><b>CUARTA: QA POSITRON S.A.S.</b> no responderá por las variaciones en las lecturas de los dosímetros, producidas como 
            consecuencia del mal manejo de los mismos por parte del <b>USUARIO</b>. <br>
            <b>QUINTA. - <u>DURACION</u>:</b>El presente contrato tendrá la duración establecida en el numeral sexto (6) del formato de “FORMATO DE SOLICITUD PARA SERVICIO DE DOSIMETRIA PERSONAL” 
            que forma parte integrante del mismo y se entenderá prorroga do automáticamente por un período igual si <b>QA POSITRON S.A.S.</b> no recibe una comunicación del <b>USUARIO</b>, en el 
            término y condiciones pactados en el numeral octavo de la cláusula tercera. Para terminación unilateral anticipada al plazo inicialmente pactado, se notificará a la otra parte de manera 
            escrita explicando las razones con sesenta (60) días calendario de anticipación a la fecha deseada de terminación efectiva del servicio. <br>
            <b>SEXTA. - <u>CESION</u>:</b>Este contrato no podrá ser cedido por el <b>USUARIO. QA POSITRON S.A.S.</b> podrá transferir el cumplimiento de las obligaciones asumidas en este contrato, 
            previa autorización del representante legal., para lo cual bastará una comunicación escrita al <b>USUARIO</b> indicando el nombre de dicha persona. <br>
            <b>SEPTIMA: EL USUARIO Y QA POSITRON S.A.S. </b>acuerdan suministrar la información que los organismos de control requieran o dispongan conveniente.
            <br>
            <br>
            En señal de conformidad con el texto de este contrato, las partes lo suscriben en dos (2) ejemplares originales de igual valor y contenido para cada una de ellas, 
            hoy @php echo date("d") @endphp del mes de 
            @php 
            $meses = ["01"=>'enero', "02"=>'febrero', "03"=>'marzo', "04"=>'abril', "05"=>'mayo', "06"=>'junio', "07"=>'julio', "08"=>'agosto', "09"=>'septiembre', "10"=>'obtubre', "11"=>'noviembre', "12"=>'diciembre'];
            echo $meses[date("m")];
            @endphp
            de @php echo date("Y") @endphp, en la ciudad de Bucaramanga. <br>
            <br>
            Dirección para Notificaciones: <br>
            <br>
            <b>QA POSITRON S.A.S.:</b> CL 36 No.27 – 71 OFI 919 Bucaramanga Cel. 3106079373- 3014495401 - 3043386581
            <b>USUARIO:</b>{{$cont->empresa->nombre_empresa}}  <b>CIUDAD:</b> {{$cont->empresa->municipios->nombre_municol}}

        </p>
    
    @endforeach --}}
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


</body>