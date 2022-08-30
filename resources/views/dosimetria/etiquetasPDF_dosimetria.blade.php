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
    
    <div class="caja">

        <table style="position:absolute; top:0px; margin: 0 auto; border-collapse:collapse;" cellpadding="10">
            @php
                $contador = count($trabajdosiasig); 
                /* $contador = 5; */
                $topTexto1 = 14;
                $topTexto2 = 24;
                $topTexto3 = 35;
                $topTexto4 = 44;
                $topFecha1 = 67;
                $topFecha2 = 76;
                $topCode = 46;
                $left1 = 9;
                $left2 = 220;
                $left3 = 431;
                $leftFecha1 = 60;
                $leftFecha2 = 271;
                $leftFecha3 = 482;
                $leftCode1 = 149;
                $leftCode2 = 360;
                $leftCode3 = 580;
            @endphp

            @for($i=2; $i< $contador; $i=$i+3)
                @if($i <= $contador)
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
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-2]->dosimetro->codigo_dosimeter, 'C128',0.8,15);
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
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-1]->dosimetro->codigo_dosimeter, 'C128',0.8,15);
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
                            echo DNS1D::getBarcodeHTML($trabajdosiasig[$i-0]->dosimetro->codigo_dosimeter, 'C128',0.8,15);
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
            @if($contador %3 == 1)
                <tr>
                    <td style=" border:0.1px solid black; text-align:right;">
                        <img src="{{asset('imagenes/2.png')}}" class="img" style="border:1px solid black;">
                    </td>    
                    <td></td>  
                    <td></td>          
                </tr>

                <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div> 
                @foreach($contratodosi as $contdosi)
                    <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                    <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                @endforeach
                <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;  ">No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                    $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                @endphp
                <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                    @php
                        echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter, 'C128',0.8,15);
                    @endphp
                </div>
                
            @elseif($contador %3 == 2)
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
                <div class="texto" style="top:{{$topTexto1}}px; left:{{$left1}}px;">{{$trabajdosiasig[$contador-2]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-2]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-2]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-2]->persona->cedula_persona}}</div>
                @foreach($contratodosi as $contdosi)
                    <div class="texto" style="top:{{$topTexto2}}px; left: {{$left1}}px;">{{$contdosi->nombre_empresa}}</div>
                    <div class="texto" style="top:{{$topTexto3}}px; left: {{$left1}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                @endforeach
                <div class="texto" style="top:{{$topTexto4}}px; left: {{$left1}}px; font-size: 8px;">No. {{$trabajdosiasig[$contador-2]->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->primer_dia_uso));
                    $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-2]->ultimo_dia_uso));
                @endphp
                <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha1}}px;">{{$datefix1}}</div>  
                <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha1}}px;">{{$datefix2}}</div>
                <div class="code" style="top:{{$topCode}}px; left:{{$leftCode1}}px;">
                    @php
                        echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-2]->dosimetro->codigo_dosimeter, 'C128',0.8,15);
                    @endphp
                </div> 

                {{-- ////////////PARA LA 3/////////////// --}}
                <div class="texto" style="top:{{$topTexto1}}px; left:{{$left2}}px;">{{$trabajdosiasig[$contador-1]->persona->primer_apellido_persona}} {{substr($trabajdosiasig[$contador-1]->persona->segundo_apellido_persona, 0,1)}}, {{$trabajdosiasig[$contador-1]->persona->primer_nombre_persona}}. CC. {{$trabajdosiasig[$contador-1]->persona->cedula_persona}}</div>
                @foreach($contratodosi as $contdosi)
                    <div class="texto" style="top:{{$topTexto2}}px; left: {{$left2}}px;">{{$contdosi->nombre_empresa}}</div>
                    <div class="texto" style="top:{{$topTexto3}}px; left: {{$left2}}px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                @endforeach
                <div class="texto" style="top:{{$topTexto4}}px; left: {{$left2}}px; font-size: 8px;  ">No. {{$trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->primer_dia_uso));
                    $datefix2 = date('d/m/Y',strtotime($trabajdosiasig[$contador-1]->ultimo_dia_uso));
                @endphp
                <div class="fecha" style="top:{{$topFecha1}}px; left: {{$leftFecha2}}px;">{{$datefix1}}</div>  
                <div class="fecha" style="top:{{$topFecha2}}px; left: {{$leftFecha2}}px;">{{$datefix2}}</div>
                <div class="code" style="top:{{$topCode}}px; left:{{$leftCode2}}px;">
                    @php
                        echo DNS1D::getBarcodeHTML($trabajdosiasig[$contador-1]->dosimetro->codigo_dosimeter, 'C128',0.8,15);
                    @endphp
                </div> 
            @endif
            
        </table> 
        {{-- @foreach($trabajdosiasig as $key => $trab) 
            @php
                $top = 14;
                $left = 9;
            @endphp
            @if($key == 0) 
                <div class="texto" style="top:{{$top}}px; left:{{$left}}px;">{{$trab->persona->primer_apellido_persona}}, {{$trab->persona->primer_nombre_persona}}. CC. {{$trab->persona->cedula_persona}}</div>  
                
                @foreach($contratodosi as $contdosi)
                    <div class="texto" style="top:24px; left: 9px;">{{$contdosi->nombre_empresa}}</div>
                    <div class="texto" style="top:35px; left: 9px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                @endforeach
                <div class="texto" style="top:44px; left: 9px; font-size: 8px;">No. {{$trab->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d-m-Y',strtotime($trab->primer_dia_uso));
                    $datefix2 = date('d-m-Y',strtotime($trab->ultimo_dia_uso));
                @endphp
                <div class="fecha" style="top:67px; left: 60px;">{{$datefix1}}</div>  
                <div class="fecha" style="top:76px; left: 60px; background: yellow;">{{$datefix2}}</div>
                <div class="code" style="top:46px; left:149px;">
                    @php
                        echo DNS1D::getBarcodeHTML($trab->dosimetro->codigo_dosimeter, 'C128',0.8,15);
                    @endphp
                </div> 
            @endif
            
            @if($key == 1)
                <div class="texto" style="top:14px; left: 220px;">{{$trab->persona->primer_apellido_persona}}, {{$trab->persona->primer_nombre_persona}}. CC. {{$trab->persona->cedula_persona}}</div>  
                
                @foreach($contratodosi as $contdosi)
                    <div class="texto" style="top:24px; left: 220px;">{{$contdosi->nombre_empresa}}</div>
                    <div class="texto" style="top:35px; left: 220px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                @endforeach
                <div class="texto" style="top:44px; left: 220px;">No. {{$trab->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d-m-Y',strtotime($trab->primer_dia_uso));
                    $datefix2 = date('d-m-Y',strtotime($trab->ultimo_dia_uso));
                @endphp
                <div class="fecha" style="top:67px; left: 271px;">{{$datefix1}} AL</div>  
                <div class="fecha" style="top:76px; left: 271px; background: yellow;">{{$datefix2}}</div>
                <div class="code" style="top:46px; left:360px;">
                    @php
                        echo DNS1D::getBarcodeHTML($trab->dosimetro->codigo_dosimeter, 'C128',0.8,15);
                    @endphp
                </div>
            @endif
            @if($key == 2)
                <div class="texto" style="top:14px; left: 431px;">{{$trab->persona->primer_apellido_persona}}, {{$trab->persona->primer_nombre_persona}}. CC. {{$trab->persona->cedula_persona}}</div>  
                @foreach($contratodosi as $contdosi)
                    <div class="texto" style="top: 24px; left: 431px;">{{$contdosi->nombre_empresa}} - {{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                    <div class="texto" style="top:35px; left: 431px; font-size: 8px;">{{$contdosi->nombre_sede}} ESP: {{$contdosi->nombre_departamento}}</div>
                @endforeach
                <div class="texto" style="top:44px; left: 431px;">No. {{$trab->dosimetro->codigo_dosimeter}}</div>
                @php
                    $datefix1 = date('d-m-Y',strtotime($trab->primer_dia_uso));
                    $datefix2 = date('d-m-Y',strtotime($trab->ultimo_dia_uso));
                @endphp
                <div class="fecha" style="top:67px; left: 482px;">{{$datefix1}} AL</div>  
                <div class="fecha" style="top:76px; left: 482px;">{{$datefix2}}</div>
                <div class="code" style="top:46px; left:580px;">
                    @php
                        echo DNS1D::getBarcodeHTML($trab->dosimetro->codigo_dosimeter, 'C128',0.8,15);
                    @endphp
                </div>
            @endif
            
        @endforeach --}}

    </div>
    
    
</body>