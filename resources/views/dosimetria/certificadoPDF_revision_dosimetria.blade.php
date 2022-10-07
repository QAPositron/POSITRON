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
    <h3 style="position:relative; top:-40px;text-align: center; button:200px;">CERTIFICADO DE VERIFICACIÓN DE DOSIMENTRO PERSONAL</h3>
    <p style="position:relative; top:-30px; text-align:justify;">QA POSITRON S.A.S le notifica a la institución {{$empresa[0]->nombre_empresa}} con NIT: {{$empresa[0]->num_iden_empresa}}-{{$empresa[0]->DV}} que los dosímetros entregados han pasado por el proceso de verificación tanto de etiqueta, dosímetro y usuario final satisfactoriamente. A continuación, evidencia de la verificación: </p>
                {{--- y-4' >CONT.</th> --}}
    <table style=" margin: 0 auto; border: solid 0.3px #000; border-collapse:collapse; " cellpadding="4">
        <thead>
            <tr>
                <th style="width: 20%;">TRABAJADOR</th>
                <th>DOSÍMETRO</th>
                <th>HOLDER</th>
                <th>UBICACIÓN</th>
                <th>MES</th>
                <th>CONTRATO</th>
                <th>SEDE</th>
                <th>ESPECIALIDAD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temptrabjdosimrev as $temptrabj)
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
                    <td style="text-align: center;">{{$temptrabj->contratodosimetriasededepto->departamentosede->nombre_departamento}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <img src="{{asset('imagenes/FIRMADEDIEGOFINAL.png')}}" width="170" height="80" style="position:relative; top:400px;"> <br>
    <label style="position: relative; top:400px;">Diego Fernando Aponte Castañeda</label> <br>
    <label style="position: relative; top:400px;">Físico Médico</label> <br>
    <label style="position: relative; top:400px;">Director Técnico QA POSITRON S.A.S</label>

</body>