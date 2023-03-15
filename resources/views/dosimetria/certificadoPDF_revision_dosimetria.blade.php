<style>
    body{
        /* background: orange; */
        font-family: sans-serif;
        font-size: 12px;
        margin: 10pt 30pt 10pt 30pt;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    
    td, th{
        border:0.1px solid black;
    }
    footer {
        position: fixed;
        bottom: 60px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align:center;
        color:#1A9980;

    } 
</style>
<body>
    <img src="{{asset('imagenes/VerdeSF.png')}}" width="200" style="position:relative; right:20px; bottom:10px; ">
    <img src="{{asset('imagenes/SERVICIOS_QA.png')}}" width="330" style="position:relative; left:100px;">
    
    <p style="position:relative;">Señores</p>
    <p style="position:relative; bottom:8px;"><b>EMPRESA</b></p>
    <p style="position:relative; bottom:16px;">NIT:</p>
    <p style="position:relative; bottom:24px;">Dirección:</p>
    <p style="position:relative; bottom:32px;">Municipio</p>
    <p style="position:relative; bottom:24px;"> <b>Ref.: notificación revisión salida dosímetros – RSD-OSL-QA-100001</b></p>
    <p style="position:relative; bottom:15px;">Cordial saludo,</p>

    <p style="position:relative; bottom:8px; text-align:justify;">La empresa cuenta con un programa de aseguramiento de la calidad del laboratorio de dosimetría personal (LDP). Por lo tanto, deseamos informarles que hemos llevado a cabo la revisión de los dosímetros antes del envío a sus instalaciones, en este proceso garantizamos que la cantidad dosímetros sea la correcta y que el numero del dosímetro con la información de la etiqueta se encuentren asociados para el periodo asignado.</p>
    <p style="position:relative; text-align:justify;">A continuación se listan los dosímetros revisados:</p>

   {{--  <p style="position:relative; top:-30px; text-align:justify;">QA POSITRON S.A.S le notifica a la institución @if(empty($empresa)){{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} con NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @else {{$empresa[0]->nombre_empresa}} con NIT: {{$empresa[0]->num_iden_empresa}}-{{$empresa[0]->DV}} @endif  que los dosímetros entregados han pasado por el proceso de verificación tanto de etiqueta, dosímetro y usuario final satisfactoriamente. A continuación, evidencia de la verificación: </p> --}}
                
    <table style="position:relative; margin: 0 auto; border-collapse:collapse; font-size:10px; width: 100%" cellpadding="10">
        <thead>
            <tr style="background-color:#1A9980; color:white;">
                <th style="width: 20%;">Apellidos y nombres</th>
                <th>Dosímetro</th>
                <th>Holder</th>
                <th>Ubicación</th>
                <th>Especialidad</th>
                <th>Mes</th>
                <th>Sede</th>
                <th>Periodo</th>
                <th style="width: 25%;">Observaciones Revisión salida<sup>1</sup></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <p style="position:relative; text-align:justify;">Se revisaron 3 dosímetros de control, tres dosímetros de tórax, un dosímetro de anillo y un dosímetro de cristalino, para un total de 8 dosímetros.</p>
    <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número de revisión dosímetros del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
    <p style="position:relative; text-align:justify;">Cordialmente,</p>
    
</body>