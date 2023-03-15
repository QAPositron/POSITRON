<style>
    body{
        /* background: orange; */
        font-family: sans-serif;
        font-size: 12px;
        margin: 30pt 30pt 30pt 30pt;
    }
    
    td, th{
        border:0.1px solid black;
    }
</style>
<body>
    <img src="{{asset('imagenes/1VerdeSF.png')}}" width="200" style="position:relative; right:20px; bottom:10px; ">
    <img src="{{asset('imagenes/1SERVICIOS_QA.png')}}" style="position:relative; left:100px;">

    <p style="position:relative;">Señores</p>
    <p style="position:relative; bottom:8px;"><b>EMPRESA</b></p>
    <p style="position:relative; bottom:16px;">NIT:</p>
    <p style="position:relative; bottom:24px;">Dirección:</p>
    <p style="position:relative; bottom:32px;">Municipio</p>
    <p style="position:relative; bottom:24px;"> <b>Ref.: notificación revisión salida dosímetros – RSD-OSL-QA-100001</b></p>
    <p style="position:relative; bottom:15px;">Cordial saludo,</p>

    <p style="position:relative; bottom:8px; text-align:justify;">La empresa cuenta con un programa de aseguramiento de la calidad del laboratorio de dosimetría personal (LDP). Por lo tanto, deseamos informarles que hemos llevado a cabo la revisión de los dosímetros enviados por ustedes a nuestro laboratorio. En este proceso, se garantiza que se cumplirán los siguientes criterios: i) la cantidad de dosímetros es la correcta; ii) la integridad de los holders y dosímetros está asegurada; iii) no haya contaminación de materiales radiactivos; iv) se ha verificado que el código del dosímetro y la información de la etiqueta están asociados para el período asignado.</p>
    <p style="position:relative; text-align:justify;">A continuación se listan los dosímetros revisados y sus observaciones:</p>     
    
    {{-- <p style="position:relative; top:-30px; text-align:justify;">QA POSITRON S.A.S le notifica a la institución @if(empty($empresa)){{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} con NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @else {{$empresa[0]->nombre_empresa}} con NIT: {{$empresa[0]->num_iden_empresa}}-{{$empresa[0]->DV}} @endif  que los dosímetros entregados han pasado por el proceso de verificación tanto de etiqueta, dosímetro y usuario final satisfactoriamente. A continuación, evidencia de la verificación: </p> --}}
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
    <br>
    <br>
    <p style="position:relative; top:-30px; text-align:justify;"> <b>OBSERVACIONES:</b> </p>
    <img src="{{asset('imagenes/FIRMADEDIEGOFINAL.png')}}" width="170" height="80" style="position:relative; top:400px;"> <br>
    <label style="position: relative; top:400px;">Diego Fernando Aponte Castañeda</label> <br>
    <label style="position: relative; top:400px;">Físico Médico</label> <br>
    <label style="position: relative; top:400px;">Director Técnico QA POSITRON S.A.S</label>

</body>