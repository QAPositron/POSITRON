<style>
    
    @page{
        
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: 5px;
        margin-right: 5px;
        
    }
    body{
        padding:0px; 
       /*  background-color: aqua; */
    }
    .contenedor{
        width: 300px;
        height: 740px;
        padding-top:20px;
        /* border: 2px solid blue; */
       
        margin: 0 auto;
       
        justify-content: center;
    }
    .imgtorax{
        /* background-color:yellow; */
        width: 191px;
        height: 86px;
        margin: 0 auto;
        justify-content: center;
    }

    .img_torax{
        height: auto;
        width: auto;
        max-width: 191px;
        max-height: 86px;
        margin: 0 auto;
    }
    
    .num_iden_cont_torax{
        position: relative; 
        bottom: 81px;
        right: 0px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 170px;
        text-align:right;
    }
    .empresa_cont_torax{
        position: relative; 
        bottom: 82px;
        left: 28px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 142px;
        text-align:right;
    }
    .sede_cont_torax{
        position: relative; 
        bottom: 83px;
        left: 28px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /*background: blue; */
        width: 142px;
        text-align:right; 
    }.codigo_cont_torax{
        position: relative; 
        bottom: 84px;
        left: 35px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 135px;
        text-align:right;
    }
    .primerdia_cont_torax{
        position: relative; 
        bottom: 78px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 38px;
        text-align:left; 
    }
    .ultimodia_cont_torax{
        position: relative; 
        bottom: 76px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 38px;
        text-align:left;
    }
    .codigobar_cont_torax{
        transform: rotate(-270deg);
        position: relative; 
        bottom: 107px;
        left: 147px;
        /* background: yellow; */
        width: 70px;
    }
    .empresa_cont_cristalino, .empresa_cont_anillo{
        position: relative; 
        bottom: 34px;
        left: 8px;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 100px;
        /* text-align:right;  */
    }
    .num_iden_cont_cristalino, .num_iden_cont_anillo{
        position: relative; 
        bottom: 30px;
        left: 8px;
        font-size: 5px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 60px;
        /* text-align:right;  */
    }
    .codigo_cont_cristalino, .codigo_cont_anillo{
        position: relative; 
        bottom: 31px;
        left: 8px;
        font-size: 5px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 60px;
        /* text-align:right;  */
    }
    .primerdia_cont_cristalino, .primerdia_cont_anillo{
        position: relative; 
        bottom: 53px;
        left:150px;
        font-size: 5px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 35px;
        /* text-align:left; */
    }
    .ultimodia_cont_cristalino, .ultimodia_cont_anillo{
        position: relative; 
        bottom: 53px;
        left:150px;
        font-size: 5px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 35px;
        /* text-align:left; */
    }
    .codigobar_cont_cristalino, .codigobar_cont_anillo{
        position: relative; 
        bottom: 52px;
        left: 123px; 
        /* background: orange; */
        width: 75px;
   }
    .nombre_torax{
        position: relative; 
        bottom: 83px;
        right: 0px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background:yellow; */
        width: 170px;
        text-align:right; 
    }
    .empresa_torax{
        position: relative; 
        bottom: 84px;
        left: 28px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /*background: yellow;*/
        width: 142px;
        text-align:right; 
    }
    .sede_torax{
        position: relative; 
        bottom: 85px;
        left: 28px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /*background: blue;*/
        width: 142px;
        text-align:right; 
    }
    .codigo_torax{
        position: relative; 
        bottom: 85px;
        left: 35px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 135px;
        text-align:right; 
    }
    .primerdia_torax, .ultimodia_torax{
        position: relative; 
        bottom: 79px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 38px;
        text-align:left; 
    }
    
    .codigobar_torax{
        transform: rotate(-270deg);
        position: relative; 
        bottom: 107px;
        left: 147px;
        /* background: yellow; */
        width: 70px;
    }
    .imgcristalino, .imganillo{
        /* background-color:red; */
        width: 236px;
        height: 43px;
        margin: 0 auto;
        justify-content: center;
    }
    .img_cristalino, .img_anillo{
        height: auto;
        width: auto;
        max-width: 236px;
        max-height: 43px;
        margin: 0 auto;
    }
    .empresa_cristalino, .empresa_anillo{
        position: relative; 
        bottom: 35px;
        left: 5px;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 100px;
        /* text-align:right;  */
    }
    .nombre_cristalino, .cedula_cristalino, .codigo_cristalino, .nombre_anillo, .cedula_anillo, .codigo_anillo{
        position: relative; 
        bottom: 35px;
        left: 5px;
        font-size: 5px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 60px;
        /* text-align:right;  */
    }
    .primerdia_cristalino, .ultimodia_cristalino, .primerdia_anillo, .ultimodia_anillo{
        position: relative; 
        bottom: 59px;
        left:150px;
        font-size: 5px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 35px;
        /* text-align:left; */
    }
   .codigobar_cristalino, .codigobar_anillo{
        position: relative; 
        bottom: 57px;
        left: 123px; 
        /* background: orange; */
        width: 75px;
   }
</style>
<body>
    
    <div class="contenedor">
        @foreach($dosicontrolasig as $dosicont)
            @if($dosicont->ubicacion == 'TORAX')
                {{-- //////// DOSIMETRO CONTROL TORAX ////////// --}}
                <div class="imgtorax" style="page-break-inside: avoid;">
                    @php
                        $fecha = strtotime($dosicont->primer_dia_uso);
                        $mes = date("n", $fecha);
                    @endphp
                    @if($mes == 1 || $mes == 7)
                        <img src="{{asset('imagenes/IMG_CONTROL_TORAX/CONT_TORAXM1.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 2 || $mes == 8)
                        <img src="{{asset('imagenes/IMG_CONTROL_TORAX/CONT_TORAXM2.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 3 || $mes == 9)
                        <img src="{{asset('imagenes/IMG_CONTROL_TORAX/CONT_TORAXM3.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 4 || $mes == 10)
                        <img src="{{asset('imagenes/IMG_CONTROL_TORAX/CONT_TORAXM4.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 5 || $mes == 11)
                        <img src="{{asset('imagenes/IMG_CONTROL_TORAX/CONT_TORAXM5.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 6 || $mes == 12)
                        <img src="{{asset('imagenes/IMG_CONTROL_TORAX/CONT_TORAXM6.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @endif
                    {{-- //////// TEXTO PARA EL DOSIMETRO CONTROL TORAX ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="num_iden_cont_torax" > @if($contdosi->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') <b>CC. {{$contdosi->num_iden_empresa}}</b> @endif <b>NIT. {{$contdosi->num_iden_empresa}}-{{$contdosi->DV}}</b></div>
                        <div class="empresa_cont_torax" >{{mb_substr($contdosi->nombre_empresa, 0, 26, "UTF-8")}}</div>
                        <div class="sede_cont_torax" >{{mb_substr($contdosi->nombre_sede, 0, 15, "UTF-8")}} - ESP: {{mb_substr($contdosi->nombre_departamento, 0,9,"UTF-8")}}</div>
                    @endforeach
                    <div class="codigo_cont_torax" >No. {{$dosicont->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($dosicont->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($dosicont->ultimo_dia_uso));
                    @endphp
                    <div class="primerdia_cont_torax" >{{$datefix1}}</div>  
                    <div class="ultimodia_cont_torax" >{{$datefix2}}</div>
                    <div class="codigobar_cont_torax">
                        @php
                            echo DNS1D::getBarcodeHTML($dosicont->dosimetro->codigo_dosimeter, 'C128',0.7,10);
                        @endphp
                    </div>
                </div>
            @elseif($dosicont->ubicacion == 'CRISTALINO')
                {{-- //////// DOSIMETRO CONTROL CRISTALINO ////////// --}}
                <div class="imgcristalino" style="page-break-inside: avoid;">
                    @php
                        $fecha = strtotime($dosicont->primer_dia_uso);
                        $mes = date("n", $fecha);
                    @endphp
                    @if($mes == 1 || $mes == 7)
                        <img src="{{asset('imagenes/IMG_CONTROL_CRISTALINO/CONT_CRISTALINOM1.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 2 || $mes == 8)
                        <img src="{{asset('imagenes/IMG_CONTROL_CRISTALINO/CONT_CRISTALINOM2.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 3 || $mes == 9)
                        <img src="{{asset('imagenes/IMG_CONTROL_CRISTALINO/CONT_CRISTALINOM3.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 4 || $mes == 10)
                        <img src="{{asset('imagenes/IMG_CONTROL_CRISTALINO/CONT_CRISTALINOM4.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 5 || $mes == 11)
                        <img src="{{asset('imagenes/IMG_CONTROL_CRISTALINO/CONT_CRISTALINOM5.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 6 || $mes == 12)
                        <img src="{{asset('imagenes/IMG_CONTROL_CRISTALINO/CONT_CRISTALINOM6.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @endif
                    {{-- //////// TEXTO PARA EL DOSIMETRO CONTROL CRISTALINO ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_cont_cristalino" >{{mb_substr($contdosi->nombre_empresa, 0, 26, "UTF-8")}}</div>
                        <div class="num_iden_cont_cristalino">@if($contdosi->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') CC. {{$contdosi->num_iden_empresa}} @endif NIT. {{$contdosi->num_iden_empresa}}-{{$contdosi->DV}}</div>
                    @endforeach
                        <div class="codigo_cont_cristalino" >No. {{$dosicont->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($dosicont->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($dosicont->ultimo_dia_uso));
                    @endphp
                    <div class="primerdia_cont_cristalino" >{{$datefix1}}</div>  
                    <div class="ultimodia_cont_cristalino" >{{$datefix2}}</div>
                    <div class="codigobar_cont_cristalino">
                        @php
                            echo DNS1D::getBarcodeHTML($dosicont->dosimetro->codigo_dosimeter, 'C128',0.9,8);
                        @endphp
                    </div>
                </div>
            @elseif($dosicont->ubicacion == 'ANILLO')
                {{-- //////// DOSIMETRO CONTROL ANILLO ////////// --}}
                <div class="imganillo" style="page-break-inside: avoid;">
                    @php
                        $fecha = strtotime($dosicont->primer_dia_uso);
                        $mes = date("n", $fecha);
                    @endphp
                    @if($mes == 1 || $mes == 7)
                        <img src="{{asset('imagenes/IMG_CONTROL_ANILLO/CONT_ANILLOM1.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 2 || $mes == 8)
                        <img src="{{asset('imagenes/IMG_CONTROL_ANILLO/CONT_ANILLOM2.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 3 || $mes == 9)
                        <img src="{{asset('imagenes/IMG_CONTROL_ANILLO/CONT_ANILLOM3.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 4 || $mes == 10)
                        <img src="{{asset('imagenes/IMG_CONTROL_ANILLO/CONT_ANILLOM4.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 5 || $mes == 11)
                        <img src="{{asset('imagenes/IMG_CONTROL_ANILLO/CONT_ANILLOM5.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 6 || $mes == 12)
                        <img src="{{asset('imagenes/IMG_CONTROL_ANILLO/CONT_ANILLOM6.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @endif
                    {{-- //////// TEXTO PARA EL DOSIMETRO CONTROL ANILLO ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_cont_anillo" >{{mb_substr($contdosi->nombre_empresa, 0, 26, "UTF-8")}}</div>
                        <div class="num_iden_cont_anillo">@if($contdosi->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') CC. {{$contdosi->num_iden_empresa}} @endif NIT. {{$contdosi->num_iden_empresa}}-{{$contdosi->DV}}</div>
                    @endforeach
                    <div class="codigo_cont_anillo" >No. {{$dosicont->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($dosicont->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($dosicont->ultimo_dia_uso));
                    @endphp
                    <div class="primerdia_cont_anillo" >{{$datefix1}}</div>  
                    <div class="ultimodia_cont_anillo" >{{$datefix2}}</div>
                    <div class="codigobar_cont_anillo">
                        @php
                            echo DNS1D::getBarcodeHTML($dosicont->dosimetro->codigo_dosimeter, 'C128',0.9,8);
                        @endphp
                    </div>
                </div>
            @endif
        @endforeach
        @foreach($trabajdosiasig as $trab)
            @if($trab->ubicacion == 'TORAX')
                {{-- //////// DOSIMETRO TORAX ////////// --}}
                <div class="imgtorax" style="page-break-inside: avoid;">
                    @php
                        $fecha = strtotime($trab->primer_dia_uso);
                        $mes = date("n", $fecha);
                    @endphp
                    @if($mes== 1 || $mes == 7)
                        <img src="{{asset('imagenes/IMG_TORAX/TORAXM1.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 2 || $mes == 8)
                        <img src="{{asset('imagenes/IMG_TORAX/TORAXM2.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 3 || $mes == 9)
                        <img src="{{asset('imagenes/IMG_TORAX/TORAXM3.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 4 || $mes == 10)
                        <img src="{{asset('imagenes/IMG_TORAX/TORAXM4.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 5 || $mes == 11)
                        <img src="{{asset('imagenes/IMG_TORAX/TORAXM5.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 6 || $mes == 12)
                        <img src="{{asset('imagenes/IMG_TORAX/TORAXM6.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @endif

                    {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                    <div class="nombre_torax" > <b>{{$trab->persona->primer_apellido_persona}} {{mb_substr($trab->persona->segundo_apellido_persona, 0,1, "UTF-8")}}, {{$trab->persona->primer_nombre_persona}}. CC. {{$trab->persona->cedula_persona}}</b> </div>
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_torax" >{{mb_substr($contdosi->nombre_empresa, 0,26,"UTF-8")}}</div>
                        <div class="sede_torax" >{{mb_substr($contdosi->nombre_sede, 0, 15,"UTF-8")}} - ESP: {{mb_substr($contdosi->nombre_departamento, 0, 9,"UTF-8")}}</div>
                    @endforeach
                    <div class="codigo_torax" >No. {{$trab->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trab->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trab->ultimo_dia_uso));
                    @endphp
                    <div class="primerdia_torax" >{{$datefix1}}</div>  
                    <div class="ultimodia_torax" >{{$datefix2}}</div>
                    <div class="codigobar_torax">
                        @php
                            echo DNS1D::getBarcodeHTML($trab->dosimetro->codigo_dosimeter, 'C128',0.7,10);
                        @endphp
                    </div>
                </div>
            @elseif($trab->ubicacion == 'CRISTALINO')
                {{-- //////// DOSIMETRO CRISTALINO ////////// --}}
                <div class="imgcristalino" style="page-break-inside: avoid;">
                    @php
                        $fecha = strtotime($trab->primer_dia_uso);
                        $mes = date("n", $fecha);
                    @endphp
                    @if($mes == 1 || $mes == 7)
                        <img src="{{asset('imagenes/IMG_CRISTALINO/CRISTALINOM1.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 2 || $mes == 8)
                        <img src="{{asset('imagenes/IMG_CRISTALINO/CRISTALINOM2.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 3 || $mes == 9)
                        <img src="{{asset('imagenes/IMG_CRISTALINO/CRISTALINOM3.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mesn == 4 || $mes == 10)
                        <img src="{{asset('imagenes/IMG_CRISTALINO/CRISTALINOM4.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 5 || $mes == 11)
                        <img src="{{asset('imagenes/IMG_CRISTALINO/CRISTALINOM5.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 6 || $mes == 12)
                        <img src="{{asset('imagenes/IMG_CRISTALINO/CRISTALINOM6.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @endif
                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_cristalino" >{{substr($contdosi->nombre_empresa, 0, 26)}}</div>
                    @endforeach
                    <div class="nombre_cristalino"> <b>{{$trab->persona->primer_apellido_persona}} {{mb_substr($trab->persona->segundo_apellido_persona, 0,1,"UTF-8")}}, {{$trab->persona->primer_nombre_persona}} {{mb_substr($trab->persona->segundo_nombre_persona, 0,1,"UTF-8")}}</b> </div>
                    <div class="cedula_cristalino">CC. {{$trab->persona->cedula_persona}}</div>
                    <div class="codigo_cristalino" >No. {{$trab->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trab->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trab->ultimo_dia_uso));
                    @endphp
                    <div class="primerdia_cristalino" >{{$datefix1}}</div>  
                    <div class="ultimodia_cristalino" >{{$datefix2}}</div>
                    <div class="codigobar_cristalino">
                        @php
                            echo DNS1D::getBarcodeHTML($trab->dosimetro->codigo_dosimeter, 'C128',0.9,8);
                        @endphp
                    </div> 
                </div>
            @elseif($trab->ubicacion == 'ANILLO')
                {{-- //////// DOSIMETRO ANILLO ////////// --}}
                <div class="imganillo" style="page-break-inside: avoid;">
                    @php
                        $fecha = strtotime($trab->primer_dia_uso);
                        $mes = date("n", $fecha);
                    @endphp
                    @if($mes == 1 || $mes == 7)
                        <img src="{{asset('imagenes/IMG_ANILLO/ANILLOM1.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 2 || $mes == 8)
                        <img src="{{asset('imagenes/IMG_ANILLO/ANILLOM2.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 3 || $mes == 9)
                        <img src="{{asset('imagenes/IMG_ANILLO/ANILLOM3.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 4 || $mes == 10)
                        <img src="{{asset('imagenes/IMG_ANILLO/ANILLOM4.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 5 || $mes == 11)
                        <img src="{{asset('imagenes/IMG_ANILLO/ANILLOM5.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @elseif($mes == 6 || $mes == 12)
                        <img src="{{asset('imagenes/IMG_ANILLO/ANILLOM6.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    @endif
                    {{-- //////// TEXTO PARA EL DOSIMETRO ANILLO ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_anillo" >{{mb_substr($contdosi->nombre_empresa, 0, 26,"UTF-8")}}</div>
                    @endforeach
                    <div class="nombre_anillo" > <b>{{$trab->persona->primer_apellido_persona}} {{mb_substr($trab->persona->segundo_apellido_persona, 0,1,"UTF-8")}}, {{$trab->persona->primer_nombre_persona}} {{mb_substr($trab->persona->segundo_nombre_persona, 0,1,"UTF-8")}}</b> </div>
                    <div class="cedula_anillo">CC. {{$trab->persona->cedula_persona}}</div>
                    <div class="codigo_anillo" >No. {{$trab->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trab->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trab->ultimo_dia_uso));
                    @endphp
                    <div class="primerdia_anillo" >{{$datefix1}}</div>  
                    <div class="ultimodia_anillo" >{{$datefix2}}</div>
                    <div class="codigobar_anillo">
                        @php
                            echo DNS1D::getBarcodeHTML($trab->dosimetro->codigo_dosimeter, 'C128',0.9,8);
                        @endphp
                    </div>
                </div>
            @endif
        @endforeach
        @foreach($areadosiasig as $area)
            {{-- //////// DOSIMETRO TORAX ////////// --}}
            <div class="imgtorax" style="page-break-inside: avoid;">
                @php
                    $fecha = strtotime($area->primer_dia_uso);
                    $mes = date("n", $fecha);
                @endphp
                @if($mes == 1 || $mes == 7)
                    <img src="{{asset('imagenes/IMG_AREA/AMBIENTALM1.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                @elseif($mes == 2 || $mes == 8)
                    <img src="{{asset('imagenes/IMG_AREA/AMBIENTALM2.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                @elseif($mes == 3 || $mes == 9)
                    <img src="{{asset('imagenes/IMG_AREA/AMBIENTALM3.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                @elseif($mes == 4 || $mes == 10)
                    <img src="{{asset('imagenes/IMG_AREA/AMBIENTALM4.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                @elseif($mes == 5 || $mes == 11)
                    <img src="{{asset('imagenes/IMG_AREA/AMBIENTALM5.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                @elseif($mes == 6 || $mes == 12)
                    <img src="{{asset('imagenes/IMG_AREA/AMBIENTALM6.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                @endif

                @foreach($contratodosi as $contdosi)
                    {{-- <div class="nom_area">{{$area->areadepartamentosede->nombre_area}}</div> --}}
                    <div class="num_iden_cont_torax" > @if($contdosi->tipo_identificacion_empresa == 'CÉDULA DE CIUDADANIA') <b>CC. {{$contdosi->num_iden_empresa}}</b> @endif <b>{{$area->areadepartamentosede->nombre_area}} &nbsp; &nbsp; NIT. {{$contdosi->num_iden_empresa}}-{{$contdosi->DV}}</b></div>
                    <div class="empresa_cont_torax" >{{mb_substr($contdosi->nombre_empresa, 0, 26,"UTF-8")}}</div>
                    <div class="sede_cont_torax" >{{mb_substr($contdosi->nombre_sede, 0, 15,"UTF-8")}} - ESP: {{mb_substr($contdosi->nombre_departamento, 0, 9,"UTF-8")}}</div>
                @endforeach
                <div class="codigo_cont_torax" >No. {{$area->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d/m/Y',strtotime($area->primer_dia_uso));
                    $datefix2 = date('d/m/Y',strtotime($area->ultimo_dia_uso));
                @endphp
                <div class="primerdia_cont_torax" >{{$datefix1}}</div>  
                <div class="ultimodia_cont_torax" >{{$datefix2}}</div>
                <div class="codigobar_cont_torax">
                    @php
                        echo DNS1D::getBarcodeHTML($area->dosimetro->codigo_dosimeter, 'C128',0.7,10);
                    @endphp
                </div>
            </div>
        @endforeach
    </div>
</body>