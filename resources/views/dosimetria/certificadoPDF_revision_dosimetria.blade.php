<style>
    body{
        /* background: orange; */
        font-family: sans-serif;
        font-size: 12px;
        margin: 30pt 30pt 30pt 30pt;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    
    td, th{
        border:0.1px solid black;
    }
</style>
<body>
    <img src="{{asset('imagenes/VerdeSF.png')}}" width="200" style="position:relative; right:0px; top:-30px;">
    <h4 style="position:relative; top:-60px; text-align: right; button:200px;">Número de revisión dosímetros:</h4>
    <h4 style="position:relative; top:-75px; text-align: right; button:200px;">Fecha de emisión:</h4>
    <p style="position:relative; top:-90px; ">Señores</p>
    <p style="position:relative; top:-100px; "><b>EMPRESA</b></p>
    <p style="position:relative; top:-110px; ">NIT:</p>
    <p style="position:relative; top:-120px; ">Sede:</p>
    <p style="position:relative; top:-130px; ">Dirección:</p>
    <p style="position:relative; top:-140px; ">Municipio</p>
    <p style="position:relative; bottom:140px;"> <b>Ref.: notificación revisión salida dosímetros (RSD)</b></p>
    <p style="position:relative; bottom:130px;">Cordial saludo,</p>

    <p style="position:relative; bottom:120px; text-align:justify;">Nuestra empresa cuenta con un programa de aseguramiento de la calidad del laboratorio de dosimetría personal, y por tal motivo, nos permitimos informar que se realizó el protocolo de revisión de dosímetros antes del envío a sus instalaciones, en este proceso garantizamos que la cantidad dosímetros sea la correcta, que el numero del dosímetro con la información de la etiqueta se encuentren asociados para el periodo asignado.</p>
    <p style="position:relative; bottom:110px; text-align:justify;">A continuación se listan los dosímetros revisados para el periodo </p>

   {{--  <p style="position:relative; top:-30px; text-align:justify;">QA POSITRON S.A.S le notifica a la institución @if(empty($empresa)){{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} con NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @else {{$empresa[0]->nombre_empresa}} con NIT: {{$empresa[0]->num_iden_empresa}}-{{$empresa[0]->DV}} @endif  que los dosímetros entregados han pasado por el proceso de verificación tanto de etiqueta, dosímetro y usuario final satisfactoriamente. A continuación, evidencia de la verificación: </p> --}}
                
    <table style="position:relative; bottom:100px; margin: 0 auto; border: solid 0.1px #000; border-collapse:collapse; font-size:10px; width: 100%" cellpadding="4">
        <thead>
            <tr style="background-color:#1A9980; color:white;">
                <th style="width: 20%;">Trabajador</th>
                <th>Dosímetro</th>
                <th>Holder</th>
                <th>Ubicacion</th>
                <th>Especialidad</th>
                <th>Sede</th>
                <th style="width: 20%;">Revisión llegada <sup>1</sup></th>
                <th style="width: 5%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <p style="position:relative; bottom:100px; text-align:justify;">Se revisaron 3 dosímetros de control, tres dosímetros de cuerpo entero, un dosímetro de anillo y un dosímetro de cristalino, para un total de 8 dosímetros.</p>
    <p style="position:relative; bottom:90px; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número de revisión dosímetros del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
    <p style="position:relative; bottom:80px; text-align:justify;">Cordialmente,</p>
    <div style="position:relative; bottom:-80px; float: left; text-align:center;">
        <label style="position: relative; top: 50px; ">_________________________________________</label> <br>
        <label style="position: relative; top: 50px; color:#1A9980;">Diego Fernando Aponte Castañeda</label> <br>
        <label style="position: relative; top: 50px;">Representante legal</label> <br>
        <label style="position: relative; top: 50px;">Responsable de la lectura de los dosímetros</label>
    </div>
    <div style="position:relative; bottom:-80px; float: right; text-align:center;">
        <label style="position: relative; top: 50px;">_________________________________________</label> <br>
        <label style="position: relative; top: 50px; color:#1A9980;">Judy J. Gaviria Torres</label> <br>
        <label style="position: relative; top: 50px;">Ingeniera</label> <br>
        <label style="position: relative; top: 50px;">Operador logístico</label>
    </div>
    <p style="position: relative; top:190px;"><b>_____________________________________</b></p>
    <p style="position: relative; top:190px;"><small><sup>1</sup> Campo para que el encargado de la dosimetría revise la llagada de los dosímetros una vez es abierto el paquete</small></p>
    <p style="position: relative; top:180px;text-align:center; color:#1A9980;">________________________________________________________________________________________</p>
    <p style="position: relative; top:170px;text-align:center; color:#1A9980;">Servicios en dosimetría, protección radiológica y controles de calidad equipos de Rayos X</p>
    <p style="position: relative; top:160px; text-align:center; color:#1A9980;">dosimetria.qapositron@gmail.com – 301 449 5401 – 310 607 9375 – 304 338 6581</p>
    <p style="position: relative; top:150px;  text-align:center; color:#1A9980;">www.qapositron.com</p>







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