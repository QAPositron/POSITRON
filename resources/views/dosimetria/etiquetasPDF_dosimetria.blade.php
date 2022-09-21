<style>
    *{
        margin: 0px;
    }
    .caja{
        position: relative;
        display: inline-block;
    }
    
    .texto{
        position: absolute;
        width: 170px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 8px;
        color: black;
        text-align:right; 
    }
    .fecha{
        position: absolute;
        width: 40px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 7px;
        color: black;
        text-align:center; 
    }
    
    .code{
        position: absolute;
        transform: rotate(-90deg);
    }
    .img_torax{
        height: auto;
        width: auto;
        max-width: 191px;
        max-height: 86px;
    }
    .img_cristalino{
        height: auto;
        width: auto;
        max-width: 236px;
        max-height: 43px;
    }
    .img_anillo{
        height: auto;
        width: auto;
        max-width: 236px;
        max-height: 43px;
    }
    .contenedor_torax{
        /* background: red; */
        width: 195px;
        height: 88px;
    }
    .contenedor_cristalino{
        /* background: red; */
        width: 240px;
        height: 45px;
    }
    .contenedor_anillo{
        /* background: red; */
        width: 240px;
        height: 45px;
    }
    .nombre_torax{
        position: relative; 
        bottom: 83px;
        right: 0px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 170px;
        text-align:right; 
    }
    .empresa_torax{
        position: relative; 
        bottom: 84px;
        left: 35px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 135px;
        text-align:right; 
    }
    .sede_torax{
        position: relative; 
        bottom: 85px;
        left: 35px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 135px;
        text-align:right; 
    }
    .codigo_torax{
        position: relative; 
        bottom: 85px;
        left: 35px;
        font-size: 8px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 135px;
        text-align:right; 
    }
    .primerdia_torax{
        position: relative; 
        bottom: 70px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 38px;
        text-align:left; 
    }
    .ultimodia_torax{
        position: relative; 
        bottom: 70px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 38px;
        text-align:left;
    }
    .codigobar_torax{
        transform: rotate(-90deg);
        position: relative; 
        bottom: 112px;
        left: 147px;
        /* background: yellow; */
        width: 70px;
    }
    td{
        height: 80px;
        /* background: orange; */
    }
    
    .empresa_cristalino, .empresa_anillo{
        position: relative; 
        bottom: 43px;
        left: 28px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: yellow; */
        width: 90px;
        text-align:center;
    }
    .nombre_cristalino, .nombre_anillo{
        position: relative; 
        bottom: 43px;
        left: 28px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 90px;
        text-align:center;
    }
    .cedula_cristalino, .cedula_anillo{
        position: relative; 
        bottom: 44px;
        left: 28px;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: violet; */
        width: 90px;
        text-align:center;
    }
    .codigo_cristalino, .codigo_anillo{
        position: relative; 
        bottom: 46px;
        left: 28px;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 90px;
        text-align:center;
    }
    .codigobar_cristalino, .codigobar_anillo{
        position: relative; 
        bottom: 61px;
        left: 40px;
        /* background: red; */
        width: 100px;
        text-align:center;
    }
    .codigobar_cristalino_hijo{
        /* position: relative; 
        bottom: 61px;
        width: 65px;*/
        position: absolute; 
        
        /* background: blue; */
        
    }
    .primerdia_cristalino, .primerdia_anillo{
        position: relative; 
        bottom: 61px;
        left: 122px;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 85px;
        text-align:center;
    }
    .ultimodia_cristalino, .ultimodia_anillo{
        position: relative; 
        bottom: 61px;
        left: 119px;
        font-size: 6px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
        width: 85px;
        text-align:center;
    }
</style>

<body>
    
    
        <div class="caja">
            <table style="position:absolute; top:0px; margin: 0 auto; border-collapse:collapse;" cellpadding="10">
                @php
                    
                    $contador = count($trabajdosiasig);
                    
                @endphp
                @for($i=2; $i< $contador; $i=$i+3)
                    
                    @if($i <= $contador)
                        <tr>
                            {{-- ////////PRIMERA CELDA ////////// --}}
                            <td style=" border:0.1px solid black; text-align:right;">
                                
                                @if($trabajdosiasig[$i-2]->ubicacion == 'TORAX')
                                    <div class="contenedor_torax">
                                        <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                                        <div class="nombre_torax" > <b>{{$trabajdosiasig[$i-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-2]->persona->cedula_persona}}</b> </div>
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                                            <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                                        @endforeach
                                        <div class="codigo_torax" >No. {{$trabajdosiasig[$i-2]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_torax" >{{$datefix1}}</div>  
                                        <div class="ultimodia_torax" >{{$datefix2}}</div>
                                        <div class="codigobar_torax">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-2]->id_trabajadordosimetro, 'C39',1.1,15);
                                            @endphp
                                        </div>
                                    </div>
                                @elseif($trabajdosiasig[$i-2]->ubicacion == 'CRISTALINO')
                                    <div class="contenedor_cristalino">
                                        <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "img_cristalino" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                                            {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                        @endforeach
                                        <div class="nombre_cristalino"> <b>{{$trabajdosiasig[$i-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-2]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                        <div class="cedula_cristalino">CC. {{$trabajdosiasig[$i-2]->persona->cedula_persona}}</div>
                                        <div class="codigo_cristalino" >No. {{$trabajdosiasig[$i-2]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_cristalino" >Inicia {{$datefix1}}</div> 
                                        <div class="ultimodia_cristalino" >Finaliza {{$datefix2}}</div>
                                        <div class="codigobar_cristalino">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-2]->id_trabajadordosimetro, 'C39',1,12);
                                            @endphp
                                        </div>
                                    </div>
                                @elseif($trabajdosiasig[$i-2]->ubicacion == 'ANILLO')
                                    <div class="contenedor_anillo">
                                        <img src="{{asset('imagenes/DOSIMETRIA_ANILLO_V3/2.png')}}" class= "img_anillo" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                                            {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                        @endforeach
                                        <div class="nombre_anillo"> <b>{{$trabajdosiasig[$i-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-2]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                        <div class="cedula_anillo">CC. {{$trabajdosiasig[$i-2]->persona->cedula_persona}}</div>
                                        <div class="codigo_anillo" >No. {{$trabajdosiasig[$i-2]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_anillo" >Inicia {{$datefix1}}</div> 
                                        <div class="ultimodia_anillo" >Finaliza {{$datefix2}}</div>
                                        <div class="codigobar_anillo">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-2]->id_trabajadordosimetro, 'C39',1,12);
                                            @endphp
                                        </div>
                                    </div>
                                @endif
                                    
                            </td>
                            {{-- ////////SEGUNDA CELDA ////////// --}}
                            <td style=" border:0.1px solid black; text-align:right;">
                                
                                @if($trabajdosiasig[$i-1]->ubicacion == 'TORAX')
                                    <div class="contenedor_torax">
                                        <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                                        <div class="nombre_torax"> <b> {{$trabajdosiasig[$i-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_apellido_persona, 0,1)}}. {{$trabajdosiasig[$i-1]->persona->primer_nombre_persona}}, CC.: {{$trabajdosiasig[$i-1]->persona->cedula_persona}}</b></div>
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                                            <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                                        @endforeach
                                        <div class="codigo_torax" >No. {{$trabajdosiasig[$i-1]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_torax" >{{$datefix1}}</div>
                                        <div class="ultimodia_torax" >{{$datefix2}}</div>
                                        <div class="codigobar_torax">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-1]->id_trabajadordosimetro, 'C39',1.1,15);
                                            @endphp
                                        </div>
                                    </div>
                                @elseif($trabajdosiasig[$i-1]->ubicacion == 'CRISTALINO')
                                    <div class="contenedor_cristalino">
                                        <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "img_cristalino" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                                            {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                        @endforeach
                                        <div class="nombre_cristalino"> <b>{{$trabajdosiasig[$i-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-1]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                        <div class="cedula_cristalino">CC. {{$trabajdosiasig[$i-1]->persona->cedula_persona}}</div>
                                        <div class="codigo_cristalino" >No. {{$trabajdosiasig[$i-1]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_cristalino" >Inicia {{$datefix1}}</div> 
                                        <div class="ultimodia_cristalino" >Finaliza {{$datefix2}}</div>
                                        <div class="codigobar_cristalino">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-1]->id_trabajadordosimetro, 'C39',1,12);
                                            @endphp
                                        </div>
                                    </div>
                                @elseif($trabajdosiasig[$i-1]->ubicacion == 'ANILLO')
                                    <div class="contenedor_anillo">
                                        <img src="{{asset('imagenes/DOSIMETRIA_ANILLO_V3/2.png')}}" class= "img_anillo" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                                            {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                        @endforeach
                                        <div class="nombre_anillo"> <b>{{$trabajdosiasig[$i-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-1]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                        <div class="cedula_anillo">CC. {{$trabajdosiasig[$i-1]->persona->cedula_persona}}</div>
                                        <div class="codigo_anillo" >No. {{$trabajdosiasig[$i-1]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_anillo" >Inicia {{$datefix1}}</div> 
                                        <div class="ultimodia_anillo" >Finaliza {{$datefix2}}</div>
                                        <div class="codigobar_anillo">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-1]->id_trabajadordosimetro, 'C39',1,12);
                                            @endphp
                                        </div>
                                    </div>
                                @endif
                                    
                                
                            </td>
                            {{-- ////////TERCERA CELDA ////////// --}}
                            <td style=" border:0.1px solid black; text-align:right;">
                                
                                @if($trabajdosiasig[$i-0]->ubicacion == 'TORAX')
                                    <div class="contenedor_torax">
                                        <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                                        <div class="nombre_torax"> <b> {{$trabajdosiasig[$i-0]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_apellido_persona, 0,1)}}. {{$trabajdosiasig[$i-0]->persona->primer_nombre_persona}}, CC.: {{$trabajdosiasig[$i-0]->persona->cedula_persona}}</b></div>
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                                            <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                                        @endforeach
                                        <div class="codigo_torax" >No. {{$trabajdosiasig[$i-0]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_torax" >{{$datefix1}}</div>
                                        <div class="ultimodia_torax" >{{$datefix2}}</div>
                                        <div class="codigobar_torax">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-0]->id_trabajadordosimetro, 'C39',1.1,15);
                                            @endphp
                                        </div>
                                    </div>
                                @elseif($trabajdosiasig[$i-0]->ubicacion == 'CRISTALINO')
                                    <div class="contenedor_cristalino" >
                                        <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "img_cristalino" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                                            {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                        @endforeach
                                        <div class="nombre_cristalino"> <b>{{$trabajdosiasig[$i-0]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-0]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                        <div class="cedula_cristalino">CC. {{$trabajdosiasig[$i-0]->persona->cedula_persona}}</div>
                                        <div class="codigo_cristalino" >No. {{$trabajdosiasig[$i-0]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_cristalino" >Inicia {{$datefix1}}</div> 
                                        <div class="ultimodia_cristalino" >Finaliza {{$datefix2}}</div>
                                        <div class="codigobar_cristalino">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-0]->id_trabajadordosimetro, 'C39',1,12);
                                            @endphp
                                        </div>
                                    </div>
                                @elseif($trabajdosiasig[$i-0]->ubicacion == 'ANILLO')
                                    <div class="contenedor_anillo" >
                                        <img src="{{asset('imagenes/DOSIMETRIA_ANILLO_V3/2.png')}}" class= "img_anillo" style="border:1px solid black;">
                                        {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                        @foreach($contratodosi as $contdosi)
                                            <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                                            {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                        @endforeach
                                        <div class="nombre_anillo"> <b>{{$trabajdosiasig[$i-0]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-0]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                        <div class="cedula_anillo">CC. {{$trabajdosiasig[$i-0]->persona->cedula_persona}}</div>
                                        <div class="codigo_anillo" >No. {{$trabajdosiasig[$i-0]->dosimetro->codigo_dosimeter}}</div>
                                        @php
                                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->primer_dia_uso));
                                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->ultimo_dia_uso));
                                        @endphp
                                        <div class="primerdia_anillo" >Inicia {{$datefix1}}</div> 
                                        <div class="ultimodia_anillo" >Finaliza {{$datefix2}}</div>
                                        <div class="codigobar_anillo">
                                            @php
                                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-0]->id_trabajadordosimetro, 'C39',1,12);
                                            @endphp
                                        </div>
                                    </div>
                                @endif
                                    
                            </td>
                        </tr>
                       
                        
                    @endif
                    
                @endfor
                
                @if($contador %3 == 1)
                    <tr>
                        
                        {{-- ////////PRIMERA CELDA ////////// --}}
                        <td style=" border:0.1px solid black; text-align:right;">
                                
                            @if($trabajdosiasig[$contador-1]->ubicacion == 'TORAX')
                                <div class="contenedor_torax">
                                    <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                                    <div class="nombre_torax" > <b>{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</b> </div>
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                                        <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                                    @endforeach
                                    <div class="codigo_torax" >No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_torax" >{{$datefix1}}</div>  
                                    <div class="ultimodia_torax" >{{$datefix2}}</div>
                                    <div class="codigobar_torax">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->id_trabajadordosimetro, 'C39',1.1,15);
                                        @endphp
                                    </div>
                                </div>
                            @elseif($trabajdosiasig[$contador-1]->ubicacion == 'CRISTALINO')
                                <div class="contenedor_cristalino">
                                    <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "img_cristalino" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                                        {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                    @endforeach
                                    <div class="nombre_cristalino"> <b>{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                    <div class="cedula_cristalino">CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div>
                                    <div class="codigo_cristalino" >No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_cristalino" >Inicia {{$datefix1}}</div> 
                                    <div class="ultimodia_cristalino" >Finaliza {{$datefix2}}</div>
                                    <div class="codigobar_cristalino">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->id_trabajadordosimetro, 'C39',1,12);
                                        @endphp
                                    </div>
                                </div>
                            @elseif($trabajdosiasig[$contador-1]->ubicacion == 'ANILLO')
                                <div class="contenedor_anillo">
                                    <img src="{{asset('imagenes/DOSIMETRIA_ANILLO_V3/2.png')}}" class= "img_anillo" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                                        {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                    @endforeach
                                    <div class="nombre_anillo"> <b>{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                    <div class="cedula_anillo">CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div>
                                    <div class="codigo_anillo" >No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_anillo" >Inicia {{$datefix1}}</div> 
                                    <div class="ultimodia_anillo" >Finaliza {{$datefix2}}</div>
                                    <div class="codigobar_anillo">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->id_trabajadordosimetro, 'C39',1,12);
                                        @endphp
                                    </div>
                                </div>
                            @endif
                                
                        </td> 
                        {{-- ////////SEGUNDA CELDA ////////// --}}
                        <td></td>  
                        {{-- ////////TERCERA CELDA ////////// --}}
                        <td></td>          
                    </tr>

                @elseif($contador %3 == 2)
                    <tr>
                        
                        {{-- ////////PRIMERA CELDA ////////// --}}
                        <td style=" border:0.1px solid black; text-align:right;">
                                
                            @if($trabajdosiasig[$contador-2]->ubicacion == 'TORAX')
                                <div class="contenedor_torax">
                                    <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                                    <div class="nombre_torax" > <b>{{$trabajdosiasig[$contador-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-2]->persona->cedula_persona}}</b> </div>
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                                        <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                                    @endforeach
                                    <div class="codigo_torax" >No. {{$trabajdosiasig[$contador-2]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_torax" >{{$datefix1}}</div>  
                                    <div class="ultimodia_torax" >{{$datefix2}}</div>
                                    <div class="codigobar_torax">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-2]->id_trabajadordosimetro, 'C39',1.1,15);
                                        @endphp
                                    </div>
                                </div>
                            @elseif($trabajdosiasig[$contador-2]->ubicacion == 'CRISTALINO')
                                <div class="contenedor_cristalino">
                                    <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "img_cristalino" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                                        {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                    @endforeach
                                    <div class="nombre_cristalino"> <b>{{$trabajdosiasig[$contador-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-2]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$contador-2]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                    <div class="cedula_cristalino">CC. {{$trabajdosiasig[$contador-2]->persona->cedula_persona}}</div>
                                    <div class="codigo_cristalino" >No. {{$trabajdosiasig[$contador-2]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_cristalino" >Inicia {{$datefix1}}</div> 
                                    <div class="ultimodia_cristalino" >Finaliza {{$datefix2}}</div>
                                    <div class="codigobar_cristalino">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-2]->id_trabajadordosimetro, 'C39',1,12);
                                        @endphp
                                    </div>
                                </div>
                            @elseif($trabajdosiasig[$contador-2]->ubicacion == 'ANILLO')
                                <div class="contenedor_anillo">
                                    <img src="{{asset('imagenes/DOSIMETRIA_ANILLO_V3/2.png')}}" class= "img_anillo" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                                        {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                    @endforeach
                                    <div class="nombre_anillo"> <b>{{$trabajdosiasig[$contador-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-2]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$contador-2]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                    <div class="cedula_anillo">CC. {{$trabajdosiasig[$contador-2]->persona->cedula_persona}}</div>
                                    <div class="codigo_anillo" >No. {{$trabajdosiasig[$contador-2]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_anillo" >Inicia {{$datefix1}}</div> 
                                    <div class="ultimodia_anillo" >Finaliza {{$datefix2}}</div>
                                    <div class="codigobar_anillo">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-2]->id_trabajadordosimetro, 'C39',1,12);
                                        @endphp
                                    </div>
                                </div>
                            @endif
                                
                        </td> 
                        {{-- ////////SEGUNDA CELDA ////////// --}}
                        <td style=" border:0.1px solid black; text-align:right;">
                                
                            @if($trabajdosiasig[$contador-1]->ubicacion == 'TORAX')
                                <div class="contenedor_torax">
                                    <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                                    <div class="nombre_torax"> <b> {{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}. {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}}, CC.: {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</b></div>
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                                        <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                                    @endforeach
                                    <div class="codigo_torax" >No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_torax" >{{$datefix1}}</div>
                                    <div class="ultimodia_torax" >{{$datefix2}}</div>
                                    <div class="codigobar_torax">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->id_trabajadordosimetro, 'C39',1.1,15);
                                        @endphp
                                    </div>
                                </div>
                            @elseif($trabajdosiasig[$contador-1]->ubicacion == 'CRISTALINO')
                                <div class="contenedor_cristalino">
                                    <img src="{{asset('imagenes/DOSIMETRIA_CRISTALINO_V3/2.png')}}" class= "img_cristalino" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                                        {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                    @endforeach
                                    <div class="nombre_cristalino"> <b>{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                    <div class="cedula_cristalino">CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div>
                                    <div class="codigo_cristalino" >No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_cristalino" >Inicia {{$datefix1}}</div> 
                                    <div class="ultimodia_cristalino" >Finaliza {{$datefix2}}</div>
                                    <div class="codigobar_cristalino">

                                        @php
                                            echo "<div class='codigobar_cristalino_hijo'>";
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->id_trabajadordosimetro, 'C39',1,12);
                                            echo "</div>";
                                        @endphp
                                        
                                    </div>
                                </div>
                            @elseif($trabajdosiasig[$contador-1]->ubicacion == 'ANILLO')
                                <div class="contenedor_anillo">
                                    <img src="{{asset('imagenes/DOSIMETRIA_ANILLO_V3/2.png')}}" class= "img_anillo" style="border:1px solid black;">
                                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                                    @foreach($contratodosi as $contdosi)
                                        <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                                        {{-- <div class="sede_cristalino" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div> --}}
                                    @endforeach
                                    <div class="nombre_anillo"> <b>{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_nombre_persona, 0,1)}}</b> </div>
                                    <div class="cedula_anillo">CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div>
                                    <div class="codigo_anillo" >No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                                    @php
                                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                                    @endphp
                                    <div class="primerdia_anillo" >Inicia {{$datefix1}}</div> 
                                    <div class="ultimodia_anillo" >Finaliza {{$datefix2}}</div>
                                    <div class="codigobar_anillo">
                                        @php
                                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->id_trabajadordosimetro, 'C39',1,12);
                                        @endphp
                                    </div>
                                </div>
                            @endif
                                
                        </td>
                        {{-- ////////TERCERA CELDA ////////// --}}
                        <td></td>          
                    </tr>
                    
                @endif
                
            </table> 
        </div>
    
    
                
            
    

    
    
</body>