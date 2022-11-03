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
    <img src="{{asset('imagenes/VerdeSF.png')}}" width="200" style="position:relative; left:420px; top:-30px;">
    <h3 style="position:relative; top:-40px;text-align: center; button:200px;">CERTIFICADO DE VERIFICACIÓN DE ENTRADA DE DOSIMENTRO PERSONAL</h3>
    <p style="position:relative; top:-30px; text-align:justify;">QA POSITRON S.A.S le notifica a la institución @if(empty($empresa)){{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} con NIT: {{$contdosisededepto->contratodosimetriasede->sede->empresa->num_iden_empresa}}-{{$contdosisededepto->contratodosimetriasede->sede->empresa->DV}} @else {{$empresa[0]->nombre_empresa}} con NIT: {{$empresa[0]->num_iden_empresa}}-{{$empresa[0]->DV}} @endif  que los dosímetros entregados han pasado por el proceso de verificación tanto de etiqueta, dosímetro y usuario final satisfactoriamente. A continuación, evidencia de la verificación: </p>
                
    <table style=" margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; font-size:9px;" cellpadding="4">
        <thead>
            <tr>
                <th rowspan="2" style="width: 15%;">TRABAJADOR</th>
                <th rowspan="2">DOSÍMETRO</th>
                <th rowspan="2">HOLDER</th>
                <th rowspan="2">UBICACIÓN</th>
                <th rowspan="2">MES</th>
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
        <tbody style="font-size: 8px;">
            @if($deptodosi != 0)
                @foreach($dosicontrolasig as $dosicontrol)
                    <tr>
                        <td>CONTROL </td>
                        <td style="text-align: center;">{{$dosicontrol->dosimetro->codigo_dosimeter}}</td>
                        <td style="text-align: center;">{{-- ///por ahora no aplica/// --}}
                                N.A.
                        </td>
                        <td style="text-align: center;">N.A. </td>
                        <td style="text-align: center;">{{$dosicontrol->mes_asignacion}}</td>
                        <td style="text-align: center;">{{$dosicontrol->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</td>
                        <td style="text-align: center;">{{$dosicontrol->contratodosimetriasede->sede->nombre_sede}}</td>
                        <td style="text-align: center;">{{$dosicontrol->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</td>
                        <td style="text-align: center;">
                            @php
                                $datefix = date('d-m-Y',strtotime($dosicontrol->primer_dia_uso));
                            @endphp
                            {{$datefix}}
                        </td>
                        <td style="text-align: center;">
                            @php
                                $datefix = date('d-m-Y',strtotime($dosicontrol->ultimo_dia_uso));
                            @endphp
                            {{$datefix}}
                        </td>
                    </tr>
                @endforeach
                @foreach($trabjasignados as $trabjasig)
                    <tr>
                        <td>{{$trabjasig->persona->primer_nombre_persona}} {{$trabjasig->persona->segundo_nombre_persona}} {{$trabjasig->persona->primer_apellido_persona}} {{$trabjasig->persona->segundo_apellido_persona}}</td>
                        <td style="text-align: center;">{{$trabjasig->dosimetro->codigo_dosimeter}}</td>
                        <td style="text-align: center;">
                            @if($trabjasig->holder_id == '' || $trabjasig->holder_id == 'NULL')
                                N.A.
                            @else
                                {{$trabjasig->holder->codigo_holder}}
                            @endif
                        </td>
                        <td style="text-align: center;">{{$trabjasig->ubicacion}}</td>
                        <td style="text-align: center;">{{$trabjasig->mes_asignacion}}</td>
                        <td style="text-align: center;">{{$trabjasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</td>
                        <td style="text-align: center;">{{$trabjasig->contratodosimetriasede->sede->nombre_sede}}</td>
                        <td style="text-align: center;">{{$trabjasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</td>
                        <td style="text-align: center;">
                            @php
                                $datefix = date('d-m-Y',strtotime($trabjasig->primer_dia_uso));
                            @endphp
                            {{$datefix}}
                        </td>
                        <td style="text-align: center;">
                            @php
                                $datefix = date('d-m-Y',strtotime($trabjasig->ultimo_dia_uso));
                            @endphp
                            {{$datefix}}
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach($temptrabjdosimrevsentrada as $temptrabj)
                    <tr>
                        <td>@if(!empty($temptrabj->persona->primer_nombre_persona)){{$temptrabj->persona->primer_nombre_persona}} {{$temptrabj->persona->segundo_nombre_persona}} {{$temptrabj->persona->primer_apellido_persona}} {{$temptrabj->persona->segundo_apellido_persona}}@else CONTROL @endif</td>
                        <td style="text-align: center;">{{$temptrabj->dosimetro->codigo_dosimeter}}</td>
                        <td style="text-align: center;">
                            @if($temptrabj->holder_id == '' || $temptrabj->holder_id == 'NULL')
                                N.A.
                            @else
                                {{$temptrabj->holder->codigo_holder}}
                            @endif
                        </td>
                        <td style="text-align: center;">@if(!empty($temptrabj->ubicacion)){{$temptrabj->ubicacion}}  @else N.A. @endif</td>
                        <td style="text-align: center;">{{$temptrabj->mes_asignacion}}</td>
                        <td style="text-align: center;">{{$temptrabj->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</td>
                        <td style="text-align: center;">{{$temptrabj->contratodosimetriasede->sede->nombre_sede}}</td>
                        <td style="text-align: center;">{{$temptrabj->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</td>
                        <td style="text-align: center;">
                            @php
                                $datefix = date('d-m-Y',strtotime($temptrabj->primer_dia_uso));
                            @endphp
                            {{$datefix}}
                        </td>
                        <td style="text-align: center;">
                            @php
                                $datefix = date('d-m-Y',strtotime($temptrabj->ultimo_dia_uso));
                            @endphp
                            {{$datefix}}
                        </td>
                    </tr>
                @endforeach
            @endif
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