<style>
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
    .img{
        height: auto;
        width: auto;
        max-width: 191px;
        max-height: 86px;
    }
</style>

<body>
    @php
        $contadorTorax = 0;
        $contadorCristalino = 0;
        $contadorMuñeca = 0;
        $contadorAnillo = 0;
        foreach ($trabajdosiasig as $trabj) {
            if($trabj->ubicacion == 'TORAX'){
                $contadorTorax += 1; 
            }elseif($trabj->ubicacion == 'CRISTALINO'){
                $contadorCristalino += 1; 
            }elseif($trabj->ubicacion == 'MUÑECA'){
                $contadorMuñeca += 1; 
            }elseif($trabj->ubicacion == 'DEDO'){
                $contadorAnillo += 1; 
            }


        }
        
    @endphp
    @if($contadorTorax != 0)
        <div class="caja">
            <table style="position:absolute; top:0px; margin: 0 auto; border-collapse:collapse;" cellpadding="10">
                @php
                    
                    /* $contador = 5; */
                    $topTexto1 = 14;
                    $topTexto2 = 24;
                    $topTexto3 = 35;
                    $topTexto4 = 44;
                    $topFecha1 = 67;
                    $topFecha2 = 76;
                    $topCode = 43;
                    $left1 = 9;
                    $left2 = 220;
                    $left3 = 431;
                    $leftFecha1 = 60;
                    $leftFecha2 = 271;
                    $leftFecha3 = 482;
                    $leftCode1 = 154;
                    $leftCode2 = 365;
                    $leftCode3 = 576;
                @endphp

                @for($i=2; $i< $contadorTorax; $i=$i+3)
                    @if($i <= $contadorTorax)
                        <tr>
                            <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/2.png')}}"class="img" style="border:1px solid black;">
                            </td>
                            
                            <td style=" border:0.1px solid black; text-align:right;">
                                <img src="{{asset('imagenes/2.png')}}" class="img" style="border:1px solid black;">
                            </td>

                            <td style=" border:0.1px solid black; text-align:right;">
                                <img src="{{asset('imagenes/2.png')}}" class="img" style="border:1px solid black;">
                            </td>
                        </tr>
                        {{-- //////////////PARA LA 1 //////////////// --}}
                        <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$i-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-2]->persona->cedula_persona}}</div>
                        @foreach($contratodosi as $contdosi)
                            <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                            <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                        @endforeach
                        <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;">No. {{$trabajdosiasig[$i-2]->dosimetro->codigo_dosimeter}}</div>
                        @php
                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->primer_dia_uso));
                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->ultimo_dia_uso));
                        @endphp
                        <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                        <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                        <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                            @php
                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-2]->id_trabajadordosimetro, 'C39',1.5,13);
                            @endphp
                        </div> 

                        {{-- //////////////////////// PARA LA 2/////////// --}}
                        <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$i-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-1]->persona->cedula_persona}}</div>
                        @foreach($contratodosi as $contdosi)
                            <div class="texto" style="top:{{$topTexto2}}px; left: {{$left2}}px;">{{$contdosi->nombre_empresa}}</div>
                            <div class="texto" style="top:{{$topTexto3}}px; left: {{$left2}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                        @endforeach
                        <div class="texto" style="top:{{$topTexto4}}px; left: {{$left2}}px; font-size: 8px;">No. {{$trabajdosiasig[$i-1]->dosimetro->codigo_dosimeter}}</div>
                        @php
                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->primer_dia_uso));
                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->ultimo_dia_uso));
                        @endphp
                        <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha2}}px;">{{$datefix1}}</div>  
                        <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha2}}px;">{{$datefix2}}</div>
                        <div class="code" style="top:{{$topCode}}px; left:{{$leftCode2}}px;">
                            @php
                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-1]->id_trabajadordosimetro, 'C39',1.5,13);
                            @endphp
                        </div> 

                        {{-- ////////////PARA LA 3/////////////// --}}
                        <div class="texto" style="top:{{$topTexto1}}px; left:{{$left3}}px;">{{$trabajdosiasig[$i-0]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-0]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-0]->persona->cedula_persona}}</div>
                        @foreach($contratodosi as $contdosi)
                            <div class="texto" style="top:{{$topTexto2}}px; left: {{$left3}}px;">{{$contdosi->nombre_empresa}}</div>
                            <div class="texto" style="top:{{$topTexto3}}px; left: {{$left3}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                        @endforeach
                        <div class="texto" style="top:{{$topTexto4}}px; left: {{$left3}}px; font-size: 8px;">No. {{$trabajdosiasig[$i-0]->dosimetro->codigo_dosimeter}}</div>
                        @php
                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->primer_dia_uso));
                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->ultimo_dia_uso));
                        @endphp
                        <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha3}}px;">{{$datefix1}}</div>  
                        <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha3}}px;">{{$datefix2}}</div>
                        <div class="code" style="top:{{$topCode}}px; left:{{$leftCode3}}px;">
                            @php
                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-0]->id_trabajadordosimetro, 'C39',1.5,13);
                            @endphp
                        </div> 
                    @endif
                    @php
                        $topTexto1 = $topTexto1+107;
                        $topTexto2 = $topTexto2+107;
                        $topTexto3 = $topTexto3+107;
                        $topTexto4 = $topTexto4+107;
                        $topFecha1 = $topFecha1+107;
                        $topFecha2 = $topFecha2+107;
                        $topCode =   $topCode+107;
                    @endphp
                @endfor
                @if($contadorTorax %3 == 1)
                    <tr>
                        <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/2.png')}}" class="img" style="border:1px solid black;">
                        </td>    
                        <td></td>  
                        <td></td>          
                    </tr>

                    <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contadorTorax-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contadorTorax-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contadorTorax-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contadorTorax-1]->persona->cedula_persona}}</div> 
                    @foreach($contratodosi as $contdosi)
                        <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                        <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    @endforeach
                    <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;  ">No. {{$trabajdosiasig[$contadorTorax-1]->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contadorTorax-1]->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contadorTorax-1]->ultimo_dia_uso));
                    @endphp
                    <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                    <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                    <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                        @php
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contadorTorax-1]->id_trabajadordosimetro, 'C39',1.5,13);
                        @endphp
                    </div>
                    
                @elseif($contadorTorax %3 == 2)
                    <tr>
                        <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/2.png')}}" class="img" style="border:1px solid black;">
                        </td>    
                        <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/2.png')}}" class="img" style="border:1px solid black;">
                        </td> 
                        <td></td>          
                    </tr>
                    {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contador-2]->persona->primer_apellido_persona}}, {{$trabajdosiasig[$contador-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-2]->persona->cedula_persona}}</div> 
                    <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div> --}}
                    {{-- //////////////////////// PARA LA 2/////////// --}}
                    <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contadorTorax-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contadorTorax-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contadorTorax-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contadorTorax-2]->persona->cedula_persona}}</div>
                    @foreach($contratodosi as $contdosi)
                        <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                        <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    @endforeach
                    <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;">No. {{$trabajdosiasig[$contadorTorax-2]->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contadorTorax-2]->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contadorTorax-2]->ultimo_dia_uso));
                    @endphp
                    <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                    <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                    <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                        @php
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contadorTorax-2]->id_trabajadordosimetro, 'C39',1.5,13);
                        @endphp
                    </div> 

                    {{-- ////////////PARA LA 3/////////////// --}}
                    <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$contadorTorax-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contadorTorax-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contadorTorax-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contadorTorax-1]->persona->cedula_persona}}</div>
                    @foreach($contratodosi as $contdosi)
                        <div class="texto" style="top:{{$topTexto2}}px; left: {{$left2}}px;">{{$contdosi->nombre_empresa}}</div>
                        <div class="texto" style="top:{{$topTexto3}}px; left: {{$left2}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    @endforeach
                    <div class="texto" style="top:{{$topTexto4}}px; left: {{$left2}}px; font-size: 8px;  ">No. {{$trabajdosiasig[$contadorTorax-1]->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contadorTorax-1]->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contadorTorax-1]->ultimo_dia_uso));
                    @endphp
                    <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha2}}px;">{{$datefix1}}</div>  
                    <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha2}}px;">{{$datefix2}}</div>
                    <div class="code" style="top:{{$topCode}}px; left:{{$leftCode2}}px;">
                        @php
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contadorTorax-1]->id_trabajadordosimetro, 'C39',1.5,13);
                        @endphp
                    </div> 
                @endif
                
            </table> 
        </div>
    @endif
<br>
<br>
<br>
    @if($contadorCristalino != 0 )
        <div class="caja">
            <table style="position:absolute; top:0px; margin: 0 auto; border-collapse:collapse;" cellpadding="10">
                @php
                    
                    /* $contador = 5; */
                    /* $topTexto1 = 14;
                    $topTexto2 = 24;
                    $topTexto3 = 35;
                    $topTexto4 = 44;
                    $topFecha1 = 67;
                    $topFecha2 = 76;
                    $topCode = 43;
                    $left1 = 9;
                    $left2 = 220;
                    $left3 = 431;
                    $leftFecha1 = 60;
                    $leftFecha2 = 271;
                    $leftFecha3 = 482;
                    $leftCode1 = 154;
                    $leftCode2 = 365;
                    $leftCode3 = 576; */
                @endphp

                @for($i=2; $i< $contadorCristalino; $i=$i+3)
                    @if($i <= $contadorCristalino)
                        <tr>
                            <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/DOSIMETRIA ANILLO V3/2.png')}}"class="img" style="border:1px solid black;">
                            </td>
                            
                            <td style=" border:0.1px solid black; text-align:right;">
                                <img src="{{asset('imagenes/DOSIMETRIA ANILLO V3/2.png')}}" class="img" style="border:1px solid black;">
                            </td>

                            <td style=" border:0.1px solid black; text-align:right;">
                                <img src="{{asset('imagenes/DOSIMETRIA ANILLO V3/2.png')}}" class="img" style="border:1px solid black;">
                            </td>
                        </tr>
                        {{-- //////////////PARA LA 1 //////////////// --}}
                        {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$i-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-2]->persona->cedula_persona}}</div>
                        @foreach($contratodosi as $contdosi)
                            <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                            <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                        @endforeach
                        <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;">No. {{$trabajdosiasig[$i-2]->dosimetro->codigo_dosimeter}}</div>
                        @php
                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->primer_dia_uso));
                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-2]->ultimo_dia_uso));
                        @endphp
                        <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                        <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                        <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                            @php
                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-2]->id_trabajadordosimetro, 'C39',1.5,13);
                            @endphp
                        </div> --}} 

                        {{-- //////////////////////// PARA LA 2/////////// --}}
                        {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$i-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-1]->persona->cedula_persona}}</div>
                        @foreach($contratodosi as $contdosi)
                            <div class="texto" style="top:{{$topTexto2}}px; left: {{$left2}}px;">{{$contdosi->nombre_empresa}}</div>
                            <div class="texto" style="top:{{$topTexto3}}px; left: {{$left2}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                        @endforeach
                        <div class="texto" style="top:{{$topTexto4}}px; left: {{$left2}}px; font-size: 8px;">No. {{$trabajdosiasig[$i-1]->dosimetro->codigo_dosimeter}}</div>
                        @php
                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->primer_dia_uso));
                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-1]->ultimo_dia_uso));
                        @endphp
                        <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha2}}px;">{{$datefix1}}</div>  
                        <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha2}}px;">{{$datefix2}}</div>
                        <div class="code" style="top:{{$topCode}}px; left:{{$leftCode2}}px;">
                            @php
                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-1]->id_trabajadordosimetro, 'C39',1.5,13);
                            @endphp
                        </div>  --}}

                        {{-- ////////////PARA LA 3/////////////// --}}
                        {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left3}}px;">{{$trabajdosiasig[$i-0]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$i-0]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$i-0]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$i-0]->persona->cedula_persona}}</div>
                        @foreach($contratodosi as $contdosi)
                            <div class="texto" style="top:{{$topTexto2}}px; left: {{$left3}}px;">{{$contdosi->nombre_empresa}}</div>
                            <div class="texto" style="top:{{$topTexto3}}px; left: {{$left3}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                        @endforeach
                        <div class="texto" style="top:{{$topTexto4}}px; left: {{$left3}}px; font-size: 8px;">No. {{$trabajdosiasig[$i-0]->dosimetro->codigo_dosimeter}}</div>
                        @php
                            $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->primer_dia_uso));
                            $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$i-0]->ultimo_dia_uso));
                        @endphp
                        <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha3}}px;">{{$datefix1}}</div>  
                        <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha3}}px;">{{$datefix2}}</div>
                        <div class="code" style="top:{{$topCode}}px; left:{{$leftCode3}}px;">
                            @php
                                echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-0]->id_trabajadordosimetro, 'C39',1.5,13);
                            @endphp
                        </div>  --}}
                    @endif
                    {{-- @php
                        $topTexto1 = $topTexto1+107;
                        $topTexto2 = $topTexto2+107;
                        $topTexto3 = $topTexto3+107;
                        $topTexto4 = $topTexto4+107;
                        $topFecha1 = $topFecha1+107;
                        $topFecha2 = $topFecha2+107;
                        $topCode =   $topCode+107;
                    @endphp --}}
                @endfor
                @if($contadorCristalino %3 == 1)
                    <tr>
                        <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/DOSIMETRIA ANILLO V3/2.png')}}" class="img" style="border:1px solid black;">
                        </td>    
                        <td></td>  
                        <td></td>          
                    </tr>

                    {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contadorCristalino-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contadorCristalino-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contadorCristalino-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contadorCristalino-1]->persona->cedula_persona}}</div> 
                    @foreach($contratodosi as $contdosi)
                        <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                        <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    @endforeach
                    <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;  ">No. {{$trabajdosiasig[$contadorCristalino-1]->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contadorCristalino-1]->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contadorCristalino-1]->ultimo_dia_uso));
                    @endphp
                    <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                    <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                    <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                        @php
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contadorCristalino-1]->id_trabajadordosimetro, 'C39',1.5,13);
                        @endphp
                    </div> --}}
                    
                @elseif($contadorCristalino %3 == 2)
                    <tr>
                        <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/DOSIMETRIA ANILLO V3/2.png')}}" class="img" style="border:1px solid black;">
                        </td>    
                        <td style=" border:0.1px solid black; text-align:right;">
                            <img src="{{asset('imagenes/DOSIMETRIA ANILLO V3/2.png')}}" class="img" style="border:1px solid black;">
                        </td> 
                        <td></td>          
                    </tr>
                    {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contador-2]->persona->primer_apellido_persona}}, {{$trabajdosiasig[$contador-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-2]->persona->cedula_persona}}</div> 
                    <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div> --}}
                    {{-- //////////////////////// PARA LA 2/////////// --}}
                    {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contadorCristalino-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contadorCristalino-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contadorCristalino-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contadorCristalino-2]->persona->cedula_persona}}</div>
                    @foreach($contratodosi as $contdosi)
                        <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                        <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    @endforeach
                    <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;">No. {{$trabajdosiasig[$contadorCristalino-2]->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contadorCristalino-2]->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contadorCristalino-2]->ultimo_dia_uso));
                    @endphp
                    <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                    <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                    <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                        @php
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contadorCristalino-2]->id_trabajadordosimetro, 'C39',1.5,13);
                        @endphp
                    </div>  --}}

                    {{-- ////////////PARA LA 3/////////////// --}}
                    {{-- <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$contadorCristalino-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contadorCristalino-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contadorCristalino-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contadorCristalino-1]->persona->cedula_persona}}</div>
                    @foreach($contratodosi as $contdosi)
                        <div class="texto" style="top:{{$topTexto2}}px; left: {{$left2}}px;">{{$contdosi->nombre_empresa}}</div>
                        <div class="texto" style="top:{{$topTexto3}}px; left: {{$left2}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    @endforeach
                    <div class="texto" style="top:{{$topTexto4}}px; left: {{$left2}}px; font-size: 8px;  ">No. {{$trabajdosiasig[$contadorCristalino-1]->dosimetro->codigo_dosimeter}}</div>
                    @php
                        $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contadorCristalino-1]->primer_dia_uso));
                        $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contadorCristalino-1]->ultimo_dia_uso));
                    @endphp
                    <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha2}}px;">{{$datefix1}}</div>  
                    <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha2}}px;">{{$datefix2}}</div>
                    <div class="code" style="top:{{$topCode}}px; left:{{$leftCode2}}px;">
                        @php
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$contadorCristalino-1]->id_trabajadordosimetro, 'C39',1.5,13);
                        @endphp
                    </div>  --}}
                @endif
                
            </table> 
        </div>
    @endif

    
    
</body>