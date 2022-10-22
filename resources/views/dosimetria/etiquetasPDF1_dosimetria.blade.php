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
    .img{
       /*  background-color:yellow; */
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
</style>
<body>
    
    <div class="contenedor">
        @foreach($trabajdosiasig as $trab)
            <div class="img">
                <img src="{{asset('imagenes/2.png')}}" class="img_torax" style="border-width: 1px; border-style: dotted; border-color:black ; ">
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
        @endforeach
        
    </div>
</body>