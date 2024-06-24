@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md">
        <div class="col-md">
            <a type="button" class="btn btn-circle colorQA" href="{{route('novedadesdosimetria.search')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div> 
    </div>
    <div class="col-7">
        <h2 class="text-center">DETALLE DE NOVEDAD DOSIMETRÍA  <br>
            @if ($item == 0)
                <i>{{$cambiosNovedad->novedadmesescontdosidepto->contratodosimetriasededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$cambiosNovedad->novedadmesescontdosidepto->contratodosimetriasededepto->contratodosimetriasede->sede->nombre_sede}}</i></h2>
                <h3 class="text-center">ESPECIALIDAD: <i>{{$cambiosNovedad->novedadmesescontdosidepto->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</i></h3> 
            @else
                <i>{{$cambiosNovedad->novedadmesescontdosidepto->novcontdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$cambiosNovedad->novedadmesescontdosidepto->novcontdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i></h2>
                <h3 class="text-center">ESPECIALIDAD: <i>{{$cambiosNovedad->novedadmesescontdosidepto->novcontdosisededepto->departamentosede->departamento->nombre_departamento}}</i></h3> 
            @endif
        <br>
        <h4 class="text-center" id="id_contrato"></h4>
    </div>
    <div class="col-md text-center"> 
        <a type="button" class="btn btn-circle colorQA mt-5"  target="_blank" href="{{route('reporteNovedad.pdf', ['novedad'=> $cambiosNovedad->novedadmesescontdosidepto->novedad->id_novedad, 'contrato'=> $cambiosNovedad->novedadmesescontdosidepto->novedad->contratodosimetria_id, 'item'=> $item])}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
            </svg>
        </a>
        <br>
        REPORTE
    </div>
</div>
<br>
@if($cambiosNovedad->tipo_novedad == 1) 
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="table-active text-center" colspan='7' style="font-size: 20">INGRESO DE DOSíMETRO</th>
                        </tr>
                        <tr class="table-active text-center">
                            <th class='align-middle'>FECHA DE REALIZADA</th>
                            <th class='align-middle'>PERÍODO</th>
                            <th class='align-middle'>TRABAJADOR / ÁREA</th>
                            <th class='align-middle'>UBICACIÓN</th>
                            <th class='align-middle'>DOSÍMETRO</th>
                            <th class='align-middle'>HOLDER</th>
                            <th class='align-middle' style='width: 25.90%'>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='align-middle text-center'>
                                @php
                                    $fecha = date("t-m-Y",strtotime($cambiosNovedad->created_at));
                                    echo $fecha;
                                @endphp
                            </td>
                            <td class='align-middle text-center' id='{{$cambiosNovedad->id_cambionovedadmeses}}'>
                                @php
                                    $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OBTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                @endphp
                                {{$cambiosNovedad->novedadmesescontdosidepto->novedad->mes_asignacion}} - 
                                @if($cambiosNovedad->trabajadordosimetro_id != null)
                                    {{date("d", strtotime($cambiosNovedad->trabajadordosimetro->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->trabajadordosimetro->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->trabajadordosimetro->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->trabajadordosimetro->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->trabajadordosimetro->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->trabajadordosimetro->ultimo_dia_uso))}}
                                @elseif($cambiosNovedad->dosiarea_id != null)
                                    {{date("d", strtotime($cambiosNovedad->dosiareacontdosisedes->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosiareacontdosisedes->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosiareacontdosisedes->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->dosiareacontdosisedes->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosiareacontdosisedes->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosiareacontdosisedes->ultimo_dia_uso))}}
                                @elseif($cambiosNovedad->dosicontrol_id != null)
                                    {{date("d", strtotime($cambiosNovedad->dosicontrolcontdosisedes->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosicontrolcontdosisedes->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosicontrolcontdosisedes->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->dosicontrolcontdosisedes->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosicontrolcontdosisedes->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosicontrolcontdosisedes->ultimo_dia_uso))}}
                                @endif
                            </td>
                            @if($cambiosNovedad->trabajadordosimetro_id != null)
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetro->persona->primer_nombre_persona}} {{$cambiosNovedad->trabajadordosimetro->persona->segundo_nombre_persona}} {{$cambiosNovedad->trabajadordosimetro->persona->primer_apellido_persona}} {{$cambiosNovedad->trabajadordosimetro->persona->segundo_apellido_persona}} </td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetro->ubicacion}}</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->trabajadordosimetro->dosimetro_id != NULL) {{$cambiosNovedad->trabajadordosimetro->dosimetro->codigo_dosimeter}} @else @endif</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->trabajadordosimetro->holder_id != NULL) {{$cambiosNovedad->trabajadordosimetro->holder->codigo_holder}} @else N.A. @endif</td>
                            @elseif($cambiosNovedad->dosiarea_id != null)
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosiareacontdosisedes->areadepartamentosede->nombre_area}}</td>
                                <td class='align-middle text-center'>AMBIENTAL</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->dosiareacontdosisedes->dosimetro_id != NULL) {{$cambiosNovedad->dosiareacontdosisedes->dosimetro->codigo_dosimeter}} @else @endif</td>
                                <td class='align-middle text-center'>N.A.</td>
                            @elseif($cambiosNovedad->dosicontrol_id != null)
                                <td class='align-middle text-center'>CONTROL TRANSPORTE</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosicontrolcontdosisedes->ubicacion}}</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->dosicontrolcontdosisedes->dosimetro_id != NULL) {{$cambiosNovedad->dosicontrolcontdosisedes->dosimetro->codigo_dosimeter}} @else @endif</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->dosicontrolcontdosisedes->holder_id != NULL) {{$cambiosNovedad->dosicontrolcontdosisedes->holder->codigo_holder}} @else N.A. @endif</td>
                            @endif
                            <td class='align-middle text-center'>{{$cambiosNovedad->nota_cambiodosim}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md"></div>
    </div>
    <br>
@endif
@if($cambiosNovedad->tipo_novedad == 2)
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="table-active text-center" colspan='7' style="font-size: 20">RETIRO DE DOSíMETRO</th>
                        </tr>
                        <tr class="table-active text-center">
                            <th class='align-middle'>FECHA DE REALIZADA</th>
                            <th class='align-middle'>PERÍODO</th>
                            <th class='align-middle'>TRABAJADOR / ÁREA</th>
                            <th class='align-middle'>UBICACIÓN</th>
                            <th class='align-middle'>DOSÍMETRO</th>
                            <th class='align-middle'>HOLDER</th>
                            <th class='align-middle' style='width: 25.90%'>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='align-middle text-center'>
                                @php
                                    $fecha = date("t-m-Y",strtotime($cambiosNovedad->created_at));
                                    echo $fecha;
                                @endphp
                            </td>
                            <td class='align-middle text-center' id="{{$cambiosNovedad->id_cambionovedadmeses}}">
                                @php
                                    $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OBTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                @endphp
                                {{$cambiosNovedad->novedadmesescontdosidepto->novedad->mes_asignacion}} - 
                                @if($cambiosNovedad->trabajadordosimetro_ant_id != null)
                                    {{date("d", strtotime($cambiosNovedad->trabajadordosimetroAnterior->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->trabajadordosimetroAnterior->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->trabajadordosimetroAnterior->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->trabajadordosimetroAnterior->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->trabajadordosimetroAnterior->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->trabajadordosimetroAnterior->ultimo_dia_uso))}}
                                @elseif($cambiosNovedad->dosiarea_ant_id != null)
                                    {{date("d", strtotime($cambiosNovedad->dosiareacontdosisedesAnterior->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosiareacontdosisedesAnterior->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosiareacontdosisedesAnterior->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->dosiareacontdosisedesAnterior->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosiareacontdosisedesAnterior->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosiareacontdosisedesAnterior->ultimo_dia_uso))}}
                                @elseif($cambiosNovedad->dosicontrol_ant_id != null)
                                    {{date("d", strtotime($cambiosNovedad->dosicontrolcontdosisedesAnterior->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosicontrolcontdosisedesAnterior->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosicontrolcontdosisedesAnterior->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->dosicontrolcontdosisedesAnterior->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosicontrolcontdosisedesAnterior->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosicontrolcontdosisedesAnterior->ultimo_dia_uso))}}
                                @endif
                            </td>
                            @if($cambiosNovedad->dosiarea_ant_id != null)
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosiareacontdosisedesAnterior->areadepartamentosede->nombre_area}} </td>
                                <td class='align-middle text-center'>AMBIENTAL</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosiareacontdosisedesAnterior->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle text-center'>N.A.</td>
                            @elseif($cambiosNovedad->trabajadordosimetro_ant_id != null)
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetroAnterior->persona->primer_nombre_persona}} {{$cambiosNovedad->trabajadordosimetroAnterior->persona->segundo_nombre_persona}} {{$cambiosNovedad->trabajadordosimetroAnterior->persona->primer_apellido_persona}} {{$cambiosNovedad->trabajadordosimetroAnterior->persona->segundo_apellido_persona}}</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetroAnterior->ubicacion}}</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetroAnterior->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->trabajadordosimetroAnterior->holder_id =! NULL) {{$cambiosNovedad->trabajadordosimetroAnterior->holder->codigo_holder}}@else N.A. @endif</td>
                            @elseif($cambiosNovedad->dosicontrol_ant_id != null)
                                <td class='align-middle text-center'>CONTROL TRANSPORTE</td>                            
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosicontrolcontdosisedesAnterior->ubicacion}}</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosicontrolcontdosisedesAnterior->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle text-center'>@if($cambiosNovedad->dosicontrolcontdosisedesAnterior->holder_id =! NULL) {{$cambiosNovedad->dosicontrolcontdosisedesAnterior->holder->codigo_holder}} @else N.A. @endif</td>
                            @endif
                            <td class='align-middle text-center'>{{$cambiosNovedad->nota_cambiodosim}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md"></div>
    </div>
    <br>
@endif
@if($cambiosNovedad->tipo_novedad == 3)
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="table-active text-center" colspan='6' style="font-size: 20">CAMBIO DE TRABAJADOR</th>
                        </tr>
                        <tr class="table-active text-center">
                            <th class='align-middle'>FECHA DE REALIZADA</th>
                            <th class='align-middle'>PERÍODO</th>
                            <th class='align-middle'>TRABAJADOR / ÁREA (INGRESO)</th>
                            <th class='align-middle'>TRABAJADOR / ÁREA (RETIRO)</th>
                            <th class='align-middle'>UBICACIÓN</th>
                            <th class='align-middle' style='width: 25.90%'>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='align-middle text-center'>
                                @php
                                    $fecha = date("t-m-Y",strtotime($cambiosNovedad->created_at));
                                    echo $fecha;
                                @endphp
                            </td>
                            <td class='align-middle text-center' id="{{$cambiosNovedad->id_cambionovedadmeses}}">
                                @php
                                    $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OBTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                @endphp
                                {{$cambiosNovedad->novedadmesescontdosidepto->novedad->mes_asignacion}} - 
                                @if ($cambiosNovedad->trabajadordosimetro_id != null)
                                    {{date("d", strtotime($cambiosNovedad->trabajadordosimetro->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->trabajadordosimetro->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->trabajadordosimetro->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->trabajadordosimetro->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->trabajadordosimetro->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->trabajadordosimetro->ultimo_dia_uso))}}
                                @elseif($cambiosNovedad->dosiarea_id != null)
                                    {{date("d", strtotime($cambiosNovedad->dosiareacontdosisedes->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosiareacontdosisedes->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosiareacontdosisedes->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->dosiareacontdosisedes->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosiareacontdosisedes->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosiareacontdosisedes->ultimo_dia_uso))}}
                                @elseif($cambiosNovedad->dosicontrol_id != null)
                                    {{date("d", strtotime($cambiosNovedad->dosicontrolcontdosisedes->primer_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosicontrolcontdosisedes->primer_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosicontrolcontdosisedes->primer_dia_uso))}}
                                    AL {{date("d", strtotime($cambiosNovedad->dosicontrolcontdosisedes->ultimo_dia_uso))}} DE {{$meses[date("m", strtotime($cambiosNovedad->dosicontrolcontdosisedes->ultimo_dia_uso))]}} {{date("Y", strtotime($cambiosNovedad->dosicontrolcontdosisedes->ultimo_dia_uso))}}
                                @endif
                            </td>
                            @if($cambiosNovedad->trabajadordosimetro_id != null)
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetro->persona->primer_nombre_persona}} {{$cambiosNovedad->trabajadordosimetro->persona->segundo_nombre_persona}} {{$cambiosNovedad->trabajadordosimetro->persona->primer_apellido_persona}} {{$cambiosNovedad->trabajadordosimetro->persona->segundo_apellido_persona}} </td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetroAnterior->persona->primer_nombre_persona}} {{$cambiosNovedad->trabajadordosimetroAnterior->persona->segundo_nombre_persona}} {{$cambiosNovedad->trabajadordosimetroAnterior->persona->primer_apellido_persona}} {{$cambiosNovedad->trabajadordosimetroAnterior->persona->segundo_apellido_persona}}</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->trabajadordosimetro->ubicacion}}</td>
                            @elseif($cambiosNovedad->dosiarea_id != null)
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosiareacontdosisedes->areadepartamentosede->nombre_area}}</td>
                                <td class='align-middle text-center'>{{$cambiosNovedad->dosiareacontdosisedesAnterior->areadepartamentosede->nombre_area}}</td>
                                <td class='align-middle text-center'>AMBIENTAL</td>
                            @endif
                            <td class='align-middle text-center'>{{$cambiosNovedad->nota_cambiodosim}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md"></div>
    </div>
    <br>
@endif 
 
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$cambiosNovedad->novedadmesescontdosidepto->novedad->dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        var numNov = parseInt('{{$cambiosNovedad->novedadmesescontdosidepto->novedad->codigo_novedad}}');
        var nNov = numNov.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        TDcontrato.innerHTML = "CONTRATO No."+n+" - NOVEDAD No."+nNov;
        
    })
    
</script>

@endsection()
