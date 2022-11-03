<style>
    *{
        margin: 0px;
    }
    
    .contenedor{
        width: 300px;
        /* height: 500px; */
        /* border: 2px solid blue; */
        
        
        margin: 0 auto;
        
        /*background-color: red; */
        justify-content: center;
    }
    .imgtorax{
        /* background-color:yellow; */
        width: 191px;
        height: 86px;
        margin: 10 auto;
        justify-content: center;
    }

    .img_torax{
        height: auto;
        width: auto;
        max-width: 191px;
        max-height: 86px;
        margin: 0 auto;
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
        bottom: 69px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: red; */
        width: 38px;
        text-align:left; 
    }
    .ultimodia_torax{
        position: relative; 
        bottom: 69px;
        left: 54px;
        font-size: 7px;
        font-family: Arial, Helvetica, sans-serif;
        /* background: blue; */
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
        margin: 10 auto;
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
        @foreach($trabajdosiasig as $trab)
            @if($trab->ubicacion == 'TORAX')
                <div class="imgtorax">
                    <img src="{{asset('imagenes/2TORAX.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    {{-- //////// TEXTO PARA EL DOSIMETRO TORAX ////////// --}}
                    <div class="nombre_torax" > <b>{{$trab->persona->primer_apellido_persona}} {{substr($trab->persona->segundo_apellido_persona, 0,1)}}, {{$trab->persona->primer_nombre_persona}}. CC. {{$trab->persona->cedula_persona}}</b> </div>
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_torax" >{{$contdosi->nombre_empresa}}</div>
                        <div class="sede_torax" >{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
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
                <div class="imgcristalino">
                    <img src="{{asset('imagenes/2CRISTALINO.png')}}" class="img_cristalino" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    {{-- //////// TEXTO PARA EL DOSIMETRO CRISTALINO ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_cristalino" >{{$contdosi->nombre_empresa}}</div>
                    @endforeach
                    <div class="nombre_cristalino"> <b>{{$trab->persona->primer_apellido_persona}} {{substr($trab->persona->segundo_apellido_persona, 0,1)}}, {{$trab->persona->primer_nombre_persona}} {{substr($trab->persona->segundo_nombre_persona, 0,1)}}</b> </div>
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
                <div class="imganillo">
                    <img src="{{asset('imagenes/2ANILLO.png')}}" class="img_anillo" style="border-width: 1px; border-style: dotted; border-color:black ; ">
                    {{-- //////// TEXTO PARA EL DOSIMETRO ANILLO ////////// --}}
                    @foreach($contratodosi as $contdosi)
                        <div class="empresa_anillo" >{{$contdosi->nombre_empresa}}</div>
                    @endforeach
                    <div class="nombre_anillo" > <b>{{$trab->persona->primer_apellido_persona}} {{substr($trab->persona->segundo_apellido_persona, 0,1)}}, {{$trab->persona->primer_nombre_persona}} {{substr($trab->persona->segundo_nombre_persona, 0,1)}}</b> </div>
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
        
    </div>
</body>