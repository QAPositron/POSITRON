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
            <p style="position:relative;"> <b>Ref.: notificación de novedades en dosímetros – R-OSL-QA- 
                @php 
                    date_default_timezone_set('America/Bogota');
                    echo date("Y").date("m").date("d").date("H").date("i").date("s"); 
                @endphp</b>
            </p>
            <br>
            <p style="position:relative;">Cordial saludo,</p>
            <br>
            {{-- <p style="position:relative; text-align:justify;">La empresa cuenta con un programa de aseguramiento de la calidad del laboratorio de dosimetría personal (LDP). Por lo tanto, deseamos informarles que hemos llevado a cabo la revisión de los dosímetros antes del envío a sus instalaciones, en este proceso garantizamos que la cantidad dosímetros sea la correcta y que el número del dosímetro con la información de la etiqueta se encuentren asociados para el periodo asignado.</p>
            <br> --}}
            <p style="position:relative; text-align:justify;">A continuación se describen las novedades por el codigo en nuestro sistema de informacíon:</p>
            <br>  
            <table style=" margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; font-size:9px;" cellpadding="4">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 15%;">TRABAJADOR</th>
                        <th rowspan="2">DOSÍMETRO</th>
                        <th rowspan="2">HOLDER</th>
                        <th rowspan="2">UBICACIÓN</th>
                        <th rowspan="2">PERÍODO</th>
                        <th rowspan="2">CONTRATO</th>
                        <th rowspan="2">SEDE</th>
                        <th rowspan="2">ESPECIALIDAD</th>
                        <th colspan="2">PERIODO DE USO</th>
                    </tr>
                    <tr>
                        <th>PRIMER DÍA</th>
                        <th>ÚLTIMO DÍA</th>
                    </tr>
                </thead>
                
            </table>
            <br>
            <br>
            <p style="position:relative; text-align:justify;">En caso de encontrar inconsistencias en la información, por favor hacerla llegar vía correo electrónico indicando el número  (R) del presente documento al correo: <label style="color:#1A9980;">dosimetría.qapositron@gmail.com.</label> </p>
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
            {{-- <div style="position:relative; display:block;  page-break-inside: avoid;">
                <p style="position:relative; display:block; top:15px;">Quien revisa la llegada de los dosímetros a la instalación:</p>
                <div style="position:relative; width: 200px; height: 95px; top:45px; page-break-inside: avoid; ">
                    <p style="position: relative; text-align: center;">_____________________________</p> <br>
                    <p style="position: relative; bottom: 17px; text-align: center; font-size: 11px; color:#1A9980;">@php if(count($trabjEncargado) == 0){echo "**Nombre del responsable**"; }else{ echo $trabjEncargado[0]->primer_nombre_persona." ".$trabjEncargado[0]->segundo_nombre_persona." ".$trabjEncargado[0]->primer_apellido_persona." ".$trabjEncargado[0]->segundo_apellido_persona ;}@endphp </p> <br>
                    <p style="position: relative; bottom: 35px; text-align: center; font-size: 11px; ">Responsable de recibir la dosimetría</p> <br>
                </div>
            </div> --}}
        </div>
    </main>
</body>